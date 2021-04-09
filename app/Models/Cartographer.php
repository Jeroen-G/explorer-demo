<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
use JeroenG\Explorer\Domain\Analysis\Analysis;
use JeroenG\Explorer\Domain\Analysis\Analyzer\StandardAnalyzer;
use JeroenG\Explorer\Domain\Analysis\Filter\SynonymFilter;
use Laravel\Scout\Searchable;

class Cartographer extends Model implements Explored, IndexSettings
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'place', 'lifespan'];

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
