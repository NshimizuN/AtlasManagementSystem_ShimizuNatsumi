<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Post;
use App\Models\Categories\MainCategory;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];

    //Main categoriesテーブルのリレーション
    public function mainCategory(){
        return $this->belongsTo('App\Models\Categories\MainCategory');
    }

    //Postテーブルのリレーション
    public function posts(){
        return $this->belongsToMany
        ('App\Models\Posts\Post','post_sub_categories','sub_category_id','post_id');
    }
}
