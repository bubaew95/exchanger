<?php

namespace App\Service\TelegramNotifier\Model;

use App\Exception\TelegramSendException;
use App\Service\TelegramNotifier\AbstractTelegram;
use App\Service\TelegramNotifier\Interface\KeyboardInterface;
use App\Service\TelegramNotifier\Interface\TelegramInterface;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class SendPhoto extends AbstractTelegram implements TelegramInterface
{
    public function messageThreadId(int $message_thread_id): static
    {
        $this->options['message_thread_id'] = $message_thread_id;

        return $this;
    }

    public function photo(string $url): static
    {
        $this->options['photo'] = $url;

        return $this;
    }

    public function upload(string $photo): static
    {
        $this->options['photo'] = Request::encodeFile(realpath($photo));

        return $this;
    }

    public function caption(string $caption): static
    {
        $this->options['caption'] = $caption;

        return $this;
    }

    public function hasSpoiler(bool $has_spoiler): static
    {
        $this->options['has_spoiler'] = $has_spoiler;

        return $this;
    }

    public function disableNotification(bool $disable_notification): static
    {
        $this->options['disable_notification'] = $disable_notification;

        return $this;
    }

    public function protectContent(bool $protect_content): static
    {
        $this->options['protect_content'] = $protect_content;

        return $this;
    }

    public function replyToMessageId(int $reply_to_message_id): static
    {
        $this->options['reply_to_message_id'] = $reply_to_message_id;

        return $this;
    }

    public function allowSendingWithoutReply(int $allow_sending_without_reply): static
    {
        $this->options['allow_sending_without_reply'] = $allow_sending_without_reply;

        return $this;
    }

    public function replyMarkup(KeyboardInterface $keyboard): static
    {
        $this->options['reply_markup'] = $keyboard->toArray();

        return $this;
    }

    public function send(): ServerResponse
    {
        try {
            return Request::sendPhoto($this->options);
        } catch (TelegramException $e) {
            throw new TelegramSendException($e->getMessage());
        }
    }
}