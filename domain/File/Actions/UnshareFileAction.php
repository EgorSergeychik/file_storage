<?php

namespace Domain\File\Actions;

use Domain\File\DTO\UnshareFileData;
use Illuminate\Support\Facades\DB;

class UnshareFileAction
{
    public function __invoke(UnshareFileData $data): bool
    {
        try {
            DB::beginTransaction();
            $shared = $data->shared_file;

            $shared->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
