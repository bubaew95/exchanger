<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TelegramLoginController extends BaseController
{
    #[Route('/login', name: 'app_login')]
    public function login(string $telegramBotName, AuthenticationUtils $authenticationUtils) : Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_index');
        }

        return $this->render('login/telegram.html.twig', [
            'telegram_bot_name' => $telegramBotName,
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    public function widget(string $telegramBotName) : Response
    {
        return $this->render('login/widget.html.twig', [
            'telegram_bot_name' => $telegramBotName
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}