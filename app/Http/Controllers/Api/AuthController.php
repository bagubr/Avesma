<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImeiCheckRequest;
use App\Http\Requests\UserCreateRegisterFormRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function loginPhone(Request $request) {
        $user = UserRepository::findByPhone($request->phone);
        if(empty($user)) $this->sendFailedResponse([], 'Pengguna dengan nomer '.$request->phone.' tidak dapat ditemukan');
        $token = $user->createToken($user->email);
        return $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user
        ]);
    }

    public function loginEmail(Request $request) {
        $user = UserRepository::findByEmail($request->email);
        if(empty($user)) $this->sendFailedResponse([], 'Pengguna dengan nomer '.$request->phone.' tidak dapat ditemukan');
        $token = $user->createToken($user->email);
        return $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user
        ]);
    }

    public function register(UserCreateRegisterFormRequest $request) {
        $user = UserService::create($request->toArray());        
        $token = $user->createToken($user->email);
        $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user,
        ]);
    }

    public function imeiCheck(ImeiCheckRequest $request) {
        $user = UserRepository::findByPhone($request->phone);
        if(empty($user)) $this->sendFailedResponse([], 'Pengguna dengan nomer '.$request->phone.' tidak dapat ditemukan');
        if($user->imei != $request->imei) {
            $user->update(['imei'=>$request->imei]);
            $this->sendFailedResponse([], 'IMEI tidak cocok');
        }
        $token = $user->createToken($user->email);
        $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user,
        ]);
    } 
}
