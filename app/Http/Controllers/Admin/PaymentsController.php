<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payment;
use App\Models\TuitionFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $payments = Payment::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate();

        return view('admin.payments.index', compact('payments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $tuitionFees = TuitionFee::all();
        return view('admin.payments.create', compact('students', 'tuitionFees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tuition_fee_id' => 'required|exists:tuition_fees,id',
            'month' => 'required|date',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,failed',
        ]);

        Payment::create([
            'user_id' => $request->user_id,
            'tuition_fee_id' => $request->tuition_fee_id,
            'month' => $request->month . '-01', 
            'payment_date' => $request->payment_date,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Payment created successfully');
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
