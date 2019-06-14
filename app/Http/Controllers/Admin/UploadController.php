<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language;
use Alert;

class UploadController extends Controller {

    public function getPost(Request $request) {

        $destination = storage_path('uploads/' . $request->storage);
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move($destination, $imageName);
        return response()->json(['success' => $imageName]);
    }

    public function getPostImages(Request $request) {
        $destination = storage_path('uploads/project/');
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move($destination, $imageName);
        return response()->json(['success' => $imageName]);
    }

}
