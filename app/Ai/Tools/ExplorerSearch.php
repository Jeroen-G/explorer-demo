<?php

namespace App\Ai\Tools;

use App\Models\Cartographer;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Log;
use JeroenG\Explorer\Domain\Syntax\Compound\BoolQuery;
use JeroenG\Explorer\Domain\Syntax\Matching;
use JeroenG\Explorer\Domain\Syntax\Nested;
use JeroenG\Explorer\Domain\Syntax\Terms;
use JeroenG\Explorer\Infrastructure\Scout\ElasticEngine;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Laravel\Scout\Searchable;
use Stringable;

final class ExplorerSearch implements Tool
{
    /** @var class-string<Searchable> $modelClass */
    public function __construct(private string $modelClass, array $periodNames)
    {
    }

    public function description(): Stringable|string
    {
        return 'Use this tool when the user wants to search through documents';
    }

    public function handle(Request $request): Stringable|string
    {
        Log::info('tool called', $request->toArray());

        $search = $this->modelClass::search();

        if ($request->has('countries')) {
            $search->must(new Terms('place', explode(',', $request['countries'])));
        }

        if ($request->has('periods')) {
            $periodQuery = new BoolQuery();

            foreach (explode(',',$request['periods']) as $period) {
                $periodQuery->must(new Matching('period.name', $period));
            }

            $search->must(new Nested('period', $periodQuery));
        }

        $results = $search->take(100)->get();

        Log::info('query executed', ['debug' =>  ElasticEngine::debug()->array()]);

        return $results;
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'countries' => $schema->string()->description('list of comma separated countries')->required(),
            'periods' => $schema->string()->description('list of comma separated period names')->required(),
        ];
    }
}
