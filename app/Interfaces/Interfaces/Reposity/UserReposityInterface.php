<?php

namespace App\Interfaces\Interfaces\Reposity;

use App\DTO\UserDTO;

interface UserReposityInterface
{
    public function createUser($userDTO);
    public function getUserByEmail($email);
    public function findUserByToken($token);
    
}
