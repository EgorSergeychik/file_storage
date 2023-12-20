<?php

declare(strict_types=1);

namespace App\Support\Helpers;

use Domain\FileType\Models\FileType;

class Help
{
    public static function findOrCreateFileType(string $file_type): FileType
    {
        if (!FileType::where('type', $file_type)->exists()) {
            return FileType::create([
                'type' => $file_type,
                'display_name' => $file_type,
            ]);
        }

        return FileType::where('type', $file_type)->first();
    }
}
