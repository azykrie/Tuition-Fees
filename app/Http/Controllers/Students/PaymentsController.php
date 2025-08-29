<?php

namespace App\Http\Controllers\Students;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::with('tuitionFee')
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view("student.my-tuition-fees.index", compact('payments'));
    }

    public function pay(Payment $payment)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'PAY-' . $payment->id . '-' . time(),
                'gross_amount' => $payment->tuitionFee->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->user->name,
                'email' => $payment->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['token' => $snapToken]);
    }


    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash(
            "sha512",
            $request->order_id . $request->status_code . $request->gross_amount . $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $request->order_id;
        $paymentId = explode('-', $orderId)[1];

        $payment = Payment::find($paymentId);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        switch ($request->transaction_status) {
            case 'capture':
            case 'settlement':
                $payment->update([
                    'status' => 'completed',
                    'payment_date' => now(),
                ]);
                break;

            case 'pending':
                $payment->update(['status' => 'pending']);
                break;

            case 'deny':
            case 'expire':
            case 'cancel':
                $payment->update(['status' => 'failed']);
                break;
        }

        return response()->json(['message' => 'Callback processed']);
    }

}
