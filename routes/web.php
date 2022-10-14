<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/test', [TestController::class, 'test']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registering'])->name('registering');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/auth/redirect/{provider}', function ($provider) {

    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');
Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    //if (auth()->check())
    Artisan::call('cache:clear');
    if (Cache::has('news_index')) {
        return Cache::get('news_index');
    } else {
        // $news = News::all();
        $cachedData = view('layout.master')->render();
        Cache::put('news_index', $cachedData);
        return $cachedData;
    }
    //    return view('layout.master');
    //  return redirect()->route('login')->with('status', 'vui long dang nhap');
})->name('welcome');
Route::get('/test', [TestController::class, 'test']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
