<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Interfaces\Reposity\UserReposityInterface;

class UserService implements UserServiceInterface
{
    use ResponseTrait;
    /**
     * Create a new class instance.
     */
    public function __construct(protected UserReposityInterface $userReposityInterface  ) {}
    public function registerUser($userDTO){
       $data = [
        'name' => $userDTO->name,
        'email'=> $userDTO->email,
         'password'=> $userDTO->password,
         'verification_token' => Str::random(20),
       ];
     return  $this->userReposityInterface->createUser($data);
    }
    public function loginUser($data){
      $user = $this->userReposityInterface->getUserByEmail($data['email']);
      if (!$user) {
          return $this->error(__('errors.user.not_found'));  
      }
      if (Hash::check($data['password'], $user->password)) {
          $token = $user->createToken('auth_login')->plainTextToken;
          return [
              'user' => $user,
              'token' => $token,
          ];
      } else {
          return $this->error(__('errors.user.login'));
      }
    }
    public function verifyEmail($token){
      return $this->userReposityInterface->findUserByToken($token);  
    }
}
