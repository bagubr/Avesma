<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImeiCheckRequest;
use App\Http\Requests\UserCreateRegisterFormRequest;
use App\Models\User;
use App\Models\UserPokdakan;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller {
    public function loginPhone(Request $request) {
        $user = UserRepository::findByPhone($request->phone)
            ?? $this->sendFailedResponse([], 'Maaf akun anda belum terdafar');
        [$user, $token] = UserService::authenticate($user);
        if($request->imei) {
            $user->update(['imei'=>$request->imei]);
        }
        return $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user
        ]);
    }

    public function loginEmail(Request $request) {
        $user = UserRepository::findByEmail($request->email)
            ?? $this->sendFailedResponse([], 'Maaf akun anda belum terdafar');
        [$user, $token] = UserService::authenticate($user);
        return $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user
        ]);
    }
    
    public function register(UserCreateRegisterFormRequest $request) {
        DB::beginTransaction();
        $user = UserService::create($request->toArray());        
        if($request->pokdakan_id)
            UserPokdakan::create(['user_id'=>$user->id,'pokdakan_id'=>$request->pokdakan_id]);
        [$user, $token] = UserService::authenticate($user);
        DB::commit();
        $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user,
        ]);
    }

    public function imeiCheck(ImeiCheckRequest $request) {
        $user = UserRepository::findByPhone($request->phone)
            ?? $this->sendFailedResponse([], 'Maaf akun anda belum terdafar');
        if(empty($user)) $this->sendFailedResponse([], 'Pengguna dengan nomer '.$request->phone.' tidak dapat ditemukan');
        if($user->imei != $request->imei) {
            $user->update(['imei'=>$request->imei]);
            $this->sendFailedResponse([], 'IMEI tidak cocok');
        }
        $token = $user->createToken($this->generateToken($user));
        $this->sendSuccessResponse([
            'token'=>$token->plainTextToken,
            'user'=>$user,
        ]);
    } 
}
