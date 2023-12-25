<?php

namespace Domain\File\DTO;

use Domain\File\Models\File;
use Domain\User\Models\User;
use Spatie\LaravelData\Data;

class ShareFileData extends Data
{
    public function __construct(
        public File $file,
        public User $user,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            file: File::find($request->file_id),
            user: User::firstWhere('email', $request->email),
        );
    }
}
