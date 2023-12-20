<?php

namespace Domain\Folder\Actions;

use Domain\Folder\DTO\CreateFolderData;
use Domain\Folder\Models\Folder;

class CreateFolderAction
{
    public function __invoke(CreateFolderData $data): Folder
    {
        $folder = Folder::create([
            'name' => $data->name,
            'parent_id' => $data->folder->id ?? null,
            'user_id' => auth()->user()->id,
        ]);

        return $folder;
    }
}
