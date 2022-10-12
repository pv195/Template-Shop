<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\LoginSocialRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $loginSocialRepository;

    public function __construct(LoginSocialRepositoryInterface $loginSocialRepository)
    {
        $this->loginSocialRepository = $loginSocialRepository;
    }
    /**
     * show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * handle login
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.users.index');
            } else {
                return redirect()->route('home.index');
            }
        } else {
            return back()->with('error', __('messages.error_login'));
        }
    }

    /**
     * handle logout
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    /**
     * redirect to social
     *
     * @return mixed
     */
    public function redirectToSocial()
    {
        return $this->loginSocialRepository->redirectToSocial($this->checkCurrentSocialUrl());
    }

    /**
     * handle login social
     *
     * @return mixed
     */
    public function handleSocialCallback()
    {
        return $this->loginSocialRepository->handleSocialCallback($this->checkCurrentSocialUrl());
    }

    /**
     * get current social
     *
     * @return mixed
     */
    public function checkCurrentSocialUrl()
    {
        $social = "";
        if (request()->is('*/google/*') || request()->is('*/google')) {
            $social = config('const.social.google');
        } else if (request()->is('*/facebook/*') || request()->is('*/facebook')) {
            $social = config('const.social.facebook');
        } 
        // else {
        //     $social = config('const.social.github');
        // }

        return $social;
    }
}
