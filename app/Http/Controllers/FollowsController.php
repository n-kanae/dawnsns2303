<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
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
       //つぶやきを表示
       $post = DB::table('posts')->whereIn('user_id',$followings->pluck('follow_id'))->latest()->get();
       //フォローしているユーザー一覧表示
       $follow_users = DB::table('users')
       ->whereIn('id',$followings->pluck('follow_id'))
       ->get();
        return view('follows.followList', [
            'user'           => $user,
            'follow_users'=> $follow_users,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'posts' => $post
        ]);
    }
    public function followerList(){
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
       //つぶやきを表示
       $post = DB::table('posts')->whereIn('user_id',$follower->pluck('follower_id'))->latest()->get();
       //自分をフォローしているユーザー一覧表示
       $follower_users = DB::table('users')
       ->whereIn('id',$follower->pluck('follower_id'))
       ->get();
        return view('follows.followerList', [
            'user'           => $user,
            'follower_users'=> $follower_users,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'posts' => $post
        ]);
    }

    public function create(Request $request){
        $id = $request->id;
        DB::table('follows')
        ->insert([
            'follow_id'=>$id,
            'follower_id'=>Auth::id(),
            'created_at'=>now()
        ]);
        return back();
    }
    public function delete(Request $request){
        $id = $request->id;
        DB::table('follows')
        ->where([
            'follow_id'=>$id,
            'follower_id'=>Auth::id()
        ])->delete();
        return back();
    }
}
