<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 重定向用户信息到 GitHub 认证页面。
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 获取来自 GitHub 返回的用户信息。
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $data = User::firstOrCreate([
            'name' => $user->name,
        ], [
            'name'     => $user->name,
            'email'    => $user->email ?: 'xx@xx.com',
            'avatar'   => $user->avatar,
            'password' => bcrypt('123456'),
        ]);
        \Auth::login($data, true);
        return redirect('/');
    }

    /**
     * 微信第三方登录
     * @return mixed
     */
    public function redirectToWeixin()
    {
        return Socialite::driver('wechat')->redirect();
    }

    /**
     * 微信第三方登录回调地址
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleWeixinCallback()
    {
        $user = Socialite::driver('weixin')->user();
        $data = User::firstOrCreate([
            'name' => $user->name,
        ], [
            'name'     => $user->name,
            'email'    => $user->email ?: 'xx@xx.com',
            'avatar'   => $user->avatar,
            'password' => bcrypt('123456'),
        ]);
        \Auth::login($data, true);
        return redirect('/');
    }

}
