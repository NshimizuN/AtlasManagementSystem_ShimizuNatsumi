<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\Posts\Like;
use App\Models\Categories\SubCategory;

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

    //sub_categoriesテーブルーのリレーション
    public function subCategories(){
        return $this->belongsToMany
        ('App\Models\Categories\SubCategory','post_sub_categories','post_id','sub_category_id');
    }

    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }

    //likesテーブルのリレーション
    public function likes()
    {
        return $this->hasMany('App\Models\Posts\Like','like_post_id');
    }
}
