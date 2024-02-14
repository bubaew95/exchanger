<?php

namespace App\EventSubscriber;

use App\Repository\UserRepository;
use App\Service\UserCreateOrUpdateService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

readonly class CreateUserSubscriber implements EventSubscriberInterface
{
    public function __construct(private UserCreateOrUpdateService $createUser) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $route = $request->attributes->get('_route');
        $telegramId = $request->query->get('id', '');

        if($this->isPageLoginAndTelegramId($route, $telegramId)) {
            $this->createUser->createOrUpdate($request->query->all());
            $event->setResponse(new RedirectResponse($request->getRequestUri()));
        }
    }

    private function isPageLoginAndTelegramId(?string $route, string $telegramId): bool
    {
        return $route === 'app_login' && !empty($telegramId);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
