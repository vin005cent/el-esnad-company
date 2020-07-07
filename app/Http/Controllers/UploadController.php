<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager as Image;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload/index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(!$request->file('file')) {
            return redirect()->back();
        }

        $image = $request->file('file');
        $input['imagename'] = time().'.'.$image->extension();

        $img = new Image();

        //50x50
        $destinationPath = public_path('/uploads/thumbnail');
        $imageFullPath   = $destinationPath.'/'.$input['imagename'];
        $img->make($image->path())
            ->resize(50,50)
            ->save($imageFullPath);

        //10x10
        $destinationPath = public_path('/uploads/thumbnail2');
        $imageFullPath   = $destinationPath.'/'.$input['imagename'];
        $img->make($image->path())
            ->resize(100,100)
            ->save($imageFullPath);

        //original size
        $destinationPath = public_path('/uploads/images');
        $image->move($destinationPath, $input['imagename']);

        return redirect()->back()
            ->with(['flash_success_message' => 'Image Uploaded Successfully'])
            ->with('imageName',$input['imagename']);

    }
}
