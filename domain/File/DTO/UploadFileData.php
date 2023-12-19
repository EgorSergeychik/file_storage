<?php

namespace Domain\File\DTO;

use Domain\Folder\Models\Folder;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class UploadFileData extends Data
{
    public function __construct(
        public UploadedFile $file,
        public ?Folder $folder,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            file: $request->file('file'),
            folder: $request->folder_id ? $request->user()->folders()->findOrFail($request->folder_id) : null,
        );
    }
}
