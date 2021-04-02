<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFormRequest;
use App\Models\Cartographer;
use JeroenG\Explorer\Domain\Syntax\Matching;
use JeroenG\Explorer\Domain\Syntax\Terms;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;

class SearchController extends Controller
{
    public function show()
    {
        $people = Cartographer::all();

        return view('search', [
            'people' => $people,
            'countries' => $people->pluck('place')->unique(),
        ]);
    }

    public function search(SearchFormRequest $request)
    {
        $search = Cartographer::search($request->get('keywords'));

        if ($request->get('countries')) {
            $search->must(new Terms('place', $request->get('countries')));
        }

        $people = $search->get();

        return view('search', [
            'people' => $people,
            'countries' => $people->pluck('place')->unique(),
            'query' => ElasticEngine::debug()->json(),
        ]);
    }
}
