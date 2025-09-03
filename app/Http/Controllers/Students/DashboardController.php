<?php

namespace App\Http\Controllers\Students;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $totalPending = Payment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('tuitionFee')
            ->get()
            ->sum(fn($payment) => $payment->tuitionFee->amount);

        $totalPaid = Payment::where('user_id', $user->id)
            ->where('status', 'completed')
            ->with('tuitionFee')
            ->get()
            ->sum(fn($payment) => $payment->tuitionFee->amount);

        $pendingTransactions = Payment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // 🔹 Jumlah transaksi completed
        $completedTransactions = Payment::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        return view('student.dashboard.index', compact('totalPending', 'totalPaid', 'pendingTransactions', 'completedTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
