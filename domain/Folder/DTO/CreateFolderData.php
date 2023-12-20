<?php

namespace Domain\Folder\DTO;

use Domain\Folder\Models\Folder;
use Domain\Folder\Requests\CreateFolderRequest;
use Spatie\LaravelData\Data;

class CreateFolderData extends Data
{
    public function __construct(
        public Folder|null $folder,
        public string $name,
    ) {
    }

    public static function fromRequest(CreateFolderRequest $request): self
    {
        return new self(
            folder: $request->folder_id ? Folder::find($request->folder_id) : null,
            name: $request->name,
        );
    }
}
