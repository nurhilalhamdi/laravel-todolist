<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{

    private array $users = [
        "hilal" => "h@mdi443G"
    ];

    function login(String $user, String $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];

        if ($password == $correctPassword) {
            return true;
        } else {
            return false;
        }
    }
}
