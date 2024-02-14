<?php

namespace App\DataFixtures;

use App\Entity\Meta;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MetaFixtures extends BaseFixtures
{
    private const PAGES = [
        [
            'url' => '/',
            'seo_title' => 'Главная страница',
            'title' => 'Главная страница',
        ],
        [
            'url' => '/advertisements',
            'seo_title' => 'Объявления',
            'title' => 'Все объявления',
        ],
        [
            'url' => '/contacts',
            'seo_title' => 'Контакты',
            'title' => 'Страница контактов',
        ],
        [
            'url' => '/news',
            'seo_title' => 'Новости',
            'title' => 'Все новости',
        ]
    ];

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Meta::class, function (Meta $meta, int $index) {
            $pages = self::PAGES[$index];

            $meta
                ->setUrl($pages['url'])
                ->setTitle($pages['title'])
                ->setSeoTitle($pages['seo_title'])
                ->setDescription($this->faker->realText(255))
                ->setKeywords($this->faker->realText(255))
            ;

        }, count(self::PAGES));
    }
}
