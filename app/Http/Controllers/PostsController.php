<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
       ->whereIn('posts.user_id',$followings->pluck('follow_id'))->orWhere('posts.user_id', Auth::id())->latest('posts.created_at')
       ->select('image','username','post','posts.created_at','posts.id','posts.user_id')->get();
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
        $rule = [
        'username' => ['required' , 'min:4' , 'max:12'],
		'mail' => ['required', 'email' , 'min:4' , 'max:12'],
		'new-password' => ['nullable','min:4' , 'max:12'],
        'bio' => ['max:200','nullable']
        ];

        $validator = Validator::make($request->all(), $rule ,$messages = [
        'username.required' => '必須項目です',
        'username.min' => '4文字以上で入力してください',
        'username.max' => '12文字以内で入力してください',
		'mail.required' => '必須項目です',
		'mail.email' => 'メールアドレスではありません',
        'mail.min' => '4文字以上で入力してください',
        'mail.max' => '12文字以内で入力してください',
		'new-password.min' => '4文字以上で入力してください',
        'new-password.max' => '12文字以内で入力してください',
		'bio' => '200文字以内で入力してください'
        ]);
        if ($validator->fails()) {
          return redirect('/profile')
              ->withErrors($validator)
              ->withInput();
      }

        $name = $request->input('username');
        $mail = $request->input('mail');
        $bio = $request->input('bio');
        //新パスワードが入力されているかどうかで分岐
        if(request('new-password')){
            $new_password = $request->input('new-password');
            $password = bcrypt($new_password);
            $old_session = session()->forget('session');
            $password_count = strlen($new_password);
            $session = session()->put('session',$password_count);
        }else{
            $password = Auth::user()->password;
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
        return redirect('/profile');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
        'newPost' => 'required|max:150',
        ],[
        'newPost.required' => '文字を入力してください',
        'newPost.max' => '150文字以内で入力してください'
        ]);
        if ($validator->fails()) {
        // エラー発生時の処理
        return redirect('/top')
            ->withErrors($validator)
            ->withInput();
        }
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

    public function postUpdate(Request $request){
        $validator = Validator::make($request->all(), [
        'newPost' => 'required|max:150',
        ],[
        'newPost.required' => '文字を入力してください',
        'newPost.max' => '150文字以内で入力してください'
        ]);
        if ($validator->fails()) {
        // エラー発生時の処理
        return redirect('/top')
            ->withErrors($validator)
            ->withInput();
        }
        $post = $request->input('newPost');
        $id = $request->id;
        DB::table('posts')->where('id',$id)
        ->update([
            'post'=> $post,
            'updated_at' =>now()
        ]);
        return redirect('/top');
    }

    public function delete($id){
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }
}
