<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MediaUploaderController extends Controller
{
    /**
     * Upload the image to the server.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        // get image
        $data = $request->only('upload');

        // validate
        $validator = Validator::make($data, $this->rules());

        // validate fails
        if ($validator->fails()) {
            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'Lütfen en fazla 4 MB boyutunda bir görsel(jpeg, jpg, png) yükleyiniz.',
                ],
            ], 400);
        }
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $randomize = Str::random(5);
            $uniqueName = sprintf(
                'editor-%s-%s.%s',
                $randomize,
                Str::uuid(),
                $file->getClientOriginalExtension()
            );

            // Store the file on the disk
            $file->storePubliclyAs('public/uploads', $uniqueName);

            return response()->json([
                'uploaded' => true,
                'url' => route('storage.images', $uniqueName),
            ]);
        }
        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'Bir hata oluştu.',
            ],
        ], 400);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'upload' => 'required|mimes:jpeg,jpg,png|max:4096',
        ];
    }
}
