@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>

    <!-- 投稿リスト -->
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <!-- 名前 -->
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <!-- 投稿タイトル -->
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <!-- コメント -->
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{$post->postComments->count()}}</span>
          </div>
          <!-- いいね -->
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- 投稿作成 -->
  <div class="other_area border w-25">
    <div class="border m-4">
      <!-- 投稿ページへ推移 -->
      <div class=""><a href="{{ route('post.input') }}">投稿</a></div>
      <!--キーワードを検索  -->
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <!-- いいねした投稿 -->
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <!-- 自分の投稿 -->
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <!-- カテゴリー -->
      <div class="">
        <p class="m-0">教科</p>
        @foreach($categories as $category)
      <input type="submit" name="category_word" class="category_btn" value="{{$category->main_category}}" form="postSearchRequest">
      @endforeach
     </div>
     <!-- サブカテゴリー -->
      <div class="">
        <p class="m-0">参考書</p>
         @foreach($second_categories as $second_category)
      <input type="submit" name="category_word" class="category_btn" value="{{ $second_category->sub_category }}" form="postSearchRequest">
      @endforeach
     </div>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
