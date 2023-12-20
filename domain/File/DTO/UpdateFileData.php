<?php

namespace Domain\File\DTO;

use Domain\File\Models\File;
use Spatie\LaravelData\Data;

class UpdateFileData extends Data
{
    public function __construct(
        public File $file,
        public string $name,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            file: File::where('id', $request->file_id)->first(),
            name: $request->name,
        );
    }
}
