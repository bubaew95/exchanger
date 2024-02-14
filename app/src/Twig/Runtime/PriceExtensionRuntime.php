<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class PriceExtensionRuntime implements RuntimeExtensionInterface
{
    private const CURRENCIES = [
        'rub' => '₽',
        'usd' => '$',
        'eur' => '€'
    ];

    public function priceFormat(float $price, string $currency = 'rub') : string
    {
        return sprintf("%s %s",
            number_format($price, 0, '.', ' '),
            self::CURRENCIES[$currency]
        );
    }
}
