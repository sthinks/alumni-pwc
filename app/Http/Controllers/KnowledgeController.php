<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Knowledge;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class KnowledgeController extends Controller
{
    /**
     * @var mixed Knowledge config settings
     */
    private $config;

    /**
     * @var mixed Gallery config settings
     */
    private $galleryConfig;

    public function __construct()
    {
        $this->config = Config::get('constants.knowledge');
        $this->galleryConfig = Config::get('constants.gallery');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $knowledge = Knowledge::orderByDesc('created_at')->get();
        return response()->view('admin.knowledge.index', ['knowledge' => $knowledge]);
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
        $query = Knowledge::query();

        // If content title inputted
        if (isset($validated['knowledge_title'])) {
            $query->where('knowledge_title', 'LIKE', "%{$validated['knowledge_title']}%");
        }

        // If start date inputted
        if (isset($validated['knowledge_start_date'])) {
            $query->whereDate('created_at', '>=', $validated['knowledge_start_date']);
        }

        // If end date inputted
        if (isset($validated['knowledge_end_date'])) {
            $query->whereDate('created_at', '<=', $validated['knowledge_end_date']);
        }

        // Content status
        if (in_array($validated['knowledge_visible'], ['0', '1'], true)) {
            $query->where('knowledge_visible', (int) $validated['knowledge_visible']);
        }

        // Get filtered data
        $knowledge = $query->get();

        return response()->view('admin.knowledge.index', ['knowledge' => $knowledge, 'posted' => $validated]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'knowledge_title' => 'nullable|string|max:255',
            'knowledge_start_date' => 'nullable|date_format:Y-m-d',
            'knowledge_end_date' => 'nullable|date_format:Y-m-d',
            'knowledge_visible' => 'nullable|string',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.knowledge.create', ['config' => $this->config]);
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
        // Get validated data
        $validated = $request->validate($this->rules(), [], $this->attributes());
        $request->validate($this->galleryRules());

        // Handle the checkbox
        $validated['knowledge_visible'] = isset($validated['knowledge_visible']);
        $validated['knowledge_featured'] = isset($validated['knowledge_featured']);

        // Get the image
        $image = $request->file('knowledge_poster');

        // Assign image name
        $imageName = sprintf('%s.%s', Str::uuid(), $image->extension());

        // Upload the image
        $image->storePubliclyAs('public/uploads', $imageName);

        // Save image name
        $validated['knowledge_poster'] = $imageName;

        // Store the knowledge & development on the database
        $knowledge = Knowledge::create($validated);

        // Check if knowledge & development is stored
        if ($knowledge->exists) {
            // Upload media galleries
            if ($files = $request->file('media_gallery')) {
                foreach ($files as $file) {
                    // Generate a unique name
                    $uniqueName = FileHelper::generateFileName($file->getClientOriginalName(), $file->getClientOriginalExtension());

                    // Store the file on the disk
                    $file->storePubliclyAs('public/uploads', $uniqueName);
                    $knowledge->files()->create(['gallery_url' => $uniqueName, 'gallery_added_by' => auth()->id()]);
                }
            }
            return redirect()->route('manager.knowledge.index')->with('success', 'İçerik başarıyla kayıt edilmiştir.');
        }

        return redirect()->back()->withErrors('İçerik kayıt edilemedi!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'knowledge_title' => 'required|string|max:255',
            'knowledge_abstract' => 'nullable|string|max:255',
            'knowledge_text' => 'required|string',
            'knowledge_poster' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
            'knowledge_visible' => 'nullable|string',
            'knowledge_featured' => 'nullable|string',
            'knowledge_embed' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'knowledge_poster' => 'Afiş Görseli',
        ];
    }

    /**
     * Get the gallery validation rules that apply to the request.
     *
     * @return array
     */
    public function galleryRules(): array
    {
        return [
            'media_gallery' => 'nullable|array',
            'media_gallery.*' => sprintf('nullable|mimes:%s|max:%d', $this->galleryConfig['file']['extensions'], $this->galleryConfig['file']['max_size']),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Knowledge $knowledge
     *
     * @return Response
     */
    public function edit(Knowledge $knowledge): Response
    {
        return response()->view('admin.knowledge.edit', ['knowledge' => $knowledge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Knowledge $knowledge
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Knowledge $knowledge): RedirectResponse
    {
        // Validate inputs
        $validated = $request->validate($this->rules(), [], $this->attributes());

        // Handle the checkbox
        $validated['knowledge_visible'] = isset($validated['knowledge_visible']);
        $validated['knowledge_featured'] = isset($validated['knowledge_featured']);

        // Check if file uploaded
        if ($request->hasFile('knowledge_file')) {
            // Get the file
            $file = $request->file('knowledge_file');

            // Assign a file name
            $fileName = sprintf('%s.%s', Str::uuid(), $file->extension());

            // Upload the file
            $file->storePubliclyAs('public/uploads', $fileName);

            // Save the file name
            $validated['knowledge_file'] = $fileName;
        }

        // Check image is updated
        if ($request->hasFile('knowledge_poster')) {
            // Get the image
            $image = $request->file('knowledge_poster');

            // Assign image name
            $imageName = sprintf('%s.%s', Str::uuid(), $image->extension());

            // Upload the image
            $image->storePubliclyAs('public/uploads', $imageName);

            // Save image name
            $validated['knowledge_poster'] = $imageName;
        }

        // Update the knowledge & development on the database
        $knowledge->update($validated);

        return redirect()->route('manager.knowledge.index')->with('success', 'İçerik başarıyla güncellenmiştir.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Knowledge $knowledge
     *
     * @return RedirectResponse
     */
    public function destroy(Knowledge $knowledge): RedirectResponse
    {
        try {
            $knowledge->delete();
            return redirect()->route('manager.knowledge.index')->with('success', 'İçerik başarıyla silinmiştir.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Bir hata oluştu');
        }
    }

    /**
     * Display a listing of gallery.
     *
     * @param Knowledge $knowledge
     *
     * @return Response
     */
    public function gallery(Knowledge $knowledge): Response
    {
        return response()->view('admin.knowledge.gallery', ['knowledge' => $knowledge, 'files' => $knowledge->files()->get()]);
    }

    /**
     * Display a listing of gallery.
     *
     * @param Knowledge $knowledge
     * @param $id
     *
     * @return RedirectResponse
     */
    public function galleryDestroy(Knowledge $knowledge, $id): RedirectResponse
    {
        try {
            if ($file = $knowledge->files()->findOrFail($id)) {
                $file->delete();
            }
        } catch (Exception $exception) {
            return redirect()->back()->withErrors('Dosya silinirken bir hata oluştu.');
        }
        return redirect()->back()->with('success', 'Dosya başarıyla silinmiştir.');
    }

    /**
     * Show the form for adding new files
     *
     * @param Knowledge $knowledge
     *
     * @return Response
     */
    public function galleryCreate(Knowledge $knowledge): Response
    {
        return response()->view('admin.knowledge.gallery_create', ['knowledge' => $knowledge]);
    }

    /**
     * Store gallery files
     *
     * @param Request $request
     * @param Knowledge $knowledge
     *
     * @return RedirectResponse
     */
    public function galleryStore(Request $request, Knowledge $knowledge): RedirectResponse
    {
        // Validate data
        $request->validate($this->galleryRules());

        // Upload media galleries
        if ($files = $request->file('media_gallery')) {
            foreach ($files as $file) {
                // Generate a unique name
                $uniqueName = FileHelper::generateFileName($file->getClientOriginalName(), $file->getClientOriginalExtension());

                // Store the file on the disk
                $file->storePubliclyAs('public/uploads', $uniqueName);
                $knowledge->files()->create(['gallery_url' => $uniqueName, 'gallery_added_by' => auth()->id()]);
            }
        }
        return redirect()->route('manager.knowledge.gallery', $knowledge->id)->with('success', 'Dosyalar başarıyla eklenmiştir.');
    }
}
