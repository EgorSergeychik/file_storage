<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Shared Files') }}
                </h2>
            </div>
            <label class="switch">
                <input type="checkbox" id="switchShareBtn">
                <span class="slider round"></span>
            </label>
        </div>
    </x-slot>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error-popup">
                <span class="close-error">&times;</span>
                <strong>{{ __('Error!') }}</strong>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="success-popup">
            <span class="close-success">&times;</span>
            <strong>{{ __('Success!') }}</strong>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
