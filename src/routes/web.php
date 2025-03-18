<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ユーザー用問い合わせフォーム
Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
//送信ボタンがクリックされた時に confirm アクションが実行される
Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');


//管理者用問い合わせ管理
// Route::middleware('auth')->group(function () {
//     Route::get('/', [AuthController::class, 'index']);
// });
Route::middleware('auth')->group(function () {
    // Route::get('/admin', [AuthController::class, 'admin']);
    Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
    // 詳細表示用のルート
    Route::get('/contacts/{id}/details', [ContactController::class, 'show'])->name('contact.show');

    // 削除用のルート
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
});
//管理画面ができたら’’内の名前を変更する->admin

// 認証関連のルート (Fortifyが対応)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');