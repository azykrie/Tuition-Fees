@extends('layouts.app')

@section('title', 'Payments')

@section('content')

    <div class="container mx-auto mb-4">

        <div class="mb-2">
            <x-breadcrumb :links="['Home' => route('admin.dashboard.index'), 'Payments' => route('admin.payments.index')]" />
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif


        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold">All Payments</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div
                class="flex flex-col gap-3 pb-4 bg-white dark:bg-gray-900 px-4 md:flex-row md:items-center md:justify-between">
                <!-- Search form -->
                <form method="GET" action="{{ route('admin.payments.index') }}"
                    class="flex flex-col sm:flex-row sm:items-center gap-2 w-full md:w-auto">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ $search }}"
                            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 
                       focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                       dark:placeholder-gray-400 dark:text-white"
                            placeholder="Search for items">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 w-full sm:w-auto">
                            Search
                        </button>

                        @if ($search)
                            <a href="{{ route('admin.payments.index') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 w-full sm:w-auto text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Buttons -->
                <div class="flex gap-2 md:gap-3 w-full md:w-auto">
                    <a href="{{ route('admin.payments.create') }}"
                        class="flex-1 md:flex-none text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        + Create
                    </a>
                </div>
            </div>



            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name Student
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name Tuitions Fee
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $payment->name }}
                            </th>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                    class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>

                                <button data-modal-target="popup-modal-{{ $payment->id }}"
                                    data-modal-toggle="popup-modal-{{ $payment->id }}"
                                    class="text-sm text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-700 font-medium">
                                    Delete
                                </button>

                                <div id="popup-modal-{{ $payment->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                           hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex 
                           justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="popup-modal-{{ $payment->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>

                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    Are you sure you want to delete this class?
                                                </h3>
                                                <div class="flex items-center justify-center">
                                                    <form action="{{ route('admin.class-rooms.destroy', $room->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none 
                                       focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg 
                                       text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Yes, I'm sure
                                                        </button>
                                                    </form>
                                                    <button data-modal-hide="popup-modal-{{ $room->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none 
                                   bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 
                                   focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 
                                   dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 
                                   dark:hover:text-white dark:hover:bg-gray-700">
                                                        No, cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No Payments found.
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
