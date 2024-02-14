<?php

namespace App\Service\Telegram;

use App\Entity\Advertisement;
use App\Service\TelegramNotifier\Model\SendPhoto;
use App\Service\TelegramNotifier\Reply\Markup\Button\InlineKeyboardButton;
use App\Service\TelegramNotifier\Reply\Markup\InlineKeyboardMarkup;
use App\Trait\EscapeTrait;
use Longman\TelegramBot\Telegram;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

readonly class SendPhotoService
{
    use EscapeTrait;

    public function __construct(
        private Telegram $telegram,
        private UrlGeneratorInterface $urlGenerator,
        private LoggerInterface $logger
    ) {}

    public function createNotifier(Advertisement $advertisement, Advertisement $proposedAdvertisement): void
    {
        $chatId = $advertisement->getUser()->getId();
        $text = "🔰 По вашему объявлению \"*%s\"* есть новое предложение.\r\n\r\n";
        $text .= "*{title}*\r\n\r\n";
        $text .= "Описание: {text}";

        $text = sprintf($text, $advertisement->getName());

        $getImagesJson = json_encode([
            'method' => 'getImages',
            'args' => ['prId' => $proposedAdvertisement->getId(), 'advId' => $advertisement->getId()]
        ]);

        $accessJson = json_encode([
            'method' => 'confirmExchange',
            'args' => ['prId' => $proposedAdvertisement->getId(), 'advId' => $advertisement->getId()]
        ]);

        $response = $this->generateMessage($proposedAdvertisement, $chatId, $text)
            ->replyMarkup((new InlineKeyboardMarkup())->inlineKeyboard([
                [
                    (new InlineKeyboardButton('🖼 Посмотреть фото'))
                        ->callbackData($getImagesJson),
                    (new InlineKeyboardButton('🔗 Посмотреть на сайте'))->url(
                        'https://127.0.0.1' . $this->urlGenerator->generate('app_advertisement_details', ['slug' => $advertisement->getSlug()], )
                    ),
                ],
                [
                    (new InlineKeyboardButton('✅ Принять предложение'))->callbackData($accessJson),
                ]
            ]))
            ->send()
        ;

        $this->logger->info('response_create_notifier', [
            'response' => $response->toJson()
        ]);
    }

    public function deleteNotifier(Advertisement $advertisement, Advertisement $proposedAdvertisement): void
    {
        $chatId = $advertisement->getUser()->getId();
        $text = "🚫 Предложение по вашему объявлению \"*{$advertisement->getName()}*\" было отменено.\r\n\r\n";
        $text .= "*{title}*\r\n\r\nОписание: {text}";

        $response = $this
            ->generateMessage($proposedAdvertisement, $chatId, $text)
            ->send()
        ;

        $this->logger->info('response_delete_notifier', [
            'response' => $response->toJson()
        ]);
    }

    private function generateMessage(Advertisement $advertisement, int $chatId, string $message = ''): SendPhoto
    {
        $title = $advertisement->getName();
        $description = $advertisement->getSeoDescription();

        $fields = [
            '{title}' => "♨️ {$title}",
            '{text}' => $description
        ];

        $images = $advertisement->getImages()[0]?->getImage() ?? 'img/noimage.png';

        return (new SendPhoto())
            ->chatId($chatId)
            ->upload($images)
            ->parseMode()
            ->caption(
                $this->escapedText(str_replace(
                    array_keys($fields),
                    array_values($fields), $message
                ))
            )
        ;
    }
}