@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <div class="container mx-auto mb-4">

        <div class="mb-2">
            <x-breadcrumb :links="['Home' => route('admin.dashboard.index'), 'Users' => route('admin.users.index')]" />
        </div>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif


        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold">All users</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div
                class="flex flex-col gap-3 pb-4 bg-white dark:bg-gray-900 px-4 md:flex-row md:items-center md:justify-between">
                <!-- Search form -->
                <form method="GET" action="{{ route('admin.users.index') }}"
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
                            <a href="{{ route('admin.users.index') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 w-full sm:w-auto text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Buttons -->
                <div class="flex gap-2 md:gap-3 w-full md:w-auto">
                    <a href="{{ route('admin.users.create') }}"
                        class="flex-1 md:flex-none text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        + Create
                    </a>

                    <div class="flex-1 md:flex-none">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" type="button"
                            class="w-full text-gray-900 bg-white hover:bg-gray-100 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center justify-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1-1 1v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-4m5-13v4a1 1 0 0 1-1 1H5m0 6h9m0 0-2-2m2 2-2 2" />
                            </svg>
                            Exports
                        </button>

                        <div id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="{{ route('admin.export.csv') }}"
                                        class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        CSV
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.export.sql') }}"
                                        class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        SQL
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>

                                <button data-modal-target="popup-modal-{{ $user->id }}"
                                    data-modal-toggle="popup-modal-{{ $user->id }}"
                                    class="text-sm text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-700 font-medium">
                                    Delete
                                </button>

                                <div id="popup-modal-{{ $user->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                           hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex 
                           justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="popup-modal-{{ $user->id }}">
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
                                                    Are you sure you want to delete this user?
                                                </h3>
                                                <div class="flex items-center justify-center">
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
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
                                                    <button data-modal-hide="popup-modal-{{ $user->id }}"
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
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>


@endsection
