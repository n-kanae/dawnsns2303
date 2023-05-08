<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function userProfile($id){
        //固定部分にユーザー名表示
        $user = Auth::user();
        //固定部分にフォロー・フォロワー数表示
        $followings = DB::table('follows')
        ->where('follower_id',Auth::id())
        ->get();
        $follow_count = $followings->count();
        $follower = DB::table('follows')
        ->where('follow_id',Auth::id())
        ->get();
        $follower_count = $follower->count();
        //対象ユーザーのプロフィール・呟き表示
        $profiles = DB::table('users')
        ->where('id',$id)
        ->get();
       $posts = DB::table('posts')
       ->join('users', 'users.id', '=', 'posts.user_id')
       ->where('user_id',$id)->latest('posts.created_at')->get();
        return view('users.user-profile', compact('user','followings','follow_count','follower_count','profiles','posts'));
    }
    public function search(Request $request){
        $user = Auth::user();
        $followings = DB::table('follows')
        ->where('follower_id',Auth::id())
        ->get();
        //固定部分にフォロー・フォロワー数表示
        $follow_count = $followings->count();
        $follower = DB::table('follows')
        ->where('follow_id',Auth::id())
        ->get();
        $follower_count = $follower->count();
        if(request('search')){
            //▼POSTの場合・request('search')→name=search値がとんできたら
            $keyword = $request->search;
            $all_users = DB::table('users')
            ->where('username','LIKE',"%".$keyword."%")
            ->get();
        }else{
            //▼GETの場合
        $keyword = null;
        $all_users = DB::table('users')
        ->get();
        }
        return view('users.search',  compact('user','keyword','all_users','followings','follow_count','follower_count'));
    }

    public function userValidates(Request $request){
        Validator::make(
        //▼①値の配列
        $data,
        //▼②検証ルールの配列
        [
        'name' => ['required', 'email' , 'min:4' , 'max:12'],
		'mail' => ['required', 'email' , 'min:4' , 'max:12'],
		'password' => ['required' , 'min:4' , 'max:12'],
		'password-confirm' => ['required' , 'min:4' , 'max:12' , 'same:password'],
        ],
        //▼③検証ルールに反した場合のエラーメッセージの配列
        [
        'name.required' => '必須項目です',
        'name.min' => '4文字以上で入力してください',
        'name.max' => '12文字以内で入力してください',
		'mail.required' => '必須項目です',
		'mail.email' => 'メールアドレスではありません',
        'mail.min' => '4文字以上で入力してください',
        'mail.max' => '12文字以内で入力してください',
		'password.required' => '必須項目です',
		'password.min' => '4文字以上で入力してください',
        'password.max' => '12文字以内で入力してください',
		'password-confirm.required' => '必須項目です',
		'password-confirm.min' => '4文字以上で入力してください',
        'password-confirm.max' => '12文字以内で入力してください',
		'password-confirm.same' => 'パスワードと確認用パスワードが一致していません',
        ]
        );
        }
}
