<?php

namespace App\Service\Telegram;

use App\Repository\ExchangeOffersRepository;
use App\Service\TelegramNotifier\Model\SendMessage;
use App\Service\TelegramNotifier\Reply\Markup\Button\InlineKeyboardButton;
use App\Service\TelegramNotifier\Reply\Markup\InlineKeyboardMarkup;
use App\Trait\EscapeTrait;
use Longman\TelegramBot\Entities\ServerResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class ConfirmExchangeAdvertisementService
{
    use EscapeTrait;

    public function __construct(
        private ExchangeOffersRepository $offersRepository,
        private TranslatorInterface $translatable
    ){}

    public function confirmExchange(int $chatId, array $args): ?ServerResponse
    {
        $offer = $this->offersRepository->findOfferWithProposeIdAndAdvId($args['prId'], $args['advId']);

        if(null === $offer) {
            return $this->generateMessage($chatId, $this->translatable->trans('telegram.confirm.out_of_date'))
                ->send()
            ;
        }

        $advertisement = $offer->getAdvertisement();
        $proposeAdvertisement = $offer->getProposedAdvertisement();
        $chatId = $proposeAdvertisement->getUser()->getId();

        $text = $this->translatable->trans('telegram.confirm.confirm', ['%title%' => $advertisement->getName()]);

        $access = json_encode([
            'method' => 'selectAdv',
            'args' => [
                'prId' => $proposeAdvertisement->getId(),
                'advId' => $advertisement->getId()
            ]
        ]);

        return $this->generateMessage($chatId, $text)
            ->replyMarkup((new InlineKeyboardMarkup())->inlineKeyboard([
                [
                    (new InlineKeyboardButton('✅ Да'))
                        ->callbackData($access),
                    (new InlineKeyboardButton('🚫 Нет'))
                        ->callbackData('cancel'),
                ],
                [
                    (new InlineKeyboardButton('🔗 Посмотреть на сайте'))->url(
                        'https://127.0.0.1'
                    )
                ]
            ]))
            ->send()
        ;
    }

    private function generateMessage(int $chatId, string $text): SendMessage
    {
        return (new SendMessage())
            ->chatId($chatId)
            ->text($this->escapedText($text) )
            ->parseMode()
        ;
    }

}