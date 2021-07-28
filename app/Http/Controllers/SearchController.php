<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFormRequest;
use App\Models\Cartographer;
use JeroenG\Explorer\Domain\Syntax\Compound\BoolQuery;
use JeroenG\Explorer\Domain\Syntax\Matching;
use JeroenG\Explorer\Domain\Syntax\Nested;
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
            'periods' => $people->pluck('period_name')->unique()->whereNotNull(),
        ]);
    }

    public function search(SearchFormRequest $request)
    {
        $search = Cartographer::search($request->get('keywords'));

        if ($request->get('countries')) {
            $search->must(new Terms('place', $request->get('countries')));
        }

        if ($request->get('periods')) {
            $periodQuery = new BoolQuery();

            foreach ($request->get('periods') as $period) {
                $periodQuery->must(new Matching('period.name', $period));
            }

            $search->must(new Nested('period', $periodQuery));
        }

        $people = $search->take(100)->get();

        return view('search', [
            'people' => $people,
            'countries' => $people->pluck('place')->unique(),
            'periods' => $people->pluck('period_name')->unique()->whereNotNull(),
            'query' => ElasticEngine::debug()->json(),
        ]);
    }
}
