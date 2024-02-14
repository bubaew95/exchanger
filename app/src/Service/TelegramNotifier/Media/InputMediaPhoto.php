<?php

namespace App\Service\TelegramNotifier\Media;

use App\Service\TelegramNotifier\AbstractTelegram;

class InputMediaPhoto extends AbstractTelegram
{
    public function __construct()
    {
        $this->options['type'] = 'photo';
    }

    public function photo(string $url): static
    {
        $this->options['media'] = $url;

        return $this;
    }

    public function upload(string $file): static
    {
        $this->options['media_item'] = $file;

        return $this;
    }

    public function caption(string $caption): static
    {
        $this->options['caption'] = $caption;

        return $this;
    }
}