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

/**
 * @author Mihail Krasilnikov <mihail.krasilnikov.j@gmail.com>
 *
 * @see https://core.telegram.org/bots/api#forcereply
 */
final class ForceReply extends AbstractTelegram implements KeyboardInterface
{
    public function __construct(bool $forceReply = false, bool $selective = false)
    {
        $this->options['force_reply'] = $forceReply;
        $this->options['selective'] = $selective;
    }
}
