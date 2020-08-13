<?php


namespace App\Services\Currency;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Class CurrencyService
 * @package App\Services
 */
class FinhubService implements CurrencyService
{

    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var string
     */
    private $url;

    /**
     * CurrencyService constructor.
     */
    public function __construct()
    {
        $this->apiKey = config('services.finhub.key');
        $this->url = config('services.finhub.url');
    }

    /**
     * @return float
     */
    public function getEuroRate(): ?float
    {
        if (is_null(Cache::get('euro_rate'))) {
            $response = Http::get(sprintf($this->url, $this->apiKey));
            if (!isset($response['quote']['EUR'])) {
                return null;
            }
            Cache::put('euro_rate', $response['quote']['EUR'], 600);
        }
        return Cache::get('euro_rate');
    }
}
