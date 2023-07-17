@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-100 mt-5">

    <!-- 投稿リスト -->
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <!-- 名前 -->
            <p class="post-user-name"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <!-- 投稿タイトル -->
      <b><p class="post-title"><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color:#000000;">{{ $post->post_title }}</a></p></b>

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

  <!-- 右のエリア -->
  <!-- 投稿作成 -->
  <div class="other_area border">
    <div class="other_area_box ">
      <!-- 投稿ページへ推移 -->
      <div class="post-page">
        <button type=“button” class="post-btn" onclick="location.href='{{ route('post.input') }}'">投稿</button>
      </div>
      <!--キーワードを検索  -->
      <div class="post-search">
         <div class="post-search-box">
         <input type="text" class="posts-search-form" placeholder="キーワードを入力" name="keyword" form="postSearchRequest">
         <button type="submit"  class="posts-search-btn" value="検索" form="postSearchRequest"><i class="fa fa-search" aria-hidden="true" form="postSearchRequest"></i></button>
        </div>
      </div>

      <div class="mypage-like">
       <!-- いいねした投稿 -->
        <div class="like-posts">
         <button type=“button” name="like_posts" class="like-posts-btn" value="いいねした投稿" form="postSearchRequest">いいねした投稿</button>
       </div>
       <!-- 自分の投稿 -->
        <div class="like-posts">
         <button type=“button” name="my_posts" class="my-post-btn" value="自分の投稿" form="postSearchRequest">自分の投稿</button>
       </div>
      </div>

      <!-- カテゴリー -->
      <div class="posts-category">
        <p class="post-search-title" style="color:#000000;">カテゴリー検索</p>

        <div class="posts-category-box">
          <ul class="menu">

           @foreach($categories as $category)
           <div class="main_category_container">
             <div class="main_category_box">
               <li><span class="main_category">{{$category->main_category}}</span>
             </div>
            </div>
              @foreach($category->subCategories as $sub_category)
              <ul class="sub_inner">

               <div class="sub_category_box">
                 <li><input type="submit" class="sub_category" name="category_word" value="{{ $sub_category->sub_category }}" form="postSearchRequest"></li>
              </div>

             </ul>
             @endforeach

          </li>
           @endforeach
         </ul>
      </div>


         <!-- @foreach($categories as $category)
         <p class="m-0">{{$category->main_category}}</p>
        @foreach($category->subCategories as $sub_category)
        <input type="submit" name="category_word" class="category_btn" value="{{ $sub_category->sub_category }}" form="postSearchRequest">
        @endforeach
        @endforeach -->
      </div>
     </div>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>

@endsection
