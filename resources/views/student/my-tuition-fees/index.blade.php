@extends('layouts.app')

@section('title', 'My Tuition Fees')

@section('content')
    <div class="container mx-auto mb-4">

        <div class="mb-2">
            <x-breadcrumb :links="[
                'Home' => route('student.dashboard.index'),
                'My Tuition Fees' => route('student.my-tuition-fees.index'),
            ]" />
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold">My Tuition Fees</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Bulan</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                @if ($payment->status == 'pending')
                                    <button onclick="payNow({{ $payment->id }})"
                                        class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Pay
                                    </button>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
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
                {{ $payments->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
        <script>
            function payNow(paymentId) {
                fetch(`/student/payments/${paymentId}/pay`)
                    .then(res => res.json())
                    .then(data => {
                        snap.pay(data.token, {
                            onSuccess: function(result) {
                                alert("Payment successful!");
                                location.reload();
                            },
                            onPending: function(result) {
                                alert("Waiting for payment...");
                            },
                            onError: function(result) {
                                alert("Payment failed!");
                            },
                            onClose: function() {
                                alert("You closed the popup without completing the payment");
                            }
                        });
                    });
            }
    </script>
@endpush
