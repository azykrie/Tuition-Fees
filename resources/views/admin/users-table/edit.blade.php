@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <div class="container mx-auto mb-6">
        <div class="mb-2">
            <x-breadcrumb :links="[
                'Home' => route('admin.dashboard.index'),
                'Users' => route('admin.users.index'),
                'Edit' => route('admin.users.edit', $user->id),
            ]" />
        </div>

        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold mb-4">Edit User</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-md rounded-lg p-6">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="w-full">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="John Doe" required />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="name@example.com" required />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        role</label>
                    <select name="role"
                        class="shadow-xs bg-gray-50 border  text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        required>
                        <option value="">Select a role</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="student" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Student
                        </option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
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
                            <option value="{{ $classRoom->id }}"
                                {{ old('class_id', $user->class_id) == $classRoom->id ? 'selected' : '' }}>
                                {{ $classRoom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Update
                </button>

                <a href="{{ route('admin.users.index') }}"
                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    Cancel
                </a>
            </form>
        </div>
    </div>

@endsection
