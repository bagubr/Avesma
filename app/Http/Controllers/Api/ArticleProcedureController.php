<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleProcedureRepository;
use Illuminate\Http\Request;

class ArticleProcedureController extends Controller
{
    public function index(Request $request)
    {
        return $this->sendSuccessResponse([
            'article_procedures' => ArticleProcedureRepository::get($request->toArray())
        ]);
    }

    public function show($id)
    {
        return $this->sendSuccessResponse([
            'article_procedure' => ArticleProcedureRepository::find($id)
        ]);
    }
}
