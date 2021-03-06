<?php

namespace App\Jobs\Customer;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateCustomerQrcode extends Job implements SelfHandling
{
    /**
     * @var Request
     */
    public $request;

    /**
     * 构造函数
     *
     * CreateCustomerQrcode constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 创建用户二维码
     *
     * @return \App\User|null
     * @author jiangxianli
     * @created_at 2019-04-24 9:57
     */
    public function handle()
    {
        $data = $this->request->all();

        $customer = \Auth::user();

        if ($customer) {

            if (!$customer->qrcode) {
                $qrcode_name = time() . str_random(10) . '.png';
                $qrcode_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/qrCode/';

                $url = env('WAP_DOMAIN') . '/#/' . $customer->uuid . '/detail';

                if (!file_exists($qrcode_dir)) {
                    mkdir($qrcode_dir, 0777);
                }

                \QrCode::format('png')->size(400)->margin(0.2)->color(40, 40, 40)->errorCorrection('Q')->generate($url, $qrcode_dir . $qrcode_name);

                \DB::beginTransaction();

                try {
                    $image_data = [
                        'name'      => $qrcode_name,
                        'alt'       => '',
                        'url'       => '/uploads/qrCode/' . $qrcode_name,
                        'path'      => $qrcode_dir . $qrcode_name,
                        'extension' => 'png'
                    ];

                    $image = new Image();
                    $image->fill($image_data);
                    $image->save();

                    $customer->qrcode = $image->id;
                    $customer->save();

                    \DB::commit();

                } catch (\Exception $e) {

                    \DB::rollBack();
                }
            }
        }

        return $customer;
    }
}
