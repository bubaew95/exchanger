<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\TelegramNotifier\Reply\Markup;

use App\Service\TelegramNotifier\AbstractTelegram;
use App\Service\TelegramNotifier\Interface\KeyboardInterface;
use App\Service\TelegramNotifier\Reply\Markup\Button\InlineKeyboardButton;

/**
 * @author Mihail Krasilnikov <mihail.krasilnikov.j@gmail.com>
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 */
final class InlineKeyboardMarkup extends AbstractTelegram implements KeyboardInterface
{
    public function __construct()
    {
        $this->options['inline_keyboard'] = [];
    }

    /**
     * @param InlineKeyboardButton[] $buttons
     *
     * @return $this
     */
    public function inlineKeyboard(mixed $buttons = []): static
    {
        if(is_array($buttons[0])) {
            $buttons = array_map(function (array $sButtons) {
                return array_map(static fn (InlineKeyboardButton $button) => $button->toArray(), $sButtons);
            }, $buttons);
        } else {
            $buttons = array_map(static fn (InlineKeyboardButton $button) => $button->toArray(), $buttons);
        }

        $this->options['inline_keyboard'] = $buttons;

        return $this;
    }
}
