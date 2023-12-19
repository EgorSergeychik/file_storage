<?php

namespace Domain\Folder\Actions;

use Domain\Folder\DTO\UpdateFolderData;
use Domain\Folder\Models\Folder;
use Illuminate\Support\Facades\DB;

class UpdateFolderAction
{
    public function __invoke(UpdateFolderData $data): Folder
    {
        $folder = $data->folder;

        $folder->update([
            'name' => $data->name,
        ]);

        return $folder->fresh();
    }
}
