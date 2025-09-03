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

        $payments = Payment::with(['user', 'tuitionFee'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('tuitionFee', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('month', 'like', "%{$search}%");
            })
            ->where('status', '!=', 'completed')
            ->latest()
            ->paginate(10);

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
        $rules = [
            'tuition_fee_id' => 'required|exists:tuition_fees,id',
            'month' => 'required|date',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,failed',
        ];

        if (!$request->has('all_students')) {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $request->validate($rules);

        if ($request->has('all_students')) {
            $students = User::where('role', 'student')->get();
            foreach ($students as $student) {
                Payment::create([
                    'user_id' => $student->id,
                    'tuition_fee_id' => $request->tuition_fee_id,
                    'month' => $request->month . '-01',
                    'payment_date' => $request->payment_date,
                    'status' => $request->status,
                ]);
            }
        } else {
            Payment::create([
                'user_id' => $request->user_id,
                'tuition_fee_id' => $request->tuition_fee_id,
                'month' => $request->month . '-01',
                'payment_date' => $request->payment_date,
                'status' => $request->status,
            ]);
        }

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
        $payment = Payment::findOrFail($id);
        $students = User::where('role', 'student')->get();
        $tuitionFees = TuitionFee::all();

        return view('admin.payments.edit', compact('payment', 'students', 'tuitionFees'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tuition_fee_id' => 'required|exists:tuition_fees,id',
            'month' => 'required|date',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update([
            'user_id' => $request->user_id,
            'tuition_fee_id' => $request->tuition_fee_id,
            'month' => $request->month . '-01',
            'payment_date' => $request->payment_date,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully');
    }
}
