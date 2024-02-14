<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends BaseFixtures
{
    private const IMAGES = [
        'https://html.themexplosion.com/moly/assets/img/blog/blog-21.png',
        'https://html.themexplosion.com/moly/assets/img/blog/blog-23.png',
        'https://html.themexplosion.com/moly/assets/img/blog/blog-21.png',
        'https://html.themexplosion.com/moly/assets/img/blog/blog-18.png'
    ];

    private function getContent()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/news-content.json'), true);

        return $data[$this->faker->numberBetween(0, count($data) - 1)]['text'];
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(News::class, function (News $news) {
            $news
                ->setTitle($this->faker->realText($this->faker->numberBetween(20, 50)))
                ->setText($this->getContent())
                ->setDescription($this->faker->realText(255))
                ->setImage($this->faker->randomElement(self::IMAGES))
                ->setVisible(1)
            ;
        }, 20);
    }
}
