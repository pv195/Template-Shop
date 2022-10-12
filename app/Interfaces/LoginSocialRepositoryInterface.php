<?php

namespace App\Interfaces;

interface LoginSocialRepositoryInterface
{
    public function redirectToSocial(string $social);
    public function handleSocialCallback(string $social);
}
