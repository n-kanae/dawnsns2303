<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'username' => 'HRI太郎',
                'mail' => 'tarou@mail.com',
                'password' => Hash::make('tarou11'), //パスワードをハッシュ化、もとの文字列から変換する
                'bio' => 'よろしくお願いします',
                'created_at' => '2021-3-1 18:35:48',
                'updated_at' => '2021-3-1 18:35:48',
            ]
            ]);
    }
}
