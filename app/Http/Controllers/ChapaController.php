<?php
namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use App\CentralLogics\Helpers;
use App\CentralLogics\OrderLogic;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Chapa\Chapa\Facades\Chapa as Chapa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ChapaController extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    protected $reference;

    public function __construct(){
        $this->reference = \Chapa\Chapa\Facades\Chapa::generateReference();

    }
    public function initialize(Request $request)
    {
        //This generates a payment reference
        $reference = $this->reference;

        $customer_id = $request->input('customer_id');
        $order_id = $request->input('order_id');
        // dd($order_id);
        // $order = Order::where(['id' => session('order_id'), 'user_id' => session('customer_id')])->first();
        // if ($order) {
        //     $order_id = $order->order_amount;
        //     dd($order_id);
        // } else {
        //     dd('Order not found');
        // }



        $order = Order::where(['id' => $order_id])->first();
        if ($order) {
            $number = $order->order_amount;
            // $user_id = $order->user_id;
            // $user = User::where(['id' => $user_id])->first();
            // $name = $user->f_name;
        } else {
            // handle the case where the order is not found
            dd("still?");

        }














        // Enter the details of the payment
        $data = [

            'amount' =>  $number,
            'email' => 'natnaelbirhanu22@gmail.com',
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback',[$reference]),
            'first_name' => "Natnael",
            'last_name' => "Birhanu",
            "customization" => [
                "title" => 'Pactical Chapa',
                "description" => "WKU Food delivery "
            ]
        ];

        //new

        DB::table('orders')
        ->where('id', $order->id)
        ->update([
            // 'transaction_reference' =>  $reference,
            // 'payment_method' => 'Chapa',
            'order_status' => 'success',
            'failed' => now(),
            'updated_at' => now()
        ]);

//first put a stop at here and check your info (need to be same as your Chapa profile)
    //    dd($data);
        $payment = \Chapa\Chapa\Facades\Chapa::initializePayment($data);
//now Check if the payment returns 'success' or 'fail'
//   dd($payment);
        if ($payment['status'] !== 'success') {
            // notify something went wrong
            dd($payment->errorMessage);
            return;
        }

        return redirect($payment['data']['checkout_url']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback($reference)
    {

        $data = Chapa::verifyTransaction($reference);
        // dd($data);

        //if payment is successful
        if ($data['status'] ==  'success') {

            // return redirect('&status=success');

        // dd($data);
        }

        else{

            //oopsie something ain't right.
        }


    }
}
