<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Cartographer extends Model implements Explored
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'place', 'lifespan'];

    public function mappableAs(): array
    {
        return [
            'id' => 'keyword',
            'name' => 'text',
            'place' => 'keyword',
            'lifespan' => 'text',
        ];
    }
}
