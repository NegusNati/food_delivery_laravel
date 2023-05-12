<?php

namespace App\Http\Controllers;

use Chapa\Chapa\Facades\Chapa as Chapa;

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
    public function initialize()
    {
        //This generates a payment reference
        $reference = $this->reference;


        // Enter the details of the payment
        $data = [

            'amount' => 201,
            'email' => 'natnaelbirhanu22@gmail.com',
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback',[$reference]),
            'first_name' => "Natnael",
            'last_name' => "Birhanu",
            "customization" => [
                "title" => 'Chapa using test',
                "description" => "the test yes "
            ]
        ];
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


        // dd($data);
        }

        else{

            //oopsie something ain't right.
        }


    }
}
