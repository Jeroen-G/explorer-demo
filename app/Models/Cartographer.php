<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
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
        return [
            'analysis' => [
                'analyzer' => [
                    'synonym' => [
                        'tokenizer' => 'standard',
                        'filter' => ['lowercase', 'synonym'],
                    ],
                ],
                'filter' => [
                    'synonym' => [
                        'type' => 'synonym',
                        'lenient' => true,
                        'synonyms' => [
                            'johannes => johan',
                        ],
                    ],
                ],
            ],
        ];
    }
}
