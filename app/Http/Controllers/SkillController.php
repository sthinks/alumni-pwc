<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('admin.skill.index', [
            'items' => Skill::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());
        $created = Skill::create($validated);
        if ($created->exists()) {
            return redirect()->route('manager.skills.index')
                ->with('success', 'Yetenek başarı ile oluşturulmuştur');
        }
        return redirect()->back()->withErrors('Yetenek oluşturulurken bir hata oluştu.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Skill $skill
     * @return Response
     */
    public function edit(Skill $skill): Response
    {
        return response()->view('admin.skill.edit', [
            'item' => $skill,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());
        if ($skill->update($validated)) {
            return redirect()->route('manager.skills.index')
                ->with('success', 'Yetenek başarıyla güncellenmiştir.');
        }
        return redirect()->back()->withErrors('Yetenek güncellenirken bir hata oluştu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        try {
            $skill->delete();
            return redirect()->back()->with('success', 'Yetenek başarıyla silinmiştir.');
        } catch (\Exception $exception) {
            activity()->performedOn(new Skill())->causedBy(auth()->id())->withProperties($skill->toArray())->log($exception->getMessage());
            return redirect()->back()->withErrors('Yetenek silinirken bir hata oluştu');
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
            'name' => 'Yetenek Başlığı',
        ];
    }

}
