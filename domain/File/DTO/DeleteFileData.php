<?php

namespace Domain\File\DTO;

use Domain\File\Models\File;
use Spatie\LaravelData\Data;

class DeleteFileData extends Data
{
    public function __construct(
        public File $file,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            file: $request->file,
        );
    }
}
