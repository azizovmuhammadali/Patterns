<?php

namespace App\Interfaces\Reposity;


interface UserReposityInterface
{
    public function createUser($userDTO);
    public function getUserByEmail($email);
    public function findUserByToken($token);
    
}
