<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

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

    public function login(Request $request)
    {
        //Error messages
        $messages = [
            "username.required" => "Username harus diisi",
            "username.exists" => "Username tidak ditemukan",
            "password.required" => "Password is required",
            "password.min" => "Password harus lebih dari 4 characters"
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
                'username' => 'required|exists:users,username',
                'password' => 'required|min:4'
            ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password ], $request->remember)) {
                // if successful -> redirect forward
                return $this->sendLoginResponse($request);
            }

            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors([
                'password' => 'Wrong password or this account not approved yet.',
            ]);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role_id == 1) {
            return redirect()->route('admin.index');
        } else if ($user->role_id == 2) {
            return redirect()->route('index');
        }
    }

    public function username()
    {
        return 'username';
    }
}