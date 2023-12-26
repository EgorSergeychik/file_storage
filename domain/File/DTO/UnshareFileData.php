<?php

namespace Domain\File\DTO;

use Domain\File\Models\File;
use Domain\SharedFile\Models\SharedFile;
use Domain\User\Models\User;
use Spatie\LaravelData\Data;

class UnshareFileData extends Data
{
    public function __construct(
        public SharedFile $shared_file,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            shared_file: $request->shared_file,
        );
    }
}
