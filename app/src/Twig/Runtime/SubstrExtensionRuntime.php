<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class SubstrExtensionRuntime implements RuntimeExtensionInterface
{
    public function subStr(string $text, int $length = 100, int $offset = 0) : string
    {
        $encoding = 'UTF-8';

        $slice = mb_substr($text, $offset, $length, $encoding);
        $lastSpace = mb_strrpos($slice, ' ', 0, $encoding);

        if ($lastSpace !== false) {
            $slice = mb_substr($slice, 0, $lastSpace, $encoding);
        }

        return strlen($text) > $length ? "{$slice}..." : $slice;
    }
}
