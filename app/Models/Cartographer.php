<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Aliased;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
use JeroenG\Explorer\Application\BePrepared;
use JeroenG\Explorer\Domain\Analysis\Analysis;
use JeroenG\Explorer\Domain\Analysis\Analyzer\StandardAnalyzer;
use JeroenG\Explorer\Domain\Analysis\Filter\SynonymFilter;
use Laravel\Scout\Searchable;

class Cartographer extends Model implements Explored, BePrepared, IndexSettings, Aliased
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'place', 'lifespan'];
    protected $perPage = 5;

    public function mappableAs(): array
    {
        return [
            'id' => 'keyword',
            'name' => [
                'type' => 'text',
                'analyzer' => 'synonym',
            ],
            'place' => 'keyword',
            'lifespan' => 'text',
        ];
    }

    public function prepare($searchable): array
    {
        if ($searchable['place'] === 'Sicily') {
            $searchable['place'] = ['Italy', 'Sicily'];
        }

        return $searchable;
    }

    public function indexSettings(): array
    {
        $synonymFilter = new SynonymFilter();
        $synonymFilter->setSynonyms(['mona lisa => leonardo']);

        $synonymAnalyzer = new StandardAnalyzer('synonym');
        $synonymAnalyzer->setFilters(['lowercase', $synonymFilter]);

        return (new Analysis())
            ->addAnalyzer($synonymAnalyzer)
            ->addFilter($synonymFilter)
            ->build();
    }
}
