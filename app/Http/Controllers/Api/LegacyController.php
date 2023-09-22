<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Legacy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LegacyController extends Controller
{
    public function all(): JsonResponse
    {
        $processed = [];
        foreach (Legacy::all() as $los){
            $processed[] = ["value" => $los->name, "key" => $los->id];
        }
        return response()->api(200, $processed);
    }
}
