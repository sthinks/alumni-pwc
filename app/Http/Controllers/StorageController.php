<?php

namespace App\Http\Controllers;

use App\Storage;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StorageController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.storage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $storages = Storage::orderBy('id', 'desc')->get();
        $storages = $storages->map(function ($storage) {
            $storage->link = route('storage.images', $storage->file);
            return $storage;
        });
        return response()->view('admin.storage.index', compact('storages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.storage.create');
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
         // validate the request
         $data = $request->validate(
            $this->rules(),
            [],
            $this->attributes()
        );
        // get uploaded file
        $file = $request->file('file');
        // generate unique file name
        $file_name = sprintf(
            '%s.%s',
            Str::uuid(),
            $file->getClientOriginalExtension()
        );
        // upload file on the server disk
        $file->storePubliclyAs('public/uploads', $file_name);
        // set file to filename for database record
        $data['file'] = $file_name;
        //son ekleme tarihine bakalım
        $lastUploadedRecord = Storage::orderBy('created_at', 'desc')
        ->first();
        if ($lastUploadedRecord) {
            $lastUploadTime = Carbon::parse($lastUploadedRecord->created_at);
            if (Carbon::now()->diffInSeconds($lastUploadTime) < 30) {
                return redirect()->route('manager.storage.index')
                ->with('success', 'Lütfen ardarda dosya yüklemeyin 30 sn de bir dosya yükleyebilirsiniz.');
            }
            else {
 // store it in database
 $storage = Storage::create($data);
 // check if it is stored in database
 if ($storage->exists) {
     return redirect()->route('manager.storage.index')
         ->with('success', 'Dosya başarıyla oluşturulmuştur.');
 }
 return redirect()->route('manager.storage.index')
     ->with('error', 'Dosya oluşturulurken bir hata oluştu.');
            }
        }
       
    }

    /**
     * Get the gallery validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'file' => sprintf(
                'required|mimes:%s|max:%d',
                $this->config['file']['extensions'],
                $this->config['file']['max_size']
            ),
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
            'name' => 'Dosya ismi',
            'file' => 'Dosya',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Storage $storage
     *
     * @return RedirectResponse
     *
     * @throws Exception
     */
    public function destroy(Storage $storage): RedirectResponse
    {
        $file = storage_path('app/public/uploads/' . $storage->file);
        // delete file if exists
        if (File::exists($file)) {
            File::delete($file);
        }
        // delete record
        $storage->delete();
        return redirect()->route('manager.storage.index')
            ->with('success', 'Dosya başarıyla silinmiştir.');
    }
}
