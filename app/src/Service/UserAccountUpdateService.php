<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

readonly class UserAccountUpdateService
{
    public function __construct(private EntityManagerInterface $em) { }

    public function update(User $user): void
    {
        $user->setIsEdit(true);

        $this->em->persist($user);
        $this->em->flush();
    }
}