<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Drive') }}
            </h2>
            @if($folder)
                <a href="{{ route('folders.show', ['folder' => $folder->parent_id]) }}" class="secondary-button">{{ __('Back') }}</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            @foreach($columns as $column)
                                <th class="px-4 py-2">{{ __($column) }}</th>
                            @endforeach
                            <th class="px-4 py-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rows as $row)
                            <tr>
                                @foreach($row as $key => $cell)
                                    @if($key != 'id')
                                        <td class="border px-4 py-2">{{ $cell }}</td>
                                    @endif
                                @endforeach
                                <td class="border px-4 py-2">
                                    @if($row['type'] == 'Folder')
{{--                                        <a href="{{ route('folders.show', ['folder' => $row['id']]) }}" class="secondary-button">Open</a>--}}
                                        <button onclick="openDeleteModal(event, '{{ route('dashboard') }}', '{{ $row['name'] }}')" class="danger-button">Delete</button>
                                        <button onclick="openEditModal(event, '{{ route('dashboard') }}', '{{ $row['name'] }}')" class="secondary-button">Edit</button>
                                    @else
                                        <button onclick="openDeleteModal(event, '{{ route('dashboard') }}')" class="danger-button">Delete</button>
                                        <button onclick="openEditModal(event, '{{ route('dashboard') }}', '{{ $row['name'] }}')" class="secondary-button">Edit</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border px-4 py-2" colspan="{{ count($columns) }}">{{ __("There are no files here.") }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('modals.delete-modal')

<!-- Модальное окно для изменения -->
{{--<div id="editModal" class="modal hidden">--}}
{{--    <div class="modal-content">--}}
{{--        <form action="" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}

{{--            <input name="name" value="{{ __("<File name>")  }}">--}}

{{--            <button type="submit">Сохранить</button>--}}
{{--            <button type="button" onclick="closeModal()">Отмена</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
