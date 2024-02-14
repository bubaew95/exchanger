<?php

namespace App\Security;

use App\Repository\UserRepository;
use App\Service\UserCreateOrUpdateService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class TelegramAuthenticator extends AbstractAuthenticator
{
    use TargetPathTrait;

    private const USER_IDENTIFIER = 'telegram.identifier.id';

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly UserRepository $userRepository
    )
    {}


    public function supports(Request $request): ?bool
    {
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        $query = $request->query;
        $id = $query->get('id', '');
        $request->getSession()->set(self::USER_IDENTIFIER, $id);

        return new SelfValidatingPassport(new UserBadge($id, function (string $userIdentifier) {
            return $this->userRepository->findUserByIdAndCheckDateAuth((int) $userIdentifier);
        }), []);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('app_index'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }
}