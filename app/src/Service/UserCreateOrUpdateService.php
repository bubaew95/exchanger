<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\TelegramAuthorizationException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class UserCreateOrUpdateService
{
    private const CHECK_DAY = 7;

    public function __construct(
        private string $telegramBotToken,
        private EntityManagerInterface $em,
        private TelegramHashCheckService $checkService,
        private UserRepository $userRepository
    ) {}

    public function createOrUpdate(array $telegramUserData): void
    {
        $telegramId = (int)$telegramUserData['id'];

        if (!$this->checkService->isTelegramData($this->telegramBotToken, $telegramUserData)) {
            throw new TelegramAuthorizationException();
        }

        $user = $this->userRepository->loadUserByIdentifier($telegramId);
        if (null === $user) {
            $user = (new User())
                ->setId($telegramId)
                ->setStatus(1);
        }

        $this->updateUserProperties($user, $telegramUserData);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function updateUserProperties(User $user, array $telegramUserData): void
    {
        if (!$user->isIsEdit()) {
            $user
                ->setFirstName($telegramUserData['first_name'] ?? null)
                ->setLastName($telegramUserData['last_name'] ?? null);
        }

        $user
            ->setUsername($telegramUserData['username'] ?? null)
            ->setPhotoUrl($telegramUserData['photo_url'] ?? null)
            ->setAuthDate($telegramUserData['auth_date'] + (3600 * 24 * self::CHECK_DAY));
    }
}