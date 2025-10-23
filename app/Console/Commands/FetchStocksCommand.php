<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Stock;

class FetchStocksCommand extends Command
{
    protected $signature = 'fetch:stocks {dateFrom}';
    protected $description = 'Fetch stocks data from API';

    public function handle()
    {
        $apiService = new ApiService();
        
        $dateFrom = $this->argument('dateFrom');

        $this->info("Fetching stocks data for {$dateFrom}");

        $data = $apiService->fetchAllPages('/api/stocks', [
            'dateFrom' => $dateFrom
        ]);

        if ($data) {
            Stock::create([
                'data' => $data,
                'date_from' => $dateFrom
            ]);

            $this->info("Successfully fetched " . count($data) . " stocks records");
        } else {
            $this->error('Failed to fetch stocks data');
        }
    }
}