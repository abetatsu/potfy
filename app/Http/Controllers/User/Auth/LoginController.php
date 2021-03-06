<?php

namespace App\Http\Controllers\User\Auth;

use Socialite;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Enums\SocialType;
use App\SocialAccount;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('user');
    }

    // ログイン画面
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return $this->loggedOut($request);
    }

    // ログアウトした時のリダイレクト先
    public function loggedOut(Request $request)
    {
        return redirect(route('user.login'));
    }
    /**
     * Twitterの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitterからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $socialUser = User::firstOrCreate([
                'token'     => $user->token,
            ], [
                'token'     => $user->token,
                'name'      => $user->name,
                'email'     => $user->email,
                'image'     => str_replace('http://', 'https://', $user->avatar),
            ]);
            Auth::login($socialUser, true);

            $socialAccount = SocialAccount::firstOrCreate([
                'url'         => 'https://twitter.com/' . $user->nickname,
                'user_id'     => $socialUser->id,
            ],[
                'user_id'     => $socialUser->id,
                'url'         => 'https://twitter.com/' . $user->nickname,
                'social_type' => SocialType::TWITTER,
            ]);
        } catch (Exception $e) {
            return redirect()->route('user.login');
        }

        return redirect()->route('user.portfolios.index');
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            $socialUser = User::firstOrCreate([
                'email'     => $user->email,
            ], [
                'token'     => $user->token,
                'name'      => $user->name,
                'email'     => $user->email,
                'image'     => $user->avatar,
            ]);
            Auth::login($socialUser, true);

            $socialAccount = SocialAccount::firstOrCreate([
                'url'         => $user->user['html_url'],
                'user_id'     => $socialUser->id,
            ],[
                'user_id'     => $socialUser->id,
                'url'         => $user->user['html_url'],
                'social_type' => SocialType::GITHUB,
            ]);
        } catch (Exception $e) {
            return redirect()->route('user.login');
        }

        return redirect()->route('user.portfolios.index');
    }
}
