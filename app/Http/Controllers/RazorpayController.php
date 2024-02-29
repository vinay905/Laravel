<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\payment;
use Exception;

class RazorpayController extends Controller
{
    public function paymentreq()
    {
        return view("razorpay");
    }

    public function paymentres(Request $request)
    {
        $data = $request->all();
        $apicall = new Api(env("RAZORPAY_API_KEY"), env("RAZORPAY_API_SECRET"));
        $payment = $apicall->payment->fetch($data['razorpay_payment_id']);
        if (count($data) && !empty($data['razorpay_payment_id'])) {
            try {
                $response = $apicall->payment->fetch($data['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment =([
                    'payment_id' => $response['id'],
                    'product_name' => $response['notes']['product_name'],
                    'quantity' => $response['notes']['quantity'],
                    'amount' => $response['amount']/100,
                    'currency' => $response['currency'],
                    'customer_name' => $response['notes']['customer_name'],
                    'customer_email' => $response['notes']['customer_email'],
                    'payment_status' => $response['status'],
                    'payment_method' => 'Razorpay',
                ]);
                if(Payment::create($payment)){
                    echo "working";
                }
                else
                    echo "not working";
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return back()->withError($e->getMessage());
            }
            return back()->withSuccess('Payment done.');
        }
    }
}
