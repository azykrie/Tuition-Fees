<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentHistory extends Controller
{
    public function index()
    {
        $paymentHistory = Payment::with('tuitionFee')
            ->where('status', 'completed')
            ->paginate(10);

        return view('admin.payment-history.index', compact('paymentHistory'));
    }
}
