<?php

namespace Domain\SharedFile\Models;

use Domain\File\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharedFile extends Model
{
    use HasFactory;

    protected $table = 'shared_files';

    protected $fillable = [
        'file_id',
        'user_id',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
