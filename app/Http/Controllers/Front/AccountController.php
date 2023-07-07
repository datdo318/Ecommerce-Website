<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\User\UserServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('front.account.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::user_level_client, //Tai khoan cap do khach hang binh thuong
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            // return redirect(''); //trang chu
            return redirect('/');
        } else {
            return back()->with('notification', 'Lỗi: Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }

    public function register()
    {
        return view('front.account.register');
    }

    public function postRegister(Request $request)
    {

        if ($request->password != $request->password_confirmation) {
            return back()
                ->with('notification', 'Lỗi: Mật khẩu xác nhận không phù hợp');
        }
        // $existing = User::select('email')->where('email', $request->email)->pluck('email');

        // if ($existing[0]) {
        //     return back()
        //         ->with('notification', 'Lỗi: Email đã tồn tại vui lòng đăng ký email khác');
        // }
        $inputValues['email'] = $request->email;
        // checking if email exists in ‘email’ in the ‘users’ table
        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make($inputValues, $rules);

        if ($validator->fails()) {
            return back()
                ->with('notification', 'Lỗi: Email đã tồn tại vui lòng đăng ký email khác');
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'level' => Constant::user_level_client,
            ];

            $this->userService->create($data);
            return redirect('account/login')
                ->with('notification', 'Đăng ký thành công! Vui lòng đăng nhập');
        }
    }
}
