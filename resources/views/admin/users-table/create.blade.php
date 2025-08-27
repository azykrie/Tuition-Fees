@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container mx-auto mb-6">
    <div class="mb-2">
        <x-breadcrumb :links="[
            'Home' => route('admin.dashboard.index'),
            'Users' => route('admin.users.index'),
            'Create' => route('admin.users.create'),
        ]" />
    </div>

    <div class="mb-4">
        <h1 class="text-2xl text-white font-semibold mb-4">Create User</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.users.store') }}" method="POST" class="w-full">
            @csrf

            {{-- Name --}}
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Full Name
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="shadow-xs bg-gray-50 border @error('name') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="John Doe" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Email
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="shadow-xs bg-gray-50 border @error('email') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="name@example.com" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div class="mb-5">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Role
                </label>
                <select id="role" name="role"
                    class="shadow-xs bg-gray-50 border @error('role') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required>
                    <option value="">-- Select role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIM (Student only) --}}
            <div class="mb-5">
                <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    NIM
                </label>
                <input type="number" id="nim" name="nim" value="{{ old('nim') }}"
                    class="shadow-xs bg-gray-50 border @error('nim') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="12345678">
                @error('nim')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Class Room (Student only) --}}
            <div class="mb-5">
                <label for="class_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Class Room
                </label>
                <select id="class_id" name="class_id"
                    class="shadow-xs bg-gray-50 border @error('class_id') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <option value="">-- Select class --</option>
                    @foreach ($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}" {{ old('class_id') == $classRoom->id ? 'selected' : '' }}>
                            {{ $classRoom->name }}
                        </option>
                    @endforeach
                </select>
                @error('class_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Password
                </label>
                <input type="password" id="password" name="password"
                    class="shadow-xs bg-gray-50 border @error('password') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Confirm Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="shadow-xs bg-gray-50 border @error('password_confirmation') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required>
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-2">
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 
                    font-medium rounded-md text-sm px-4 py-2 
                    dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Create
                </button>
                <a href="{{ route('admin.users.index') }}" type="button"
                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 
                    font-medium rounded-md text-sm px-4 py-2 
                    dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
