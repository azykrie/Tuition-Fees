<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ClassRoom;
use App\Models\ClassRooms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::query()
            ->when(
                $search,
                fn($query) =>
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%")
                    ->orWhere('class_id', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users-table.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classRooms = ClassRoom::all();
        return view('admin.users-table.create', compact('classRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,student',
            'class_id' => 'nullable|exists:class_rooms,id',
            'nim' => 'nullable|string|max:255|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'class_id' => $request->class_id,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
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
        $classRooms = ClassRoom::all();
        $user = User::findOrFail($id);
        return view('admin.users-table.edit', compact('user', 'classRooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,student',
            'password' => 'nullable|string|min:8|confirmed',
            'class_id' => 'nullable|exists:class_rooms,id',
            'nim' => 'nullable|string|max:255|unique:users',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->class_id = $request->class_id;
        $user->nim = $request->nim;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = "data.csv";
        $users = User::all();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($users) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Email']);

            foreach ($users as $user) {
                fputcsv($handle, [$user->id, $user->name, $user->email, $user->role, $user->class_id, $user->nim]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportSql()
    {
        $users = User::all();
        $fileName = "data.sql";

        $sql = "";
        foreach ($users as $user) {
            $sql .= "INSERT INTO users (id, name, email, role, class_id, nim) VALUES ($user->id, '$user->name', '$user->email', '$user->role', $user->class_id, '$user->nim');\n";
        }

        return response($sql)
            ->header('Content-Type', 'application/sql')
            ->header('Content-Disposition', "attachment; filename=$fileName");
    }
}
