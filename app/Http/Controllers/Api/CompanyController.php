<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    /**
     * Searching for companies
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function search(Request $request): JsonResponse
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:3',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->api(401, [], $validator->errors());
        }

        // if validation passes
        // get validated data
        $validated = $validator->validated();
        $query = $validated['query'];

        // cache control
        $cache_key = 'company_search_' . $query;
        $companies = Cache::remember($cache_key, 1, function () use ($query) {
            return Company::where('name', 'like', $query . '%')
                ->limit(15)
                ->orderBy('name')
                ->get(['name']);
        });
        $processed = [];
        foreach ($companies as $los){
            $processed[] = ["value" => $los->name, "key" => $los->id];
        }
        return response()->api(200, $processed);
    }
}
