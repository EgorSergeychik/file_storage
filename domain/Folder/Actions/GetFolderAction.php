<?php

namespace Domain\Folder\Actions;

use Domain\Folder\DTO\GetFolderData;
use Illuminate\Support\Number;

class GetFolderAction
{
    public function __invoke(GetFolderData $data): array
    {
        $folder = $data->folder;

        // load all files and folders for the current user
        $files_query = auth()->user()->files()->with(['file_type', 'tags']);
        $folders_query = auth()->user()->folders();
        if ($folder) {
            $files_query->where('folder_id', $folder->id);
            $folders_query->where('parent_id', $folder->id);
        } else {
            $files_query->whereNull('folder_id');
            $folders_query->whereNull('parent_id');
        }

        // sort files and folders
        $sort_by = request('sort_by', 'created_at');
        $sort_direction = request('sort_direction', 'asc');

        $column_mapping = [
            'Name' => 'name',
            'Type' => 'file_types.type',
            'Size' => 'size',
            'Created At' => 'created_at',
            'Updated At' => 'updated_at',
        ];

        $sort_by = $column_mapping[$sort_by] ?? 'created_at';

        if ($sort_by == 'file_types.type') {
            $files_query->join('file_types', 'file_types.id', '=', 'files.type_id');
        }
        $files_query->orderBy($sort_by, $sort_direction);

        if (!in_array($sort_by, ['file_types.type', 'size'])) {
            $folders_query->orderBy($sort_by, $sort_direction);
        }

        // get files and folders and prepare data for the table

        $files = $files_query->get();
        $folders = $folders_query->get();

        $columns = ['Name', 'Type', 'Size', 'Created At', 'Updated At'];
        $rows = [];
        foreach ($folders as $f) {
            $rows[] = [
                'id' => $f->id,
                'name' => $f->name,
                'type' => 'Folder',
                'size' => '—',
                'created_at' => $f->created_at ?? '—',
                'updated_at' => $f->updated_at ?? '—',
            ];
        }
        foreach ($files as $file) {
            $rows[] = [
                'id' => $file->id,
                'name' => $file->name . '.' . $file->file_type->type,
                'type' => $file->file_type->display_name,
                'size' => Number::fileSize($file->size),
                'created_at' => $file->created_at ?? '—',
                'updated_at' => $file->updated_at ?? '—',
            ];
        }

        return compact('rows', 'columns', 'folder');
    }
}
