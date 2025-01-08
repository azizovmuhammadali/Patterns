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
  if(Hash::check($data['password'], $user['password'])){
      return $this->success(new UserResource($user),__('success.user.login'));
} else{
  return $this->error(__('errors.user.login'));
}
    }
    public function verifyEmail($token){
        $this->userReposityInterface->findUserByToken($token);
        return 'Email verified successfully!';
    }
}
