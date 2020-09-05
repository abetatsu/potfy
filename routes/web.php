<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'User\PortfolioController@top')->name('portfolio.top');

Route::namespace('User')->prefix('user')->name('user.')->group(function () {
    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    Route::get('login/twitter', 'Auth\LoginController@redirectToProvider')->name('login.twitter');
    Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        // コメント
        Route::resource('/portfolios/{portfolio}/comments', 'CommentController');
        // ストーリー
        Route::resource('/portfolios/{portfolio}/stories', 'StoryController');
        // ポートフォリオ
        Route::resource('portfolios', 'PortfolioController');
        // エンジニア
        Route::resource('users', 'UserController');
    });
});

Route::namespace('Company')->prefix('company')->name('company.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:company')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

        // companyページ
        Route::resource('companies', 'CompanyController');
    });
});
