<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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
       $post = DB::table('posts')
       ->join('users', 'users.id', '=', 'posts.user_id')
       ->whereIn('posts.user_id',$followings->pluck('follow_id'))->orWhere('posts.user_id', Auth::id())->latest('posts.created_at')->get();
        return view('posts.index', [
            'user'           => $user,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'posts' => $post
        ]);
    }

    public function profile(){
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
        $session = session()->get('session');
        return view('posts.profile', [
            'user'           => $user,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'session' => $session
        ]);
    }

    public function update(Request $request){
        $name = $request->input('username');
        $mail = $request->input('mail');
        $bio = $request->input('bio');
        //新パスワードが入力されているかどうかで分岐
        if(request('new-password')){
            $password = $request->input('new-password');
            $old_session = session()->forget('session');
        }else{
            $password = $request->input('password');
        }
        if(request('image')){
        $image = $request->file('image');
        //public > images配下に画像が保存される
        $path = $image->store('images','public');
        DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'username'=>$name,
            'mail'=>$mail,
            'password'=>$password,
            'bio'=>$bio,
            'image'=>$path
        ]);
        }else{
        DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'username'=>$name,
            'mail'=>$mail,
            'password'=>$password,
            'bio'=>$bio,
        ]);
        }
        $new_password = strlen($password);
        $session = session()->put('session',$new_password);
        return redirect('/profile');
    }

    public function create(Request $request){
        $post = $request->input('newPost');
        $user_id = Auth::user()-> id;
        DB::table('posts')->insert([
            'post'=> $post,
            'user_id' => $user_id,
            'created_at' =>now(),
            'updated_at' =>now()
        ]);
        return redirect('/top');
    }
}
