<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Drive') }}
            </h2>
            @if($folder)
                <a href="{{ route('folders.show', ['folder' => $folder->parent_id]) }}" class="back-button">Back</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-table-component :rows="$rows" :columns="$columns" :noDataMessage="'There is no files.'">
                    </x-table-component>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .back-button {
        margin-left: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 2rem;
        padding: 0 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        line-height: 1.25rem;
        color: #fff;
        background-color: #3b82f6;
        border-radius: 0.375rem;
        transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        text-decoration: none;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .back-button:hover {
        background-color: #2563eb;
        color: #fff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .flex.items-center {
        align-items: center;
        justify-content: flex-start;
    }
</style>
