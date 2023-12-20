<?php

namespace Domain\File\Actions;

use App\Support\Helpers\Help;
use Domain\File\DTO\UpdateFileData;
use Domain\File\Models\File;

class UpdateFileAction
{
    public function __invoke(UpdateFileData $data): File
    {
        $file = $data->file;

        $last_dot_pos = strrpos($data->name, '.');
        if ($last_dot_pos === false) {
            throw new \Exception('File type is not provided');
        }

        $name = substr($data->name, 0, $last_dot_pos);
        $file_type = substr($data->name, $last_dot_pos + 1);

        $type = Help::findOrCreateFileType($file_type);

        $file->update([
            'name' => $name,
            'type_id' => $type->id,
        ]);

        return $file->fresh();
    }
}
