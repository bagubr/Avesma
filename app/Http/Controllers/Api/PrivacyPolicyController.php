<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacy_policy = PrivacyPolicy::first();
        return $this->sendSuccessResponse(['privacy_policy' => new PrivacyPolicyResource($privacy_policy)]);
    }
}
