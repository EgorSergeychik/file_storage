<?php

namespace Domain\File\DTO;

use Domain\File\Models\File;
use Spatie\LaravelData\Data;

class DownloadFileData extends Data
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
