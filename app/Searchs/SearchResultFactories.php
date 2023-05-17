<?php
namespace App\Searchs;

use App\Models\Users\User;

class SearchResultFactories{

  // 改修課題：選択科目の検索機能
  public function initializeUsers($keyword, $category, $updown, $gender, $role, $subjects){
    //名前検索
    if($category == 'name'){
      //絞り込まない
      if(is_null($subjects)){
        $searchResults = new SelectNames();
        //絞り込む
      }else{
        $searchResults = new SelectNameDetails();
      }
      return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);

      //社員ID検索
    }else if($category == 'id'){
      //絞り込まない
      if(is_null($subjects)){
        $searchResults = new SelectIds();
        //絞り込む
      }else{
        $searchResults = new SelectIdDetails();
      }
      return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
    }else{
      //何も絞り込まない 全てのユーザーを表示
      $allUsers = new AllUsers();
    return $allUsers->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
    }
  }
}
