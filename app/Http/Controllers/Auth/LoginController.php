<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            //パスワードの文字数をセッションに保存
            $password = strlen($request->password);
            $session = session()->put('session',$password);
            if(Auth::attempt($data)){
                return redirect('/top');
            }
        }
        return view("auth.login");
    }
    public function logout(){
  Auth::logout();
  return view("auth.login");
  }
}
