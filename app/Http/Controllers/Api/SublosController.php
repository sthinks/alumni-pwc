<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PwcLos;
use App\PwcSublos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SublosController extends Controller
{
    /**
     * @param Request $request
     * Get sublos related to los
     */
    public function fetch(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|exists:pwc_los,name',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->api(401, [], $validator->errors());
        }

        $validated = $validator->validated();
        $los = PwcLos::where('name', $validated['name'])->first();
        $items = PwcSublos::where('pwc_los_id', $los->id)->get(['name']);
        $processed = [];
        foreach ($items as $los){
            $processed[] = ["value" => $los->name, "key" => $los->id];
        }
        return response()->api(200, $processed);
    }
}
