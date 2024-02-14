<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\HexColorWithNameExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class HexColorWithNameExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('hexColor', [HexColorWithNameExtensionRuntime::class, 'hexColor']),
        ];
    }
}
