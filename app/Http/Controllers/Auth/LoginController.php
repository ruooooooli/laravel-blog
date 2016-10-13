<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Input;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('backend::auth.login.get');

        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        // self::createDefaultUser();
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials        = $request->only(['login', 'password']);
        $key                = $this->username();
        $credentials[$key]  = array_pull($credentials, 'login');

        try {
            $this->validateLogin($request);
        } catch (\Exception $e) {
            return errorJson($e->getMessage());
        }

        if ($this->guard()->attempt($credentials, false)) {
            $request->session()->regenerate();
            return successJson('登录成功!');
        }

        return errorJson('登录账号或密码错误!请重新输入!');
    }

    public function validateLogin(Request $request)
    {
        $rules = array(
            'login'     => 'required',
            'password'  => 'required',
        );

        $messages = array(
            'login.required'    => '请输入登录账号!',
            'password.required' => '请输入登录密码!',
        );

        return $this->validate($request, $rules, $messages);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(route('backend::auth.login.get'));
    }

    private function username()
    {
        return (Str::contains(Input::get('login'), '@')) ? 'email' : 'username';
    }

    private function createDefaultUser()
    {
        return User::create([
            'username'  => 'admin',
            'email'     => 'admin@fun-x.cn',
            'password'  => bcrypt('admin'),
        ]);
    }
}
