<?php

namespace App\Jobs\Image;


use Illuminate\Http\Request;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Models\Image;

class ImageUpload extends Job implements SelfHandling
{
    use DispatchesJobs;

    public $request ;

    public $ext = ['jpg','png','jpeg','gif'];


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();
        \Log::info($data);

        $file = $this->request->file('file');

        //检查文件是否存在
        if($file && $file->isValid()){

            $file_extension = $file->getClientOriginalExtension();

            if(!in_array(strtolower($file_extension),$this->ext)){

                self::throwException('10006',trans('error.10006',['ext'=>implode(',',$this->ext)]));
//                throw new ResourceException('只允许上传'.implode(',',$this->ext).'格式后缀的图片!',null,null,[],1);
            }

            $upload_dir = '/uploads/Customer/';

            //文件保存目录
            $file_dir = public_path().$upload_dir;

            //文件保存名称
            $file_name = time().str_random(8).'.'.$file_extension;

            //保存文件
            $file->move($file_dir,$file_name);

            $imageUtil = \ImageUtil::make($file_dir.$file_name);

            //同时调整宽高
            $imageUtil = $imageUtil->fit(300,300);

            $imageUtil = $imageUtil->save();

            //保存图片数据
            $image_data = [
                'name' => $file_name,
                'alt'   =>  '',
                'url'   => $upload_dir.$file_name,
                'path' => $file_dir.$file_name,
                'extension'=>$file_extension
            ];

            try{

                $image = new Image();
                $image->fill($image_data);
                $image->save();



                return $image;

            }catch (\Exception $e){

                @unlink($file_dir.$file_name);


                self::throwException('10007');
                //throw new ResourceException('图片资源保存失败!',null,null,[],1);

            }

        }
        else{
            self::throwException('10008');
//            throw new ResourceException('上传的图片资源不存在!',null,null,[],1);
        }


    }
}
