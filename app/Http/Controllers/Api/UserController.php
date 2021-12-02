<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UploadUserInformationRequest;
use App\Http\Requests\UserCreateRegisterFormRequest;
use App\Models\FishSpecies;
use App\Models\Pond;
use App\Models\PondDetail;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $user = User::find($user->id);
        $ponds_hatchery = Pond::where('user_id', $user->id)->where('status', '!=', Pond::STATUS3)->count();
        $ponds_harvest = Pond::where('user_id', $user->id)->where('status', Pond::STATUS2)->count();
        $fish_species_total = PondDetail::whereHas('pond', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->select('fish_species_id', DB::raw('count(*) as total'))
            ->groupBy('fish_species_id')->get()->count();
        return $this->sendSuccessResponse([
            'user' => $user,
            'ponds_hatchery_total' => $ponds_hatchery,
            'ponds_harvest_total' => $ponds_harvest,
            'fish_species_total' => $fish_species_total
        ]);
    }

    public function update(UserCreateRegisterFormRequest $request)
    {
        $user = $request->user()->update($request->toArray());
        $user = User::find($request->user()->id);

        return $this->sendSuccessResponse([
            'user' => $user
        ]);
    }

    public function updateAvatar(Request $request)
    {
        $user = $request->user();
        $avatar = $request->file('file')->move('storage/avatar', $request->user()->id . '-' . time() . '.' . $request->file('file')->getClientOriginalExtension());
        $user->update([
            'avatar' => $avatar
        ]);
        $user->refresh();

        return $this->sendSuccessResponse([
            'avatar' => $user->avatar_url,
            'user' => $user
        ]);
    }

    public function uploadInformation(UploadUserInformationRequest $request)
    {
        $user_id = $request->user()->id;
        $ktp_photo = $request->file('ktp_photo')->store('images', ['disk' => 'public']);
        $ktp_selfie_photo = $request->file('ktp_selfie_photo')->store('images', ['disk' => 'public']);
        UserInformation::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'user_id' => $user_id,
            'nik' => $request->nik,
            'ktp_photo' => $ktp_photo,
            'ktp_selfie_photo' => $ktp_selfie_photo,
            'status' => 'PENDING'
        ]);

        return $this->sendSuccessResponse([], 'Berhasil mengupload data verifikasi');
    }
}
