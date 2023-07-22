@extends('layouts.sidebar')
@section('content')
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
                 @error('comment')
            <li>{{$message}}</li>
            @enderror
      <!-- 編集確認画面 -->
      <div class="p-3">
       <div class="post_bottom_area d-flex">
              @foreach($post->subCategories as $sub_category)
                 <span class="post-subcategory">{{ $sub_category->sub_category }}</span>
             @endforeach
         <div class="detail_inner_head">
          @if(Auth::user()->id == $post->user_id)
          <div class="edit-delete-box">
            <span class="edit-modal-open" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
            <span class="delete-btn" ><a href="{{ route('post.delete', ['id' => $post->id]) }}" style="color:#fff;" onclick="return confirm('削除してよろしいでしょうか？')">削除</a>
          </div>
          @endif
        </div>
      </div>

        <div class="detsail-post-name">
         <div class="contributor d-flex">
           <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
           </p>
         </div>
        </div>
        <div class="detsail-post-form">
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      </div>
      <div class="comment-detail p-3">
        <p style="font-size:0.9rem;">コメント</p>
        <div class="comment_container">
          @foreach($post->postComments as $comment)
          <hr>
          <div class="comment-view">
            <div class="comment-icon-name">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}さん</span>
            </p>
           </div>
           <div class="mt-3 detsail_post">
            <p>{{ $comment->comment }}</p>
          </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
                    @error('comment')
            <li>{{$message}}</li>
            @enderror
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex " style=" justify-content:space-between;">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
