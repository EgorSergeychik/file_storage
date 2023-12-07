<?php

namespace Domain\SharedFile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    use HasFactory;

    protected $table = 'shared_files';

    protected $fillable = [
        'file_id',
        'user_id',
    ];
}
