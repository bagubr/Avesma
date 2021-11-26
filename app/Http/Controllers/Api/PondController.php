<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PondCreateRequest;
use App\Http\Resources\PondResource;
use App\Http\Resources\ProcedureResourceFishSpecies;
use App\Models\FormProcedure;
use App\Models\Pond;
use App\Models\PondDetail;
use App\Models\Procedure;
use App\Models\User;
use App\Repositories\PondDetailRepository;
use App\Repositories\PondRepository;
use App\Repositories\ProcedureRepository;
use App\Services\PondService;
use Illuminate\Http\Request;
use ReflectionClass;

class PondController extends Controller
{
    public function index(Request $request)
    {
        $ponds = Pond::where('user_id', $request->user()->id)
            ->when($request->fish_species_id, function ($query) use ($request) {
                $query->whereHas('pond_detail', function ($q) use ($request) {
                    $q->where('fish_species_id', $request->fish_species_id);
                });
            })->when($request->status, function ($q) use ($request) {
                $q->where('status', 'ilike', '%' . $request->status . '%');
            })->get();
        if (empty($request->user()->id)) $this->sendFailedResponse([], 'Maaf, sepertinya anda harus login ulang');
        $this->sendSuccessResponse([
            'ponds' => PondResource::collection($ponds)
        ]);
    }

    public function store(PondCreateRequest $request)
    {
        $pond = PondRepository::createModel($request->user()->id, $request->name, $request->area, $request->latitude, $request->longitude, $request->address);
        $pond_detail = PondDetailRepository::createModel($request->fish_species_id, $request->seed_count, $request->seed_size, $request->feed_type);
        $pond = PondService::create($pond, $pond_detail);
        $pond = $pond->query()->with('pond_detail.fish_species')->find($pond->id);
        $this->sendSuccessResponse([
            'pond' => $pond
        ]);
    }

    public function show($id)
    {
        $pond = Pond::find($id);
        $procedures = FormProcedure::where('fish_species_id', $pond->pond_detail->fish_species_id)->get();
        $data = [
            'pond' => PondRepository::find($id),
            'form_procedures' => $procedures
        ];

        return $this->sendSuccessResponse($data);
    }

    public function statuses()
    {
        return $this->sendSuccessResponse([
            'statuses' => PondRepository::getStatuses()
        ]);
    }

    public function update(Request $request, $id)
    {
        $pond = PondRepository::find($id);
        $fillable = $pond->getFillable();

        $pond->update($request->only($fillable));
        $pond->refresh();

        $this->sendSuccessResponse([
            'pond' => $pond
        ]);
    }
}
