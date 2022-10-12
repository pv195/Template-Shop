<?php

namespace App\Repositories;

use App\Interfaces\LoginSocialRepositoryInterface;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialRepository implements LoginSocialRepositoryInterface
{
    /**
     * redirect to social network service
     *
     * @param string $social
     * @return mixed
     */
    public function redirectToSocial(string $social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * redirect from social network to home page 
     * @param string $social
     * @return mixed
     */
    public function handleSocialCallback(string $social)
    {
        $user = Socialite::driver($social)->user();
        $this->registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('home.index');
    }

    /**
     * register or login for social account
     *
     * @param mixed $data
     */
    protected function registerOrLoginUser($data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = encrypt('12345678');
            $user->phone = "03489898";
            $user->provider_id = $data->id;
            $user->image = $data->avatar;
            $user->save();
        }
        auth()->login($user);
    }
}
