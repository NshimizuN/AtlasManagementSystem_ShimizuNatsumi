<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\BulletinBoard\CommentRequest;
use App\Http\Requests\BulletinBoard\MainCategoryRequest;
use App\Http\Requests\BulletinBoard\SubCategoryRequest;
use Auth;

class PostsController extends Controller
{
    //投稿を表示させる
    public function show(Request $request)
    {
        $posts = Post::with('user', 'postComments')->get();
        $categories = MainCategory::get();
        // $second_categories = SubCategory::get();
        $like = new Like;
        $post_comment = new Post;
        // キーワードを入力して抽出
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
            // 特定のカテゴリーの抽出
        }else if($request->category_word){
            $sub_category = $request->category_word;
            //選択したサブカテゴリーを$sub_categoryへ代入
            $sub_category_id = SubCategory::where('sub_category' , $sub_category)->first();
            //$sub_categoryと一致しているワードを、subCategoryモデル（sub_categoriesテーブル）のsub_categoryカラムから探して、->first();のidを取得
            $posts = Post::with('user', 'postComments')->whereHas('subCategories',function($q) use ($sub_category_id){
                //whereHas('サブカテゴリーのリレーション',function($q) use ($sub_category_idを使用することを宣言)
                $q->where('post_sub_categories.sub_category_id' , $sub_category_id->id);
                //$q->where('postとsub_categoriesの中間テーブル'.左の中間テーブルで一致させたいカラム' , useで使用宣言した変数->id(idを取得));
            })->get();
            // いいねした投稿の抽出
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
            // 自分の投稿の抽出
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    //
    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    //メイン、サブカテゴリーを投稿フォームに渡す
    public function postInput(){
        $main_categories = MainCategory::get();
        $sub_categories = SubCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories','sub_categories'));
    }

    //投稿の新規作成
    public function postCreate(PostFormRequest $request){
        DB::beginTransaction();
        $post_category = $request->post_category_id;
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        $post_create = Post::findOrFail($post->id);
        $post_create->subCategories()->attach($post_category);
        DB::commit();
        return redirect()->route('post.show');
    }

    //投稿の編集
    public function postEdit(PostFormRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    //投稿の削除
    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    //メインカテゴリーに単語を追加
    public function mainCategoryCreate(MainCategoryRequest $request){
        MainCategory::create([
            'main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }

    //サブカテゴリーに単語を追加
    public function subCategoryCreate(SubCategoryRequest $request){
        SubCategory::create([
            $main_category_id ='main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name
        ]);
        return redirect()->route('post.input');
    }

    //コメントの新規作成
    public function commentCreate(CommentRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }


    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    //いいねした投稿を抽出
    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    //いいねをつける
    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    //いいねを止める
    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
