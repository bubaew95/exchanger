<?php

namespace App\Service\TelegramNotifier\Model;

use App\Exception\TelegramSendException;
use App\Service\TelegramNotifier\AbstractTelegram;
use App\Service\TelegramNotifier\Interface\TelegramInterface;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class SendMediaGroup extends AbstractTelegram implements TelegramInterface
{
    public function messageThreadId(int $message_thread_id): static
    {
        $this->options['message_thread_id'] = $message_thread_id;

        return $this;
    }

    public function media(array $media): static
    {
        $this->options['media'] = array_map(function (AbstractTelegram $media) {
            $mediaOptions = $media->toArray();
            $mediaOptions['media'] = "attach://{$mediaOptions['media_item']}";

            $this->options[$mediaOptions['media_item']] = Request::encodeFile(realpath($mediaOptions['media_item']));

            unset($mediaOptions['media_item']);
            return $mediaOptions;
        }, $media);

        return $this;
    }

    public function disableNotification(string $disable_notification): static
    {
        $this->options['disable_notification'] = $disable_notification;

        return $this;
    }

    public function protectContent(string $protect_content): static
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

    public function send(): ServerResponse
    {
        try {
            return Request::sendMediaGroup($this->options);
        } catch (TelegramException $e) {
            throw new TelegramSendException($e->getMessage());
        }
    }
}