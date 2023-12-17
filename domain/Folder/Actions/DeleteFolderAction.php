<?php

namespace Domain\Folder\Actions;

use Domain\Folder\DTO\DeleteFolderData;
use Illuminate\Support\Facades\DB;

class DeleteFolderAction
{
    public function __invoke(DeleteFolderData $data): bool
    {
        try {
            DB::beginTransaction();

            $data->folder->delete();

            // TODO: delete files from storage

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
