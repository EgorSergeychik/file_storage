<?php

namespace Domain\File\Actions;

use Domain\File\DTO\ShareFileData;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ShareFileAction
{
    public function __invoke(ShareFileData $data): bool
    {
        try {
            DB::beginTransaction();
            $file = $data->file;
            $user = $data->user;

            $file->shared_with()->attach($user);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
