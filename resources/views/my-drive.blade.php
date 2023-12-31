<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('My Drive') }}
                </h2>
                @if($folder)
                    <a href="{{ route('folders.show', ['folder' => $folder->parent_id]) }}" class="button secondary" style="margin-left: 1rem">{{ __('Back') }}</a>
                @endif
            </div>
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
                    <div class="table-container">
                        <table class="table-auto w-full">
                            <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th class="px-4 py-2">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => $column, 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}">
                                            {{ __($column) }}
                                            @if(request('sort_by') == $column)
                                                @if(request('sort_direction') == 'asc')
                                                    &#8593;
                                                @else
                                                    &#8595;
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                @endforeach
                                <th class="px-4 py-2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rows as $row)
                                <tr>
                                    @foreach($row as $key => $cell)
                                        @if($key == 'name' and $row['type'] == 'Folder')
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('folders.show', ['folder' => $row['id']]) }}" class="folder-name">📁 {{ $cell }}</a>
                                            </td>
                                            @continue
                                        @endif
                                        @if($key != 'id')
                                            <td class="border px-4 py-2">{{ $cell }}</td>
                                        @endif
                                    @endforeach
                                    <td class="border px-4 py-2">
                                        @if($row['type'] == 'Folder')
                                            <button onclick="openDeleteModal(event, '{{ route('folders.destroy', ['folder' => $row['id']]) }}', '{{ $row['name'] }}')" class="button danger">
                                                {{ __('Delete') }}</button>
                                            <button onclick="openEditModal(event,
                                                                        '{{ route('folders.update', ['folder' => $row['id']]) }}',
                                                                        '{{ $row['name'] }}',
                                                                        '{{ $row['id'] }}',
                                                                        'folder')"
                                                    class="button secondary">{{ __('Edit') }}</button>
                                        @else
                                            <button onclick="openDeleteModal(event, '{{ route('files.destroy', ['file' => $row['id']]) }}', '{{ $row['name'] }}')" class="button danger">
                                                {{ __('Delete') }}</button>
                                            <button onclick="openEditModal(event,
                                                                      '{{ route('files.update', ['file' => $row['id']]) }}',
                                                                      '{{ $row['name'] }}',
                                                                      '{{ $row['id'] }}',
                                                                      'file')"
                                                    class="button secondary">{{ __('Edit') }}</button>
                                            <a href="{{ route('files.download', ['file' => $row['id']]) }}" class="button success">{{ __('Download') }}</a>
                                            <button onclick="openShareModal(event,
                                                                       '{{ route('files.share', ['file' => $row['id']]) }}',
                                                                       '{{ $row['name'] }}',
                                                                       '{{ $row['id'] }}')"
                                                    class="button primary">&#128227;</button>
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
    </div>
</x-app-layout>

@include('modals.delete-modal')
@include('modals.update-modal')
@include('modals.share-modal')

<div class="command-button" id="commandButton">
    +
</div>

<div class="command-menu" id="commandMenu">
    <button data-action="upload_file" data-form="upload_form">{{ __('Upload file') }}</button>
    <button data-action="new_folder" data-form="new_folder_form">{{ __('New folder') }}</button>
</div>

<div class="form-container" id="upload_form">
    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required class="input-file">
        <input type="hidden" name="folder_id" value="{{ $folder->id ?? null }}">
        <button type="submit" class="button success">{{ __('Upload') }}</button>
    </form>
</div>

<div class="form-container" id="new_folder_form">
    <form action="{{ route('folders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" required placeholder="{{ __('New Folder') }}" >
        <input type="hidden" name="folder_id" value="{{ $folder->id ?? null }}">
        <button type="submit" class="button success">{{ __('Create') }}</button>
    </form>
</div>
