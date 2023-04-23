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
        $user = Auth::user();
        return view('posts.index',  compact('user'));
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
