<?php

namespace App\Trait;

trait EscapeTrait
{
    public function escapedText(string $text): ?string
    {
        $specialCharacters = ['_', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!'];

        foreach ($specialCharacters as $char) {
            $text = str_replace($char, '\\' . $char, $text);
        }

        return $text;
    }
}