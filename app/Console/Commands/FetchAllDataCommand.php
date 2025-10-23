<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchAllDataCommand extends Command
{
    protected $signature = 'fetch:all {dateFrom} {dateTo}';
    protected $description = 'Fetch all data from API';

    public function handle()
    {
        $dateFrom = $this->argument('dateFrom');
        $dateTo = $this->argument('dateTo');

        $this->call('fetch:sales', ['dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
        $this->call('fetch:orders', ['dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
        $this->call('fetch:stocks', ['dateFrom' => $dateFrom]);
        $this->call('fetch:incomes', ['dateFrom' => $dateFrom, 'dateTo' => $dateTo]);

        $this->info('All data fetching completed!');
    }
}