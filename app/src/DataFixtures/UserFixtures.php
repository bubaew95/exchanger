<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixtures
{
    private const USER_IDS = [
        [
            'id' => 5118436662,
            'name' => 'Максимус'
        ],
        [
            'id' => 6085519052,
            'name' => 'Джохар'
        ]
    ];

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(User::class, function (User $user, int $index) {
            $user
                ->setUsername($this->faker->userName)
                ->setStatus(1)
                ->setPhotoUrl('https://t.me/i/userpic/320/fu6cFx5hYNVDlhLPTKii7QUqGPaJmIDkj_n2SudOudlgZbtybbbGsDZIJXalCKfc.jpg')
                ->setFirstName(self::USER_IDS[$index]['name'])
                ->setId(self::USER_IDS[$index]['id']);
        }, 2);
    }
}
