@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container mx-auto mb-2">
        <div class="mb-2">
            <x-breadcrumb :links="['Home' => route('admin.dashboard.index')]" />
        </div>

        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold">Dashboard</h1>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">
                    Total Students
                </h5>
                <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                    {{ $totalStudents }}
                </p>
            </div>

            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">
                    Total Admin
                </h5>
                <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                    {{ $totalAdmin }}
                </p>
            </div>

            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">
                    Cash in
                </h5>
                <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                    Rp. {{ number_format($totalAmount) }}
                </p>
            </div>

            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">
                    Complete Transaction
                </h5>
                <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                    {{ $completedTransactions }}
                </p>
            </div>

            <div
                class="w-full p-6 bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">
                    Pending Transaction
                </h5>
                <p class="text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                    {{ $pendingTransactions }}
                </p>
            </div>
        </div>
    </div>
@endsection
