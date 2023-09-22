<?php

namespace App\Http\Controllers\Alumni;

use App\Events\NewJobShared;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JobShareController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {

        // Validate the request
        $validated = Validator::make(
            $request->all(),
            $this->rules(),
            [],
            $this->attributes()
        );

        // If the validation fails
        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => Arr::flatten($validated->errors()->all()),
            ]);
        }
        $validatedData = $validated->validated();
        $validatedData['skills'] = collect($validatedData['skills'])->implode(',');
        // If the validation succeeds
        $jobShare = auth()->user()->sharedJobs()->create($validatedData);

        // if the job share is created successfully
        if ($jobShare->exists) {
            event(new NewJobShared());
            return response()->json([
                'status' => 'success',
                'message' => 'İlan başarılı bir şekilde paylaşılmıştır.',
            ]);
        }

        // flatten error messages
        return response()->json([
            'status' => 'error',
            'message' => 'Beklenmeye bir hata oluşmuştur.',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'location' => 'required|integer',
            'experience' => 'required|integer',
            'detail' => 'required|string',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,name',
            'date' => 'required|date_format:Y-m-d',
            'valid_till' => 'required|date_format:Y-m-d',
            'link' => 'required|string|max:511',
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
            'company' => 'Şirket Adı',
            'position' => 'Pozisyon Adı',
            'level' => 'Pozisyon Seviyesi',
            'location' => 'Adres / Lokasyon',
            'experience' => 'Deneyim',
            'detail' => 'Detay',
            'date' => 'İlan Tarihi',
            'valid_till' => 'Geçerlilik Tarihi',
            'link' => 'Başvuru Linki',
        ];
    }
}
