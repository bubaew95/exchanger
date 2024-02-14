<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\TelegramNotifier;

/**
 * @author Mihail Krasilnikov <mihail.krasilnikov.j@gmail.com>
 */
abstract class AbstractTelegram
{
    protected array $options = [];

    public function toArray(): array
    {
        return $this->options;
    }

    public function chatId(int|string $chatId): static
    {
        $this->options['chat_id'] = $chatId;

        return $this;
    }

    public function parseMode(string|EnumParseMode $parse_mode = EnumParseMode::PARSE_MODE_MARKDOWN_V2): static
    {
        $this->options['parse_mode'] = ($parse_mode instanceof EnumParseMode)
            ? $parse_mode->value
            : $parse_mode
        ;

        return $this;
    }
}
