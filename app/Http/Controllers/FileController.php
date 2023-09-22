<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    /**
     * Proccess file name
     *
     * @param string $filename
     *
     * @return \Illuminate\Http\Response
     */
    public function proccess(string $filename): \Illuminate\Http\Response
    {
        $path = storage_path('app/public/uploads/' . $filename);
        if (! File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file);
        $response->header('Content-Type', $type);
        return $response;
    }
}
