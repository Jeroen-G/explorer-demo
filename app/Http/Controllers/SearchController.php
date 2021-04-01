<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFormRequest;
use App\Models\Cartographer;

class SearchController extends Controller
{
    public function __invoke(SearchFormRequest $request)
    {
        $people = Cartographer::search($request->get('keywords'))->get();

        return view('search', ['people' => $people]);
    }
}
