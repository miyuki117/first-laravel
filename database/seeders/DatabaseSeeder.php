<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // userにダミーデータ追加
        \App\Models\User::create([
            'name' => 'ぼやき太郎',
            'email' => 'boyaki@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::create([
            'name' => 'つぶやき次郎',
            'email' => 'tubuyaki@example.com',
            'password' => bcrypt('password'),
        ]);



        \App\Models\Tweet::create([
            'message' => 'テストユーザによる投稿',
            'user_id' => 1
        ]);
        \App\Models\Tweet::create([
            'message' => 'ぼやき太郎による投稿',
            'user_id' => 2
        ]);


        //tagにダミーデータ追加
        \App\Models\Tag::create([
            'name' => 'ライフハック'
        ]);
        \App\Models\Tag::create([
            'name' => 'エッセイ'
        ]);
        \App\Models\Tag::create([
            'name' => 'お知らせ'
        ]);
            }
}
