<?php

namespace Domain\File\Models;

use Domain\FileType\Models\FileType;
use Domain\Tag\Models\Tag;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'user_id',
        'folder_id',
        'name',
        'type_id',
        'size',
    ];

    public function file_type(): BelongsTo
    {
        return $this->belongsTo(FileType::class, 'type_id', 'id');
    }

    public function getFileTypeName(): string
    {
        return $this->file_type->type;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'file_tag', 'file_id', 'tag_id');
    }

    public function getFilePath(File $file): string
    {
        return 'files/' . $file->user_id . '/' . $file->id . "." . $file->getFileTypeName();
    }

    public function shared_with(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shared_files', 'file_id', 'user_id');
    }
}
