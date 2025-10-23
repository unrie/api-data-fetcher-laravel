<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Sale;

class FetchSalesCommand extends Command
{
    protected $signature = 'fetch:sales {dateFrom} {dateTo}';
    protected $description = 'Fetch sales data from API';

    public function handle()
    {
        $apiService = new ApiService();
        
        $dateFrom = $this->argument('dateFrom');
        $dateTo = $this->argument('dateTo');

        $this->info("Fetching sales data from {$dateFrom} to {$dateTo}");

        $data = $apiService->fetchAllPages('/api/sales', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);

        if ($data) {
            Sale::create([
                'data' => $data,
                'date_from' => $dateFrom,
                'date_to' => $dateTo
            ]);

            $this->info("Successfully fetched " . count($data) . " sales records");
        } else {
            $this->error('Failed to fetch sales data');
        }
    }
}