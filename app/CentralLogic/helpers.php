<?php

namespace App\CentralLogics;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use app\Models\Business_settings;
use Exception;
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
    public static function order_status_update_message($status)
    {
        if ($status == 'pending') {
            $data = Business_settings::where('type', 'order_pending_message')->first()->value;
        } elseif ($status == 'confirmed') {
            $data = Business_settings::where('type', 'order_confirmation_msg')->first()->value;
        } elseif ($status == 'processing') {
            $data = Business_settings::where('type', 'order_processing_message')->first()->value;
        } elseif ($status == 'out_for_delivery') {
            $data = Business_settings::where('type', 'out_for_delivery_message')->first()->value;
        } elseif ($status == 'delivered') {
            $data = Business_settings::where('type', 'order_delivered_message')->first()->value;
        } elseif ($status == 'returned') {
            $data = Business_settings::where('type', 'order_returned_message')->first()->value;
        } elseif ($status == 'failed') {
            $data = Business_settings::where('type', 'order_failed_message')->first()->value;
        } elseif ($status == 'delivery_boy_delivered') {
            $data = Business_settings::where('type', 'delivery_boy_delivered_message')->first()->value;
        } elseif ($status == 'del_assign') {
            $data = Business_settings::where('type', 'delivery_boy_assign_message')->first()->value;
        } elseif ($status == 'ord_start') {
            $data = Business_settings::where('type', 'delivery_boy_start_message')->first()->value;
        } else {
            $data = '{"status":"0","message":""}';
        }

        $res = json_decode($data, true);

        if ($res['status'] == 0) {
            return 0;
        }
        return $res['message'];
    }





    public static function send_order_notification($order, $token){
        try{
            $status = $order->order_status;

            $value = self::order_status_update_message($status);

            if($value){
                $data = [
                    'title' => trans('messages.order_push_title'),
                    'description' => $value,
                    'order_id' => $order->id,
                    'image' => '',
                    'type' => 'order_status'
                ];

                self::send_push_notif_to_device($token, $data);

                try{
                    DB::table('user_notification')->insert([
                        'data' => json_encode($data),
                        'user_id' => $order->user_id,
                        'created_at' => now(),
                        'updated_at' => now()

                    ]);
                }catch(Exception $e){
                    return response()->json([$e], 403);

                }

                }

                return true;
            }catch(Exception $e) {
                info($e);
            }
            return false;


        }





    public static function send_push_notif_to_device($fcm_token, $data, $delivery = 0)
    {
        $key = Business_settings::where(['key' => 'push_notification_key'])->first()->value;
        $url = "https://fcm.googleapis.com/fcm/send";
        $header = array("authorization: key=" . $key . "",
            "content-type: application/json"
        );

        // if (isset($data['order_id']) == false) {
        //     $data['order_id'] = null;
        // }

        $postdata = '{
            "to" : "' . $fcm_token . '",
            "mutable_content": true,
            "data" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "image" : "' . $data['image'] . '",
                "order_id":"' . $data['order_id'] . '",
                "is_read": 0
              },
              "notification" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "order_id":"' . $data['order_id'] . '",
                "title_loc_key":"' . $data['order_id'] . '",
                "body_loc_key" : "' . $data['type'] . '",
                "type" : "' . $data['type'] . '",
                "is_read": 0,
                "icon" : "new",
                "android_channel_id" : "wku.food.et"
              }
        }';

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        if($result === FALSE){
            dd(curl_close($ch));
        }
        curl_close($ch);

        return $result;
    }
}
