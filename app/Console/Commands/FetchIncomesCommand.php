<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Income;

class FetchIncomesCommand extends Command
{
    protected $signature = 'fetch:incomes {dateFrom} {dateTo}';
    protected $description = 'Fetch incomes data from API';

    public function handle()
    {
        $apiService = new ApiService();
        
        $dateFrom = $this->argument('dateFrom');
        $dateTo = $this->argument('dateTo');

        $this->info("Fetching incomes data from {$dateFrom} to {$dateTo}");

        $data = $apiService->fetchAllPages('/api/incomes', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);

        if ($data) {
            Income::create([
                'data' => $data,
                'date_from' => $dateFrom,
                'date_to' => $dateTo
            ]);

            $this->info("Successfully fetched " . count($data) . " incomes records");
        } else {
            $this->error('Failed to fetch incomes data');
        }
    }
}