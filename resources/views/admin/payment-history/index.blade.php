@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
    <div class="container mx-auto mb-4">

        <div class="mb-2">
            <x-breadcrumb :links="[
                'Home' => route('admin.dashboard.index'),
                'Payment History' => route('admin.payment-history.index'),
            ]" />
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold">Payment History</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Name Tuition</th>
                        <th scope="col" class="px-6 py-3">Month</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paymentHistory as $payment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $payment->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $payment->tuitionFee->name }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ \Carbon\Carbon::parse($payment->month)->translatedFormat('F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($payment->tuitionFee->amount) }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($payment->status == 'completed')
                                    <span class="text-green-600 font-semibold">Success</span>
                                @elseif($payment->status == 'pending')
                                    <span class="text-yellow-600 font-semibold">Pending</span>
                                @else
                                    <span class="text-red-600 font-semibold">Failed</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Print Receipt
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No tuition fees found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $paymentHistory->links() }}
            </div>
        </div>
    </div>
@endsection
