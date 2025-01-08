<?php

namespace App\Interfaces\Services;

use App\DTO\UserDTO;

interface UserServiceInterface
{
  public function registerUser($userDTO);
  public function loginUser($data);
  public function verifyEmail($token);
}
