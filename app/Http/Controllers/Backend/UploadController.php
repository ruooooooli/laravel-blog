<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    protected $file;
    protected $allowedExtensions = ['png', 'jpg', 'gif', 'jpeg'];

    public function uploadImage(Request $request)
    {
        try {
            $result = $this->doUpload($request);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文件上传成功!', $result);
    }

    private function doUpload(Request $request)
    {
        if (!$request->hasFile(config('blog.uploadFileKey'))) {
            throw new \Exception('请选择上传的文件!');
        }

        $this->file = $request->file(config('blog.uploadFileKey'));
        $this->checkAllowedExtensionsOrFail();

        return $this->saveImageToLocal(1440);
    }

    private function checkAllowedExtensionsOrFail()
    {
        $extension = strtolower($this->file->getClientOriginalExtension());

        if (!in_array($extension, $this->allowedExtensions)) {
            throw new \Exception('请上传:'.implode($this->allowedExtensions, ',').'类型的文件!');
        }
    }

    private function saveImageToLocal($resize, $filename = '')
    {
        $uploadFolder   = trim(config('blog.uploadFolder'), '/');
        $folderName     = $uploadFolder.'/'.date('Ym/d').'/';
        $destinationPath= public_path($folderName);
        $extension      = $this->file->getClientOriginalExtension() ?: 'png';
        $saveName       = $filename ?: str_random(16).'.'.$extension;
        $this->file->move($destinationPath, $saveName);
        $this->resize($destinationPath, $saveName, $resize);

        return array(
            'fullPath'      => $destinationPath.$saveName,
            'webPath'       => asset($folderName.$saveName),
            'markdownPath'  => '![file]('.asset($folderName.$saveName).')',
        );
    }

    private function resize($path, $name, $resize)
    {
        if ($this->file->getClientOriginalExtension() == 'gif') {
            return false;
        }

        $image = \Image::make($path.$name);
        $image->resize($resize, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save();
    }
}
