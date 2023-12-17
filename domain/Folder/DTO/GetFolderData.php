<?php

namespace Domain\Folder\DTO;

use Domain\Folder\Models\Folder;
use Spatie\LaravelData\Data;

class GetFolderData extends Data
{
    public function __construct(
        public Folder|null $folder,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            folder: $request->folder,
        );
    }
}
