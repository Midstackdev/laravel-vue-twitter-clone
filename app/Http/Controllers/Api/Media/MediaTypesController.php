<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Media\MimeTypes;
use Illuminate\Http\Request;

class MediaTypesController extends Controller
{
    Public function index()
    {
        return response()->json([
            'data' => [
                'image' => MimeTypes::$image,
                'video' => MimeTypes::$video,
            ]
        ]);
    }
}
