<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(Request $request)
    {
        if($request->isMethod('post')){
        $rule = [
        'username' => ['required','min:4' , 'max:12'],
		'mail' => ['required', 'email' , 'min:4' , 'max:12'],
		'password' => ['required' , 'min:4' , 'max:12'],
		'password-confirm' => ['required' , 'min:4' , 'max:12' , 'same:password'],
        ];

        $validator = Validator::make($request->all(), $rule ,$messages = [
        'username.required' => '必須項目です',
        'username.min' => '4文字以上で入力してください',
        'username.max' => '12文字以内で入力してください',
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
        ]);
        if ($validator->fails()) {
          return redirect('/register')
              ->withErrors($validator)
              ->withInput();
      }

        $data = $request->input();
            $this->create($data);
        $username = $request->username;
        return redirect('added')->with('username',$username);
    }
    return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $this->create($data);
            $username = $request->username;
            return redirect('added')->with('username',$username);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
