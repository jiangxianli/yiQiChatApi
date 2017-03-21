<?php

namespace App\Jobs\Customer;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Jobs\Job;
use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;

class NearbyCustomers extends Job implements SelfHandling
{
    public $request ;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle()
    {

        $data = $this->request->all();

        if(\Auth::check()){

            $customer = \Auth::user();

            if($customer->lng && $customer->lat){

                //10000KM内
                $circleDistance = AppHelper::returnSquarePoint($customer->lng,$customer->lat,10000);

                $customers = Customer::where('id','!=',$customer->id)->where(function($query) use ($circleDistance){

                    $query->where('lat','!=',0)->where('lat','>',$circleDistance['right-bottom']['lat'])->where('lat','<',$circleDistance['left-top']['lat']);

                })->where(function($query) use ($circleDistance){

                    $query->where('lng','<',$circleDistance['right-bottom']['lng'])->where('lng','>',$circleDistance['left-top']['lng']);

                })->get();

                return $customers;

                    //$info_sql = "select id,locateinfo,lat,lng from `lbs_info` where lat<>0 and lat>{$squares['right-bottom']['lat']} and lat<{$squares['left-top']['lat']} and lng>{$squares['left-top']['lng']} and lng<{$squares['right-bottom']['lng']} ";

            }
        }
    }
}
