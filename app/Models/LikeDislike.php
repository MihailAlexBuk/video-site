<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    use HasFactory;

    public function videos(){
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
