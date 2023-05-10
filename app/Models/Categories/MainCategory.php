<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\SubCategory;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    //Sub Categoriesテーブルのリレーション
    public function subCategories(){
        return $this->hasMany('App\Models\Categories\SubCategory');
    }

}
