<?php

namespace Domain\FileTag\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTag extends Model
{
    use HasFactory;

    protected $table = 'file_tag';

    protected $fillable = [
        'file_id',
        'tag_id',
    ];
}
