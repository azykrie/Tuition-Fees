@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container mx-auto mb-4">

        <div class="mb-2">
            <x-breadcrumb :links="[
                'Home' => route('student.dashboard.index'),
                'Settings' => route('student.settings.index'),
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
        <div
            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 p-6">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-xl font-semibold text-gray-900 dark:text-white">User Info</h5>
                <a href="{{ route('student.settings.edit') }}"
                    class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Edit
                </a>
            </div>
            <div class="space-y-2">
                <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Nama:</span> {{ $user->name }}</p>
                <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                <p class="text-gray-700 dark:text-gray-300"><span class="font-semibold">Password:</span> ••••••••</p>
            </div>
        </div>

    @endsection
