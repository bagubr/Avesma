<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UploadUserInformationRequest;
use App\Http\Requests\UserCreateRegisterFormRequest;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $user = User::withCount('ponds')
            ->select()
            ->selectRaw("
                (
                    select count(fish_specieses.*) from fish_specieses
                    left join pond_details on pond_details.fish_species_id = fish_specieses.id
                    left join ponds on ponds.id = pond_details.pond_id
                    where ponds.user_id = users.id
                ) as fish_species_count
            ")
            ->find($user->id);

        return $this->sendSuccessResponse([
            'user' => $user
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
        $ktp_photo = $request->file('ktp_photo')->store('storage/ktp_photo');
        $ktp_selfie_photo = $request->file('ktp_selfie_photo')->store('storage/ktp_selfie_photo');
        UserInformation::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'user_id' => $user_id,
            'nik' => $request->nik,
            'ktp_photo' => $ktp_photo,
            'ktp_selfie_photo' => $ktp_selfie_photo
        ]);

        return $this->sendSuccessResponse([], 'Berhasil mengupload data verifikasi');
    }
}
