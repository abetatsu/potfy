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

Route::get('/terms/organizer', 'TermsController@organizer')->name('terms.organizer');
Route::get('/terms/privacy', 'TermsController@privacy')->name('terms.privacy');
Route::get('/terms/services', 'TermsController@services')->name('terms.services');

Route::namespace('User')->prefix('user')->name('user.')->group(function () {
    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    Route::get('login/twitter', 'Auth\LoginController@redirectToTwitter')->name('login.twitter');
    Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterCallback');

    Route::get('login/github', 'Auth\LoginController@redirectToGithub')->name('login.github');
    Route::get('login/callback/github', 'Auth\LoginController@handleGithubCallback');

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
        // コメント
        Route::resource('/portfolios/{portfolio}/comments', 'CommentController');
        // ストーリー
        Route::resource('/portfolios/{portfolio}/stories', 'StoryController');
        // 開発履歴
        Route::resource('/portfolios/{portfolio}/histories', 'HistoryController');
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
