@extends('layouts.app')

@section('title', 'Create Payment')

@section('content')
    <div class="container mx-auto mb-6">
        <div class="mb-2">
            <x-breadcrumb :links="[
                'Home' => route('admin.dashboard.index'),
                'Payments' => route('admin.payments.index'),
                'Create' => route('admin.payments.create'),
            ]" />
        </div>

        <div class="mb-4">
            <h1 class="text-2xl text-white font-semibold mb-4">Create Payment</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-md rounded-lg p-6">
            <form action="{{ route('admin.payments.store') }}" method="POST" class="w-full">
                @csrf

                {{-- Student --}}
                <div class="mb-5">
                    <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Select Students
                    </label>
                    <div class="flex items-center mb-3">
                        <input type="checkbox" id="all_students" name="all_students" value="1" class="mr-2">
                        <label for="all_students" class="text-gray-900 dark:text-white">Apply to all students</label>
                    </div>

                    <div id="student_select">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Select Student
                        </label>
                        <select id="user_id" name="user_id"
                            class="shadow-xs bg-gray-50 border text-gray-900 text-sm rounded-md block w-full p-2.5 
        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Choose Student --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->nim }})</option>
                            @endforeach
                        </select>
                    </div>

                    @error('user_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tuition Fee --}}
                <div class="mb-5">
                    <label for="tuition_fee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Select Tuition Fee
                    </label>
                    <select id="tuition_fee_id" name="tuition_fee_id" required
                        class="shadow-xs bg-gray-50 border @error('tuition_fee_id') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="">-- Choose Tuition Fee --</option>
                        @foreach ($tuitionFees as $fee)
                            <option value="{{ $fee->id }}" {{ old('tuition_fee_id') == $fee->id ? 'selected' : '' }}>
                                {{ $fee->name }} - Rp{{ number_format($fee->amount, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('tuition_fee_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Month --}}
                <div class="mb-5">
                    <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Month
                    </label>
                    <input type="month" id="month" name="month" value="{{ old('month') }}"
                        class="shadow-xs bg-gray-50 border @error('month') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        required>
                    @error('month')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Payment Date --}}
                <div class="mb-5">
                    <label for="payment_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Payment Date (optional)
                    </label>
                    <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date') }}"
                        class="shadow-xs bg-gray-50 border @error('payment_date') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('payment_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-5">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status
                    </label>
                    <select id="status" name="status"
                        class="shadow-xs bg-gray-50 border @error('status') border-red-500 @enderror text-gray-900 text-sm rounded-md 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                    @error('status')
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
                    <a href="{{ route('admin.payments.index') }}" type="button"
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

@push('scripts')
    <script>
        const toggle = document.getElementById('all_students');
        const studentSelect = document.getElementById('student_select');
        const userSelect = document.getElementById('user_id');

        toggle.addEventListener('change', function() {
            if (this.checked) {
                studentSelect.style.display = 'none';
                userSelect.removeAttribute('name');
            } else {
                studentSelect.style.display = 'block';
                userSelect.setAttribute('name', 'user_id');
            }
        });
    </script>
@endpush
