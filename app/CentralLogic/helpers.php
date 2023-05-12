<?php

namespace App\CentralLogics;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use app\Models\Business_settings;
use Illuminate\Support\Facades\DB;

class Helpers
{
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
    public static function get_business_settings($name){
        $config = null;
        $paymentmethod = Business_settings::where('key', $name)->first();
        if($paymentmethod){
            $config = json_decode(json_encode($paymentmethod->value), true);
            $config = json_decode($config, true);
        }
        return $config;
    }
}
