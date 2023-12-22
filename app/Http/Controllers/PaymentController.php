<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaymentController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPayment()
    {
        return view('payment.payment');
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processPayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success'),
                "cancel_url" => route('payment.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "200.00"
                    ]
                ]
            ]
        ]);
        // dd($response);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('payment.form')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('payment.form')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successPayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        // dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            Transaction::create([
                'user_id' => Auth::user()->id,
                'amount' => 200,
                'transaction_id' => $response['id'],
                'status' => $response['status'],
            ]);
            return redirect()
                ->route('result')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('result')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelPayment(Request $request)
    {
        return redirect()
            ->route('payment.form')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
