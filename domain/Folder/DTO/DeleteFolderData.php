<?php

namespace Domain\Folder\DTO;

use Domain\Folder\Models\Folder;
use Spatie\LaravelData\Data;

class DeleteFolderData extends Data
{
    public function __construct(
        public Folder $folder,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            folder: $request->folder,
        );
    }
}
