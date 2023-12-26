<?php

namespace Domain\File\Actions;

use Domain\File\DTO\ShareFileData;
use Domain\SharedFile\Resources\SharedFileResource;

class GetMySharedFilesAction
{
    public function __invoke(): array
    {
        $user = auth()->user();

        $files = $user->sharing_files()->with(['file_type', 'tags', 'shared_with'])->get();

        $columns = ['Name', 'Shared With', 'Shared At'];
        $rows = [];
        foreach ($files as $f) {
            foreach ($f->shared_with as $shared_with) {
                $rows[] = [
                    'id' => $f->id,
                    'name' => $f->name  . '.' . $f->file_type->type,
                    'email' => $shared_with->email,
                    'shared_at' => $shared_with->pivot->created_at,
                ];
            }
        }

        return compact('columns', 'rows');
    }
}
