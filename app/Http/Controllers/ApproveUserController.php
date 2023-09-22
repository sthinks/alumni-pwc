<?php

namespace App\Http\Controllers;

use App\Events\UserApproved;
use App\Events\UserRejected;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApproveUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // Get not approved yet users
        $users = User::where('is_approved', false)->orderBy('created_at')->get();
        return response()->view('admin.approve.index', [
            'users' => $users,
        ]);
    }

    /**
     * Display a listing of the resource.
     * Based on the search made
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request): Response
    {
        $validated = $request->validate($this->searchRules());

        // Start building query
        $query = User::where('is_approved', false);

        // If name is inputted
        if (isset($validated['name'])) {
            $query->where('name', 'LIKE', "%{$validated['name']}%");
        }

        // If mail is inputted
        if (isset($validated['email'])) {
            $query->where('email', 'LIKE', "%{$validated['email']}%");
        }

        // If mail is inputted
        if (isset($validated['phone'])) {
            $query->where('phone', 'LIKE', "%{$validated['phone']}%");
        }

        // If start date inputted
        if (isset($validated['start'])) {
            $query->whereDate('created_at', '>=', $validated['start']);
        }

        // If start date inputted
        if (isset($validated['end'])) {
            $query->whereDate('created_at', '<=', $validated['end']);
        }

        // Phone number approval status
        if ($validated['phone_approval'] === '0') {
            $query->whereNull('phone_verified_at');
        } elseif ($validated['phone_approval'] === '1') {
            $query->whereNotNull('phone_verified_at');
        }
        // Get filtered data
        $users = $query->get();

        return response()->view('admin.approve.index', ['users' => $users, 'posted' => $validated]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string',
            'start' => 'nullable|date_format:Y-m-d',
            'end' => 'nullable|date_format:Y-m-d',
            'phone_approval' => 'nullable|string',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(int $id): Response
    {
        // Get the user
        $user = User::where('is_approved', false)->findOrFail($id);

        $last_staff_id = optional(User::alumni()->where('staff_id', 'like', 'Alum%')->orderByDesc('id')->first())->staff_id;

        return response()->view('admin.approve.edit', [
            'user' => $user,
            'last_staff_id' => $last_staff_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        // Find the user requested
        $user = User::where('is_approved', false)->findOrFail($id);

        // Validate data inputted
        $validated = $request->validate($this->rules());

        // Set attributes and update
        $user->timestamps = false;
        $user->approved_at = $user->freshTimestamp();
        $user->approved_by = auth()->id();
        $user->is_approved = 1;
        $user->staff_id = $validated['staff_id'];

        if ($user->update()) {
            // trigger event
            event(new UserApproved($user));
            return redirect()->route('manager.approval.index')->with('success', 'Kullanıcı başarıyla onaylanmıştır');
        }

        return redirect()->back()->withErrors('Kullanıcı güncellenirken bir hata oluştu!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'staff_id' => 'string|max:255',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            // Find the user
            $user = User::where('is_approved', false)->findOrFail($id);

            // trigger user rejected event
            event(new UserRejected($user));

            // Log the record
            activity()->performedOn(new User())->causedBy(auth()->id())->withProperties($user->toArray())->log('user_refused');

            // Delete the user
            $user->delete();

            return redirect()->route('manager.approval.index')->with('success', 'Kullanıcı başarıyla silinmiştir.');
        } catch (Exception $exception) {
            return redirect()->back()->withErrors('Bir hata oluştu');
        }
    }
}
