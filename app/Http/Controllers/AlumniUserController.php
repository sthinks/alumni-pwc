<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class AlumniUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::alumni()->get();
        return response()->view('admin.alumni.index', ['users' => $users]);
    }

    /**
     * Display a listing of the resource according to filtered data.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request): Response
    {
        // Get validated data
        $data = $request->validate($this->searchRules());

        // start building query
        $query = User::alumni();

        // if name filtered
        if (isset($data['alumni_name'])) {
            $query->where('name', 'like', "%{$data['alumni_name']}%");
        }

        // if created at filtered
        if (isset($data['alumni_created_at_from'])) {
            $query->whereDate('created_at', '>=', $data['alumni_created_at_from']);
        }
        if (isset($data['alumni_created_at_to'])) {
            $query->whereDate('created_at', '<=', $data['alumni_created_at_to']);
        }

        // if phone filtered
        if (isset($data['alumni_phone'])) {
            $query->where('phone', 'like', "%{$data['alumni_phone']}%");
        }

        // if staff id filtered
        if (isset($data['alumni_staff_id'])) {
            $query->where('staff_id', 'like', "%{$data['alumni_staff_id']}%");
        }

        // if mail filtered
        if (isset($data['alumni_email'])) {
            $query->where('email', 'like', "%{$data['alumni_email']}%");
        }

        // get filtered users
        $users = $query->get();

        return response()->view('admin.alumni.index', ['users' => $users, 'posted' => $data]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'alumni_name' => 'nullable|string|max:255',
            'alumni_created_at_from' => 'nullable|date_format:Y-m-d',
            'alumni_created_at_to' => 'nullable|date_format:Y-m-d',
            'alumni_phone' => 'nullable|string|max:255',
            'alumni_staff_id' => 'nullable|string|max:255',
            'alumni_email' => 'nullable|email|max:255',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id): Response
    {
        $user = User::alumni()->findOrFail($id);
        $user_skills = collect(Arr::flatten($user->skills()->get(['name'])->makeHidden('pivot')->toArray()))->join(',');
        return response()->view('admin.alumni.show', [
            'user' => $user,
            'failed_logins' => $user->failedLogins(),
            'user_skills' => $user_skills
        ]);
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
        $user = User::alumni()->findOrFail($id);
        try {
            $user->delete();
            activity()->performedOn($user)->causedBy(auth()->id())->withProperties($user->toArray())->log('deleted');
            return redirect()->route('manager.users.index')->with('success', 'Kullanıcı başarıyla silinmiştir.');
        } catch (Exception $exception) {
            return redirect()->back()->withErrors('Kullanıcı silinirken bir hata oluştu.');
        }
    }
}
