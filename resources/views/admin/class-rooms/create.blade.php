@extends('layouts.app')

@section('title', 'Create Class Room')

@section('content')
<div class="container mx-auto mb-6">
    <div class="mb-2">
        <x-breadcrumb :links="[
            'Home' => route('admin.dashboard.index'),
            'Class Rooms' => route('admin.class-rooms.index'),
            'Create' => route('admin.class-rooms.create'),
        ]" />
    </div>

    <div class="mb-4">
        <h1 class="text-2xl text-white font-semibold mb-4">Create Class Room</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.class-rooms.store') }}" method="POST" class="w-full">
            @csrf

            {{-- Name --}}
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Name Class
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="shadow-xs bg-gray-50 border @error('name') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="10-RPL-1" required>
                @error('name')
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
                <a href="{{ route('admin.class-rooms.index') }}" type="button"
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
