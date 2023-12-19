<?php

namespace Domain\File\Actions;

use Domain\File\DTO\DeleteFileData;
use Domain\File\DTO\DownloadFileData;
use Domain\File\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DownloadFileAction
{
    public function __invoke(DownloadFileData $data): ?string
    {
        $file = $data->file;
        $path = $file->getFilePath($file);

        if (Storage::disk('local')->exists($path)) {
            return $path;
        }

        return null;
    }
}
