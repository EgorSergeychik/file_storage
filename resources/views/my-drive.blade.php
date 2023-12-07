<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Drive') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(count($files) == 0 && count($folders) == 0)
                        <div>
                            <p class="text-center">{{ __("You don't have any files or folders yet.") }}</p>
                        </div>
                    @else
                        <table class="table-auto w-full">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __("Name") }}</th>
                                <th class="px-4 py-2">{{ __("Type") }}</th>
                                <th class="px-4 py-2">{{ __("Size") }}</th>
                                <th class="px-4 py-2">{{ __("Last Modified") }}</th>
                                <th class="px-4 py-2">{{ __("Created") }}</th>
                                <th class="px-4 py-2">{{ __("Actions") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $file->name . $file->file_type->type }}</td>
                                        <td class="border px-4 py-2">{{ __($file->file_type->display_name) }}</td>
                                        <td class="border px-4 py-2">{{ \Illuminate\Support\Number::fileSize($file->size) }}</td>
                                        <td class="border px-4 py-2">{{ $file->updated_at ?? '—' }}</td>
                                        <td class="border px-4 py-2">{{ $file->created_at }}</td>
                                        <td class="border px-4 py-2">{{ __('In progress') }}</td>

                                    </tr>
                                @endforeach
                                @foreach($folders as $folder)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $folder->name }}</td>
                                        <td class="border px-4 py-2">{{ __('Folder') }}</td>
                                        <td class="border px-4 py-2"></td>
                                        <td class="border px-4 py-2">{{ $folder->updated_at }}</td>
                                        <td class="border px-4 py-2">{{ $folder->created_at }}</td>
                                        <td class="border px-4 py-2">{{ __('In progress') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
