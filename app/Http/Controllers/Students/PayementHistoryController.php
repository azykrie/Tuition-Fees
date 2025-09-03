<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PayementHistoryController extends Controller
{
    public function index(Request $request)
    {
        $paymentHistory = Payment::with('tuitionFee')
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->paginate(10);
        return view('student.payment-history.index', compact('paymentHistory'));
    }
}
