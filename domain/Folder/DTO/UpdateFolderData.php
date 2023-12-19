<?php

namespace Domain\Folder\DTO;

use Domain\Folder\Models\Folder;
use Spatie\LaravelData\Data;

class UpdateFolderData extends Data
{
    public function __construct(
        public Folder $folder,
        public string $name,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            folder: Folder::where('id', $request->folder_id)->first(),
            name: $request->name,
        );
    }
}
