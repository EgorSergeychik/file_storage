<?php

namespace Domain\File\Actions;

use Domain\File\DTO\DeleteFileData;
use Domain\File\DTO\UploadFileData;
use Domain\File\Models\File;
use Domain\FileType\Models\FileType;
use Illuminate\Support\Facades\DB;

class UploadFileAction
{
    public function __invoke(UploadFileData $data): bool
    {
        try {
            DB::beginTransaction();
            $file_type = $data->file->getClientOriginalExtension();

            if (!FileType::where('type', $file_type)->exists()) {
                FileType::create([
                    'type' => $file_type,
                    'display_name' => $file_type,
                ]);
            }
            $type = FileType::where('type', $file_type)->first();

            $file = File::create([
                'user_id' => auth()->user()->id,
                'folder_id' => $data->folder->id ?? null,
                'name' => pathinfo($data->file->getClientOriginalName(), PATHINFO_FILENAME),
                'type_id' => $type->id,
                'size' => $data->file->getSize(),
            ]);

            $path = $data->file->storeAs('files'.DIRECTORY_SEPARATOR.auth()->user()->id, $file->id.'.'.$file_type);
            ray($path);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
