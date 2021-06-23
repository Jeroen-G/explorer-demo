<?php

namespace App\Http\Controllers;

use App\Models\Cartographer;
use Illuminate\Http\Request;
use JeroenG\Explorer\Application\Results;
use JeroenG\Explorer\Domain\Aggregations\TermsAggregation;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;

class AggregateController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = Cartographer::search();

        $search->aggregation('places', new TermsAggregation('place'));

        /** @var Results $results */
        $results = $search->raw();

        return view('aggregations', [
            'aggregations' => $results->aggregations(),
            'query' => ElasticEngine::debug()->json(),
        ]);
    }
}
