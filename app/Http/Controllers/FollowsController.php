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
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
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
