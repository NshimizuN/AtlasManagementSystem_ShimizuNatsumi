<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\Like;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    //usersテーブルとリレーション
    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    //コメントのリレーション
    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function subCategories(){
        // リレーションの定義
    }

    // コメント数
    public function commentCounts($posy_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }

    //likesテーブルのリレーション
    public function likes()
    {
        return $this->hasMany('App\Models\Posts\Like');
    }
}
