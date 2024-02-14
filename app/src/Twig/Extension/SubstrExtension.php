<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\SubstrExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class SubstrExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('substr', [SubstrExtensionRuntime::class, 'subStr']),
        ];
    }
}
