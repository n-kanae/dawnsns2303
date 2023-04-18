<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
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
