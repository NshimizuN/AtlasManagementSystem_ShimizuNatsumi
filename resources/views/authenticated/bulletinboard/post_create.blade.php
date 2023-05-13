@extends('layouts.sidebar')

@section('content')

<!-- 投稿フォーム -->
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <!-- カテゴリー -->
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id">
        @foreach($main_categories as $main_category)
        <option label="{{ $main_category->main_category }}"></option>
        @endforeach
      </select>
    </div>
    <!-- サブカテゴリー -->
    <div class="">
      <p class="mb-0">サブカテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id">
        @foreach($sub_categories as $sub_category)
        <option label="{{ $sub_category->sub_category }}"></option>
        @endforeach
      </select>
    </div>
    <!-- タイトル -->
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <!-- 投稿内容 -->
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <!-- 投稿ボタン -->
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>

  <!-- 教師のみの表示 -->
  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <!-- メインカテゴりを追加ー -->
      <div class="">
        <p class="m-0">メインカテゴリー</p>
        <input type="text" class="w-100" name="main_category_name" form="mainCategoryCreate" method="post" value="{{old('main_category_name')}}">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryCreate">
        <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryCreate">{{ csrf_field() }}</form>
      </div>
      <!-- サブカテゴリー追加 -->
      <div class="">
        <p class="m-0">サブカテゴリー</p>
        <select class="w-100" form="subCategoryCreate" name="main_category_id">
        <option selected disabled>----</option>
        @foreach($main_categories as $main_category)
        <option label="{{ $main_category->main_category }}" value="{{$main_category->id}}"></option>
        @endforeach
       </select>
       <input type="text" class="w-100" name="sub_category_name" form="subCategoryCreate" method="post" valie="{{old('sub_category_name')}}">
       <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryCreate">
       <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryCreate">{{ csrf_field() }}</form>
     </div>
   </div>
  </div>
  @endcan
</div>
@endsection
