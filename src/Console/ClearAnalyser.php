<?php

namespace Aditya\PerformanceAnalyser\Console;

use Illuminate\Console\Command;
use Aditya\PerformanceAnalyser\Models\Collector;

class ClearAnalyser extends Command
{
    protected $signature = 'analyser:clear';

    protected $description = 'Clear the analyser logs';

    public function handle()
    {
        $this->info('Clearing Analyser Logs...');
        Collector::truncate();
        $this->info('Analyser Logs cleared...');
    }

}