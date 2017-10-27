<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only(['login', 'password']);
        $key = $this->username();
        $credentials[$key] = array_pull($credentials, 'login');

        try {
            $this->validateLogin($request);
        } catch (Exception $e) {
            return errorJson($e->getMessage());
        }

        if ($this->guard()->attempt($credentials, false)) {
            return $this->sendLoginResponse($request);
        }

        return errorJson('登录账号或密码错误!请重新输入!');
    }

    protected function validateLogin(Request $request)
    {
        $rules = [
            'login' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'login.required' => '请输入登录账号!',
            'password.required' => '请输入登录密码!',
        ];

        return $this->validate($request, $rules, $messages);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();
        $request->session()->regenerate();

        return redirect(route('backend::auth.login.get'));
    }

    protected function username()
    {
        $login = Input::input('login');

        return filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    protected function createDefaultUser()
    {
        return User::create([
            'username' => 'ruooooooli',
            'email' => 'ruooooooli@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = Auth::user();
        $user->login_count += 1;
        $user->last_login = Carbon::now();
        $user->update();

        return successJson('登录成功!');
    }
}
