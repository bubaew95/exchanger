<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class HexColorWithNameExtensionRuntime implements RuntimeExtensionInterface
{
    public function hexColor(string $text) : string
    {
        return sprintf('#%s', substr(md5($text), 5, 6));
    }
}
