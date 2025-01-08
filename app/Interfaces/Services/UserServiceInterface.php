<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    public function registerUser($userDTO);
    public function loginUser($data);
    public function verifyEmail($token);
}
