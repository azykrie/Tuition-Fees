<?php

namespace App\Http\Controllers\Admin;

use App\Models\TuitionFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TuitionFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tuitionFees = TuitionFee::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view("admin.tuition-fees.index", compact('tuitionFees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tuition-fees.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        TuitionFee::create([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.tuition-fees.index')->with('success', 'Tuition Fee created successfully.');
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
        $tuitionFee = TuitionFee::findOrFail($id);
        return view("admin.tuition-fees.edit", compact('tuitionFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $tuitionFee = TuitionFee::findOrFail($id);
        $tuitionFee->update([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.tuition-fees.index')->with('success', 'Tuition Fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tuitionFee = TuitionFee::findOrFail($id);
        $tuitionFee->delete();

        return redirect()->route('admin.tuition-fees.index')->with('success', 'Tuition Fee deleted successfully.');
    }
}
