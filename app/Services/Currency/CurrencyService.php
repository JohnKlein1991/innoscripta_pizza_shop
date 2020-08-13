<?php


namespace App\Services\Currency;


/**
 * Interface CurrencyService
 * @package App\Services
 */
interface CurrencyService
{
    /**
     * @return float
     */
    public function getEuroRate(): ?float;
}
