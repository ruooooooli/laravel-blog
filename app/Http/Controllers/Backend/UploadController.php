<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 文件上传
 */
class UploadController extends Controller
{
    /**
     * 文件对象
     */
    protected $file;

    /**
     * 允许上传的文件类型
     */
    protected $allowedExtensions = ['png', 'jpg', 'gif', 'jpeg'];

    /**
     * 处理上传
     */
    public function uploadImage(Request $request)
    {
        try {
            $result = $this->doUpload($request);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        return successJson('文件上传成功!', $result);
    }

    /**
     * 真正的上传
     */
    private function doUpload(Request $request)
    {
        if (!$request->hasFile(config('blog.uploadFileKey'))) {
            throw new \Exception('请选择上传的文件!');
        }

        $this->file = $request->file(config('blog.uploadFileKey'));
        $this->checkAllowedExtensionsOrFail();

        return $this->saveImageToLocal(1440);
    }

    /**
     * 检测文件类型
     */
    private function checkAllowedExtensionsOrFail()
    {
        $extension = strtolower($this->file->getClientOriginalExtension());

        if (!in_array($extension, $this->allowedExtensions)) {
            throw new \Exception('请上传:'.implode($this->allowedExtensions, ',').'类型的文件!');
        }
    }

    /**
     * 保存文件到本地
     */
    private function saveImageToLocal($resize, $filename = '')
    {
        $uploadFolder   = trim(config('blog.uploadFolder'), '/');
        $folderName     = $uploadFolder.'/'.date('Ym/d').'/';
        $destinationPath= public_path($folderName);
        $extension      = $this->file->getClientOriginalExtension() ?: 'png';
        $saveName       = $filename ?: str_random(16).'.'.$extension;
        $fullName       = $destinationPath.$saveName;
        $publicName     = $folderName.$saveName;

        $this->file->move($destinationPath, $saveName);
        $this->resize($fullName, $resize);

        return array(
            'fullPath'      => $fullName,
            'webPath'       => asset($publicName),
            'markdownPath'  => '![file]('.asset($publicName).')',
        );
    }

    /**
     * 调整图片大小
     */
    private function resize($path, $resize)
    {
        if ($this->file->getClientOriginalExtension() == 'gif') {
            return false;
        }

        $image = Image::make($path);
        $image->resize($resize, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save();
    }
}
