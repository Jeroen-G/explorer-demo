<?php

namespace App\Ai\Agents;

use App\Ai\Tools\ExplorerSearch;
use App\Models\Cartographer;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Promptable;
use Stringable;

class Librarian implements Agent, HasTools
{
    use Promptable;

    public function __construct() {}

    public function instructions(): Stringable|string
    {
        return 'You are a cartography librarian, providing details on historic cartographers.';
    }

    /**
     * @return Tool[]
     */
    public function tools(): iterable
    {
        $possiblePeriodNames = Cartographer::pluck('period_name')->unique()->filter(fn($v) => $v !==null)->toArray();

        return [
            new ExplorerSearch(Cartographer::class, $possiblePeriodNames)
        ];
    }

}
