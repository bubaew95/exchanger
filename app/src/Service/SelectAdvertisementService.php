<?php

namespace App\Service;

use App\Repository\ExchangeOffersRepository;
use App\Service\TelegramNotifier\Model\SendMessage;
use App\Trait\EscapeTrait;
use Longman\TelegramBot\Entities\ServerResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class SelectAdvertisementService
{
    use EscapeTrait;

    public function __construct(
        private ExchangeOffersRepository $offersRepository,
        private TranslatorInterface $translator
    ){}

    public function select(int $chatId, array $args): ServerResponse
    {
        $offer = $this->offersRepository->findOfferWithProposeIdAndAdvId($args['prId'], $args['advId']);
        $user = $offer->getUser();

        $text = $this->translator->trans('telegram.confirmExchange', [
            '%title%' => $offer->getAdvertisement()->getName(),
            '%phone%' => $user->getPhone()
        ]);

        return (new SendMessage())
            ->chatId($user->getId())
            ->text($this->escapedText($text))
            ->parseMode()
            ->send()
        ;
    }
}