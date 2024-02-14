<?php

namespace App\Service\TelegramNotifier\Model;

use App\Exception\TelegramSendException;
use App\Service\TelegramNotifier\AbstractTelegram;
use App\Service\TelegramNotifier\Interface\KeyboardInterface;
use App\Service\TelegramNotifier\Interface\TelegramInterface;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class SendMessage extends AbstractTelegram implements TelegramInterface
{
    public function messageThreadId(int $threadId): static
    {
        $this->options['message_thread_id'] = $threadId;

        return $this;
    }

    public function fromChatId(int|string $fromChatId): static
    {
        $this->options['from_chat_id'] = $fromChatId;

        return $this;
    }

    public function messageId(int $messageId): static
    {
        $this->options['message_id'] = $messageId;

        return $this;
    }

    public function text(string $caption): static
    {
        $this->options['text'] = $caption;

        return $this;
    }

    public function disableNotification(bool $disable_notification): static
    {
        $this->options['disable_notification'] = $disable_notification;

        return $this;
    }

    public function replyToMessageId(bool $reply_to_message_id): static
    {
        $this->options['reply_to_message_id'] = $reply_to_message_id;

        return $this;
    }

    public function allowSendingWithoutReply(bool $allow_sending_without_reply): static
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
            return Request::sendMessage($this->options);
        } catch (TelegramException $e) {
            throw new TelegramSendException($e->getMessage());
        }
    }
}