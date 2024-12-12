<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController; // 追記


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// グループで囲み、その中にエンドポイントを作成
Route::group(['middleware' => ['auth']], function () { //ログイン画面を挟む
    Route::get('/tweets', [TweetController::class, 'index'])->name('tweets.index'); //tweetのページへ
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store'); //取得_contorollerのstoreメソッド
    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit'); //編集_contorollerのeditメソッド
    Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update'); //更新_
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy'); //削除

});


require __DIR__.'/auth.php';