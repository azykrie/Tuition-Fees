<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $rooms = ClassRoom::query()
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })->latest()
        ->paginate(10);

        return view('admin.class-rooms.index', compact('rooms', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class-rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ClassRoom::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.class-rooms.index')->with('success', 'Class room created successfully.');
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
        $classRoom = ClassRoom::findOrFail($id);
        return view('admin.class-rooms.edit', compact('classRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.class-rooms.index')->with('success', 'Class room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->delete();

        return redirect()->route('admin.class-rooms.index')->with('success', 'Class room deleted successfully.');
    }
}
