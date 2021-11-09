<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index(Request $request) {
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
            'user'=>$user
        ]);
    }

    public function update(UserCreateRegisterFormRequest $request) {
        $user = $request->user()->update($request->toArray());
        $user = User::find($request->user()->id);

        return $this->sendSuccessResponse([
            'user'=>$user
        ]);
    }

    public function updateAvatar(Request $request) {
        $user = $request->user();
        $avatar = $request->file('file')->move('storage/avatar', $request->user()->id.'-'.time().'.'.$request->file('file')->getClientOriginalExtension());
        $user->update([
            'avatar'=>$avatar
        ]);
        $user->refresh();

        return $this->sendSuccessResponse([
            'avatar'=>$user->avatar_url,
            'user'=>$user
        ]);
    }

    public function show() {

    }
}
