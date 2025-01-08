<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;

class AuthController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserServiceInterface $userService){}
    public function register(Request $request){
        $userDTO = new UserDTO($request->name, $request->email, $request->password);
      $user =  $this->userService->registerUser($userDTO);
      SendEmailJob::dispatch($user);
      return $this->success(new UserResource($user),__('success.user.register'));
    }
    public function login(LoginRequest $request){
        $result = $this->userService->loginUser($request->all());
        if($result){
        return $this->success([
            'user' =>new UserResource($result['user']),
            'token' => $result['token']
        ],__('success.user.login'));
    }
    else{
        return $this->error(__('errors.user.login'));
    }
}
    public function findUser(Request $request){
        return $this->success(new UserResource($request->user()));
    }
    public function verifyEmail(Request $request){
        $message = $this->userService->verifyEmail($request->token);
        return $this->success([], $message);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->success([], __('success.user.logout'), 204);
    }
}
