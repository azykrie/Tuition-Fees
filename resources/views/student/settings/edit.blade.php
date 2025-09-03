@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container mx-auto mb-4">

        <div class="mb-2">
            <x-breadcrumb :links="[
                'Home' => route('student.dashboard.index'),
                'Settings' => route('student.settings.index'),
                'Edit' => route('student.settings.edit'),
            ]" />
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold">Settings</h1>
        </div>
        <div class="max-w-md mx-auto bg-gray-800 border border-gray-700 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-white mb-4">Edit User Info</h2>

            <form action="{{ route('student.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="mt-1 block w-full rounded-md border border-gray-600 bg-gray-700 text-white p-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="mt-1 block w-full rounded-md border border-gray-600 bg-gray-700 text-white p-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 block w-full rounded-md border border-gray-600 bg-gray-700 text-white p-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Empty if you don't want to change">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-2">
                    <a href="{{ route('student.settings.index') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:ring-2 focus:ring-red-400">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
