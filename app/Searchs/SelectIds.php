<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectIds implements DisplayUsers{

  // 改修課題：選択科目の検索機能
  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects){
    //性別 絞り込まない
    if(is_null($gender)){
      $gender = ['1', '2'];
      //絞り込む
    }else{
      $gender = array($gender);
    }
    //権限 絞り込まない
    if(is_null($role)){
      $role = ['1', '2', '3', '4'];
      //絞り込む
    }else{
      $role = array($role);
    }

    if(is_null($keyword)){
      //Userモデル、subjectsテーブル
      $users = User::with('subjects')
      ->whereIn('sex', $gender)
      ->whereIn('role', $role)
      ->orderBy('id', $updown)->get();
    }else{
      $users = User::with('subjects')
      ->where('id', $keyword)
      ->whereIn('sex', $gender)
      ->whereIn('role', $role)
      ->orderBy('id', $updown)->get();
    }
    return $users;
  }

}
