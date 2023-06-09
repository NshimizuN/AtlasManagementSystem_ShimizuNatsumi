<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\Post;

class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    //usersテーブルとリレーション
        public function user() {
        return $this->belongsTo('App\Models\User');
    }

    //postsテーブルとリレーション
    public function post() {
        return $this->belongsTo('App\Models\Posts\Post');
    }

    //いいね数のカウント
    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
    }
}
