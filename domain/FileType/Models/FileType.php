<?php

namespace Domain\FileType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    use HasFactory;

    protected $table = 'file_types';

    protected $fillable = [
        'type',
        'display_name',
    ];
}
