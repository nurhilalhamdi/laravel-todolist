<?php

namespace App\Services;

interface UserService
{
    function login(String $user, String $password): bool;
}
