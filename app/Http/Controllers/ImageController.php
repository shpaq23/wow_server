<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function getIcon(String $name)
    {
        $file_path = "public\icons\\$name.png";
        if (!Storage::exists($file_path)) {
            abort(404);
        }
        $file = Storage::get($file_path);
        $type = Storage::mimeType($file_path);
        $response = Response::make($file, 200)->header("Content-Type", $type);

        return $response;
    }
}
