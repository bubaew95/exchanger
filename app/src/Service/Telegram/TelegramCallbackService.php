<?php

namespace App\Service\Telegram;

use App\Model\TelegramCallbackQueryRequest;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Telegram;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class TelegramCallbackService
{
    public function __construct(
        private ContainerInterface $container,
        private Telegram $telegram
    ) {}

    public function init(TelegramCallbackQueryRequest $queryRequest)
    {
        $callbackData = $queryRequest->getCallbackQuery();
        $chatId = $callbackData->getChatId();
        $method = $callbackData->getMethod();
        $args = $callbackData->getArgs();

        if(false === method_exists($this, $method)) {
            throw new NotFoundHttpException('Такой метод не существует.');
        }

        return $this->{$method}($chatId, $args);
    }

    private function getImages(int $chatId, array $args): ?ServerResponse
    {
        $service = $this->container->get('service_advertisement_getImages');

        return $service->sendGroupImages($chatId, $args);
    }

    private function confirmExchange(int $chatId, array $args)
    {
        $service = $this->container->get('service_confirm_exchange_advertisement');

        return $service->confirmExchange($chatId, $args);
    }

    public function selectAdv(int $chatId, array $args)
    {
        $service = $this->container->get('service_select_advertisement');

        return $service->select($chatId, $args);
    }
}