<?php

namespace App\Http\Controllers;

//モデルをuseする（使うモデルを入れる）
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Tag;


class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //tweettableの中身を表示
    {
        // echo ("index");
        $tweets = Tweet::all(); //select*from tweets

        //⑤view経由でボヤキを取得する

        // var_dampの出し方
        // dd($tweets);
        // dd(Tweet::where("id",1)->get()); 
        // dd(Tweet::orderBy('created_at','desc')->get()); 

        $tags = Tag::all(); //select*from tags
    
        // return view('tweets'); //tweetsの中身を返す。↓進化系

        return view('tweets', [ //tweets.blade.phpに表示
            'tweets' => $tweets, //取得したtweetsを返却する
            'tags' => $tags //取得したtagを返却する

        ]); //tweetsを引数で渡す

    

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //新規投稿用の中身を取得して保存
    {
        $tweet = Tweet::create([
            'message' => $request->message,
            'user_id'=> auth()->user()->id //赤字残っているけど大丈夫

        ]);

        $tweet->tags()->attach($request->tags); // 追記

        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet) // ここも $id から書き変わっている点注意！
    {
        $this->authorize('update', $tweet); // 追記
        $tags = Tag::all();
        $selectedTags = $tweet->tags->pluck('id')->all();
        return view('edit', [ //edit.blade.phpに表示
            'tweet' => $tweet,
            'tags' => $tags,
            'selectedTags' => $selectedTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet) // ここも変わってる点注意！
    {
        $this->authorize('update', $tweet); // 追記
            // ツイートのメッセージ内容を更新
        $tweet->update([
            'message' => $request->message
        ]);
            // ツイートに紐づいているタグを更新
        $tweet->tags()->sync($request->tags);
        return redirect()->route('tweets.index'); //更新処理したらindexに戻る
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet); // 追記
        $tweet->tags()->detach();
        $tweet->delete();
        return redirect()->route('tweets.index');
    }

}
