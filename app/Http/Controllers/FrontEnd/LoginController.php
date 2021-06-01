<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Support\EWalletHelper;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * function render view login page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('/')->with('status', 'Logged');
        }

        return view('frontend.auth.login');
    }

    /**
     * function post login and redirect success page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $param = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(!Auth::check()) {
            if (Auth::attempt($param)) {
                return redirect('/');
            }

            return redirect('login')->with('status', 'Sai tài khoản hoặc mật khẩu');
        }

        return redirect('/')->with('status', 'Bạn đang đăng nhập rồi.');
    }

    /**
     * function render view register page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function register()
    {
        if (!Auth::check()) {
            return view('frontend.auth.register');
        }

        return redirect('/')->with('status', 'Bạn đang đăng nhập rồi!');
    }

    /**
     * function insert account to DB and redirect to login page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $param = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        if ($this->checkAlreadyEmail($param) === false) {
            return redirect('/register')->with('status', 'Email này đã tồn tại.');
        }
        DB::beginTransaction();
        $user = new User();
        $user->name = $param['name'];
        $user->email = $param['email'];
        $user->password = Hash::make($param['password']);
        $user->role = config('const.role.user');
        try {
            $user->save();
            // create new e-wallet
            $param['user_id'] = $user->id;
            app()->make(EWalletHelper::class)->createWallet($param);
            DB::commit();
            return redirect('login')->with('status', 'Đăng ký thành công, hãy đăng nhập vào hệ thống.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect('register')->with('status', 'Đăng ký thất bại, hãy kiểm tra lại thông tin!');
        }
    }

    /**
     * function validate email
     *
     * @param array $param
     * @return bool
     */
    private function checkAlreadyEmail($param)
    {
        $checkEmail = DB::table('users')->where('email', $param['email'])->count();
        if ($checkEmail > 0) {
            return false;
        }

        return true;
    }

    /**
     * function logout and redirect page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }

        return redirect()->back();
    }

    /**
     * function render view forgot password page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function forgotPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect()->back()->with('status', 'Logged');
        }

        return view('frontend.auth.forgot');
    }
}
