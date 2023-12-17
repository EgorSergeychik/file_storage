<?php

namespace Domain\File\Actions;

use Domain\File\DTO\DeleteFileData;
use Illuminate\Support\Facades\DB;

class DeleteFileAction
{
    public function __invoke(DeleteFileData $data): bool
    {
        try {
            DB::beginTransaction();

            $data->file->delete();

            // TODO: delete file from storage

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
