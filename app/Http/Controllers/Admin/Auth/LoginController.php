<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/apply';

    public function __construct(LoginHistory $login_history)
    {
        $this->middleware('guest:admin')->except('logout');
        $this->login_history = $login_history;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function username()
    {
        return 'login_id';
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }

    public function loginInfoStore(String $login_id)
    {
        $results = DB::transaction(function () use ($login_id) {
            // フォーム内容を保存
            $form_data = $this->login_history->storeForm($login_id);
            return [
                $form_data,
            ];
        });
        try {
            if (!$results) {
                throw new \Exception('ログイン情報の保存に失敗しました');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $login_id = $request->login_id;
        $this->loginInfoStore($login_id);

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
}
