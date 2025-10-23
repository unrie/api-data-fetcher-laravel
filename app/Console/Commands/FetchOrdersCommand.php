<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use App\Models\Order;

class FetchOrdersCommand extends Command
{
    protected $signature = 'fetch:orders {dateFrom} {dateTo}';
    protected $description = 'Fetch orders data from API';

    public function handle()
    {
        $apiService = new ApiService();
        
        $dateFrom = $this->argument('dateFrom');
        $dateTo = $this->argument('dateTo');

        $this->info("Fetching orders data from {$dateFrom} to {$dateTo}");

        $data = $apiService->fetchAllPages('/api/orders', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);

        if ($data) {
            Order::create([
                'data' => $data,
                'date_from' => $dateFrom,
                'date_to' => $dateTo
            ]);

            $this->info("Successfully fetched " . count($data) . " orders records");
        } else {
            $this->error('Failed to fetch orders data');
        }
    }
}