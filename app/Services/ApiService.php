<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    private $baseUrl = '';
    private $key = '';

    public function fetchData($endpoint, $params = [])
    {
        try {
            $defaultParams = [
                'key' => $this->key,
                'limit' => 500,
                'page' => 1
            ];

            $allParams = array_merge($defaultParams, $params);

            $response = Http::timeout(60)->get("{$this->baseUrl}{$endpoint}", $allParams);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error("API Error: {$response->status()}", [
                    'endpoint' => $endpoint,
                    'params' => $allParams
                ]);
                return null;
            }
        } catch (\Exception $e) {
            Log::error("API Exception: {$e->getMessage()}", [
                'endpoint' => $endpoint,
                'params' => $params
            ]);
            return null;
        }
    }

    public function fetchAllPages($endpoint, $params = [])
    {
        $allData = [];
        $page = 1;

        do {
            $params['page'] = $page;
            $response = $this->fetchData($endpoint, $params);

            if (!$response || empty($response['data'])) {
                break;
            }

            $allData = array_merge($allData, $response['data']);
            $page++;

            // Предполагаем, что если данных меньше лимита, то это последняя страница
            if (count($response['data']) < 500) {
                break;
            }

            // Небольшая задержка чтобы не перегружать API
            sleep(1);

        } while (true);

        return $allData;
    }
}