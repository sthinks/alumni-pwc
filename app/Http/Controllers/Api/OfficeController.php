<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PwcOffice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function all(): JsonResponse
    {
        $processed = [];
        foreach (PwcOffice::all() as $los){
            $processed[] = ["value" => $los->name, "key" => $los->id];
        }
        return response()->api(200, $processed);
    }
}
