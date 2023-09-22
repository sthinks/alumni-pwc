<?php

namespace App\Http\Controllers;

use App\PwcLos;
use App\PwcSublos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PwcSubLosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = PwcSublos::with('los')->get();
        return response()->view('admin.sublos.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $options = PwcLos::all();
        return response()->view('admin.sublos.create', [
            'options' => $options,
        ]);
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
        $created = PwcSublos::create($validated);
        if ($created->exists()) {
            return redirect()->route('manager.sublos.index')
                ->with('success', 'SubLos başarıyla oluşturulmuştur.');
        }
        return redirect()->back()
            ->withErrors('SubLos oluştururken bir hata oluştu.');
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
        $item = PwcSublos::findOrFail($id);
        $options = PwcLos::all();
        return response()->view('admin.sublos.edit', [
            'item' => $item,
            'options' => $options,
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
        $sublos = PwcSublos::findOrFail($id);
        $validated = $request->validate($this->rules(), [], $this->attributes());
        if ($sublos->update($validated)) {
            return redirect()->route('manager.sublos.index')
                ->with('success', 'Sublos başarıyla güncellenmiştir.');
        }
        return redirect()->back()->withErrors('Sublos güncellenirken bir hata oluştu.');
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
            $pwcSubLos = PwcSublos::findOrFail($id);
            $pwcSubLos->delete();
            return redirect()->back()->with('success', 'SubLos başarıyla silinmiştir.');
        } catch (\Exception $exception) {
            activity()->performedOn(new PwcSublos())->causedBy(auth()->id())->withProperties($pwcSubLos->toArray())
                ->log($exception->getMessage());
            return redirect()->back()->withErrors('SubLos silinirken bir hata oluştu');
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
            'pwc_los_id' => 'required|exists:pwc_los,id',
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
            'name' => 'SubLos Başlığı',
            'pwc_los_id' => 'PwC Los',
        ];
    }
}
