<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class UploadController extends Controller
{
    /**
     * Simditor upload images
     */
    public function simditorUploadImages(Request $request)
    {
        \Debugbar::disable();

        $this->validate($request, [
            'files'    =>  'required|image',
        ]);

        $uploadSuccess = true;
        $uploadFilePath = [];
        foreach ($request->files as $image) {
            $uploadPath = 'uploads/simditor-images/';
            $fileName   = date('Ymd-His_') . str_random(6) . '_' . $image->getClientOriginalName();
            $imagePath = '/' . $uploadPath . $fileName;

            $contents = file_get_contents($image->getRealPath());

            if (Storage::put($imagePath, $contents)) {
                $uploadFilePath[] = $imagePath;
            } else {
                $uploadSuccess = false;
                $uploadFilePath[] = '';
            }
        }

        $res = (object) [
            'success'   =>  $uploadSuccess,
            'file_path' =>  $uploadFilePath,
        ];
        return json_encode($res);
    }

    /**
     * Simditor upload images
     */
    public function ckeditorUploadImages(Request $request)
    {
        \Debugbar::disable();

        $this->validate($request, [
            'upload'    =>  'required|image',
        ]);

        $uploadSuccess = false;
        $uploadFileName = null;
        $uploadFilePath = null;
        $uploadErrorMessage = '未知错误，图片上传失败';

        $image = $request->upload;

        $uploadPath = 'uploads/ckeditor-images/';
        $fileName   = date('Ymd-His_') . str_random(6) . '_' . $image->getClientOriginalName();
        $imagePath = '/' . $uploadPath . $fileName;

        $contents = file_get_contents($image->getRealPath());

        if (Storage::put($imagePath, $contents)) {
            $uploadSuccess = true;
            $uploadFilePath = makeCdnAssetPath($imagePath);
            $uploadFileName = $fileName;
        } else {
            $uploadSuccess = false;
            $uploadErrorMessage = '未知错误，图片上传失败';
        }

        $res = (object) [
            'uploaded'      =>  $uploadSuccess,
            'fileName'      =>  $uploadFileName,
            'url'           =>  $uploadFilePath,
            'error'         =>  [
                'message'       =>  $uploadErrorMessage,
            ],
        ];

        return json_encode($res);
    }
}
