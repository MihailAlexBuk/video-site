<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'title',
        'desc',
        'video_url',
        'poster',
        'category_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'tag_videos', 'video_id', 'tag_id');
    }

    public function likes(){
        return $this->hasMany(LikeDislike::class, 'video_id')->sum('like');
    }

    public function dislikes(){
        return $this->hasMany(LikeDislike::class, 'video_id')->sum('dislike');
    }

    public function videoview(){
        return $this->hasMany(VideoView::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }


}
