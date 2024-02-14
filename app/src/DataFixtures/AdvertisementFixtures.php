<?php

namespace App\DataFixtures;

use App\Entity\Advertisement;
use App\Entity\AdvertisementImages;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AdvertisementFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Advertisement::class, function (Advertisement $advertisement) use($manager) {
            $advertisement
                ->setName($this->faker->realText($this->faker->numberBetween(20, 100)))
                ->setText($this->faker->realText)
                ->setExchangeForWhat($this->faker->realText(100))
                ->setSeoDescription($this->faker->realText(255))
                ->setPrice($this->faker->boolean ? $this->faker->numberBetween(2000, 9999) : null)
                ->setUser($this->getRandomReference(User::class))
                ->setStatus(1)
            ;

            $flag = false;
            $rand = $this->faker->numberBetween(3, 10);

            for ($i = 0; $i < $rand; $i++) {
                $advertisementImage = (new AdvertisementImages())
                    ->setAdvertisement($advertisement)
                    ->setImage("upload/img_{$i}.png")
                ;

                if($i === ($rand - 1) && !$flag) {
                    $advertisementImage->setBase(1);

                    $flag = true;
                }

                $manager->persist($advertisementImage);
            }

        }, 40);
    }

    public function getDependencies() : array
    {
        return [UserFixtures::class];
    }
}
