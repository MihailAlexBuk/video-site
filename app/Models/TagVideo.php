<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagVideo extends Model
{
    use HasFactory;

    protected $table = 'tag_videos';
    protected $guarded = false;
}
