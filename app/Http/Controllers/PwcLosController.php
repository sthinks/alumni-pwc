<?php

namespace App\Http\Controllers;

use App\PwcLos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PwcLosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('admin.los.index', [
            'items' => PwcLos::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.los.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());
        $created = PwcLos::create($validated);
        if ($created->exists()) {
            return redirect()->route('manager.los.index')
                ->with('success', 'Los başarı ile oluşturulmuştur');
        }
        return redirect()->back()->withErrors('Los oluşturulurken bir hata oluştu.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(int $id): Response
    {
        $item = PwcLos::findOrFail($id);
        return response()->view('admin.los.edit', [
            'item' => $item,
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
        $item = PwcLos::findOrFail($id);
        $validated = $request->validate($this->rules(), [], $this->attributes());
        if ($item->update($validated)) {
            return redirect()->route('manager.los.index')
                ->with('success', 'Los başarıyla güncellenmiştir.');
        }
        return redirect()->back()->withErrors('Los güncellenirken bir hata oluştu');
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
            $pwcLos = PwcLos::findOrFail($id);
            $pwcLos->delete();
            return redirect()->back()->with('success', 'Los başarıyla silinmiştir.');
        } catch (\Exception $exception) {
            activity()->performedOn(new PwcLos())->causedBy(auth()->id())->withProperties($pwcLos->toArray())->log($exception->getMessage());
            return redirect()->back()->withErrors('Los silinirken bir hata oluştu');
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Los Başlığı',
        ];
    }
}
