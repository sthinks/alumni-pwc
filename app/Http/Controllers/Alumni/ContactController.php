<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Mail\ContactForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Storing the contact form data.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $user = auth()->user();

        // validate the request
        $validation = Validator::make(
            $request->all(),
            $this->rules(),
            [],
            $this->attributes()
        );

        // if validation fails
        if ($validation->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validation->errors(),
            ]);
        }

        // if validation passes
        $validatedData = $validation->validated();

        // create the resource
        $contact = $user->contactForms()
            ->create($validatedData);
        // notify
        Mail::send(new ContactForm($contact, $user));

        return response()->json([
            'status' => 'success',
            'message' => 'Form başarıyla kayıt edilmiştir.',
            'data' => $contact->makeHidden(['id'])->toArray(),
        ]);
    }

    /**
     * The rules applied to the contact form.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'contact_title' => 'required|string|max:255',
            'contact_message' => 'required|string|max:2048',
        ];
    }

    /**
     * The attributes for the contact form.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'contact_title' => 'Başlık',
            'contact_message' => 'Açıklama',
        ];
    }
}
