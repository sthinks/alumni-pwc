<?php

namespace App\Http\Controllers;

use App\Slider;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.sliders');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // get all sliders
        $sliders = Slider::all();

        return response()->view('admin.slider.index', [
            'sliders' => $sliders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.slider.create', [
            'config' => $this->config,
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
        // validate form
        $data = $request->validate($this->rules(), [], $this->attributes());
        $data['slider_visible'] = isset($data['slider_visible']);

        // uplooad slider's image
        $poster = $request->file('slider_image');
        // Create unique name for this file
        $poster_unique_name = sprintf('%s.%s', Str::uuid(), $poster->getClientOriginalExtension());
        // Store the file on the disk
        $poster->storePubliclyAs('public/uploads', $poster_unique_name);

        // Add filename to the data
        $data['slider_image'] = $poster_unique_name;

        $slider = Slider::create($data);

        if ($slider->exists) {
            return redirect()->route('manager.sliders.index')
                ->with('success', 'Slider başarıyla oluşturulmuştur.');
        }
        return redirect()->back()
            ->withErrors('Slider oluştulurken bir hata oluştu.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'slider_title' => 'required|string|max:255',
            'slider_image' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
            'slider_link' => 'nullable|url|max:511',
            'slider_visible' => 'nullable|string',
            'slider_order' => 'nullable|integer',
            'slider_topic' => 'required|string|max:255',
            'slider_desc' => 'required|string|max:1027',
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
            'slider_title' => 'Slider başlığı',
            'slider_image' => 'Slider görseli',
            'slider_link' => 'Slider linki',
            'slider_visible' => 'Slider aktif mi?',
            'slider_order' => 'Slider Sırası',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     *
     * @return Response
     */
    public function show(Slider $slider): Response
    {
        return response()->view('admin.slider.show', [
            'slider' => $slider,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     *
     * @return Response
     */
    public function edit(Slider $slider): Response
    {
        return response()->view('admin.slider.edit', [
            'slider' => $slider,
            'config' => $this->config,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Slider $slider
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Slider $slider): RedirectResponse
    {
        // validate form
        $data = $request->validate($this->rules());
        $data['slider_visible'] = isset($data['slider_visible']);

        // upload slider's image if posted
        if ($request->hasFile('slider_image')) {
            $poster = $request->file('slider_image');
            // Create unique name for this file
            $poster_unique_name = sprintf(
                '%s.%s',
                Str::uuid(),
                $poster->getClientOriginalExtension()
            );
            // Store the file on the disk
            $poster->storePubliclyAs('public/uploads', $poster_unique_name);

            // Add filename to the data
            $data['slider_image'] = $poster_unique_name;
        }

        // update slider
        if ($slider->update($data)) {
            return redirect()->back()
                ->with('success', 'Slider başarıyla güncellenmiştir.');
        }

        return redirect()->back()
            ->withErrors('Slider güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     *
     * @return RedirectResponse
     */
    public function destroy(Slider $slider): RedirectResponse
    {
        try {
            $slider->delete();
            return redirect()->route('manager.sliders.index')
                ->with('success', 'Slider başarıyla silinmiştir.');
        } catch (Exception $e) {
            // log what just happened
            activity()->performedOn(new Slider())
                ->causedBy(auth()->id())
                ->withProperties($slider->toArray())
                ->log($e->getMessage());
            return redirect()->back()
                ->withErrors('Slider silinirken bir hata oluştu.');
        }
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
        // Get validated data
        $validated = $request->validate($this->searchRules());

        // Start building the query
        $query = Slider::query();

        // If slider title inputted
        if (isset($validated['slider_title'])) {
            $query->where('slider_title', 'LIKE', "%{$validated['slider_title']}%");
        }

        // If start date inputted
        if (isset($validated['slider_begin'])) {
            $query->whereDate('created_at', '>=', $validated['slider_begin']);
        }

        // If end date inputted
        if (isset($validated['slider_end'])) {
            $query->whereDate('created_at', '<=', $validated['slider_end']);
        }

        // Content status
        if (in_array($validated['slider_visible'], ['0', '1'], true)) {
            $query->where('slider_visible', (int) $validated['slider_visible']);
        }

        // Get filtered data
        $sliders = $query->get();

        return response()->view('admin.slider.index', [
            'sliders' => $sliders, 'posted' => $validated,
        ]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'slider_title' => 'nullable|string|max:255',
            'slider_begin' => 'nullable|date_format:Y-m-d',
            'slider_end' => 'nullable|date_format:Y-m-d',
            'slider_visible' => 'nullable|string',
        ];
    }
}
