<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFormRequest;
use App\Models\Cartographer;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;

class SearchController extends Controller
{
    public function __invoke(SearchFormRequest $request)
    {
        $people = Cartographer::search($request->get('keywords'))->get();

        return view('search', [
            'people' => $people,
            'query' => ElasticEngine::dump(),
        ]);
    }
}
