<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            [
                'user_id' => 'tarou',
                'post' => '最初の投稿',
                'created_at' => '2021-3-2 18:35:48',
                'updated_at' => '2021-3-2 18:35:48',
            ]
            ]);
    }
}
