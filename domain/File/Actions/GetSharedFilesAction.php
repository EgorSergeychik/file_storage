<?php

namespace Domain\File\Actions;

use Domain\File\DTO\ShareFileData;
use Domain\SharedFile\Resources\SharedFileResource;

class GetSharedFilesAction
{
    public function __invoke(): array
    {
        $user = auth()->user();

        $files = $user->shared_files()->with(['file_type', 'tags', 'owner'])->get();
        ray($files);
        $columns = ['Name', 'Owner', 'Shared At'];
        $rows = [];
        foreach ($files as $f) {
            $rows[] = [
                'name' => $f->name,
                'owner' => $f->owner->email,
                'shared_at' => $f->pivot->created_at,
            ];
        }

        return compact('columns', 'rows');
    }
}
