<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CompetitionCategory;
use Illuminate\Http\Request;

class CompetitionCategoryController extends Controller
{
    public function index(Request $request)
    {
        $dataContent = CompetitionCategory::orderBy('name');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }
}
