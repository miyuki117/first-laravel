<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //
    protected $table = 'tweets'; // tweetsテーブルを参照する

    protected $fillable = ['message','user_id']; // message,user_idへの書き込みを許可する

        //userテーブルに対して「1」の関係（リレーション）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // tagテーブルに対して「多」追記
    public function tags()
    {
    return $this->belongsToMany(Tag::class);
    }
}
