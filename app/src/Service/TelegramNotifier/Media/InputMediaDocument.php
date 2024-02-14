<?php

namespace App\Service\TelegramNotifier\Media;

use App\Service\TelegramNotifier\AbstractTelegram;

class InputMediaDocument extends AbstractTelegram
{
    public function __construct()
    {
        $this->options['type'] = 'document';
    }

    public function media(string $file): static
    {
        $this->options['media_item'] = $file;

        return $this;
    }

    public function thumbnail(string $thumbnail): static
    {
        $this->options['thumbnail'] = $thumbnail;

        return $this;
    }

    public function caption(string $caption): static
    {
        $this->options['caption'] = $caption;

        return $this;
    }
}