<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends BaseFixtures
{
    private const PAGES = [
        'contacts', 'offer', 'faq'
    ];

    private function getContent(?string $pageName)
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/pages.json'), true);

        return $data[$pageName] ?? $this->faker->realText(1024);
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Page::class, function (Page $page, int $index) {
            $item = self::PAGES[$index] ?? null;

            $page
                ->setTitle($this->faker->realText($this->faker->numberBetween(10, 20)))
                ->setText($this->getContent($item))
                ->setVisible(1)
            ;

            if(!is_null($item)) {
                $page->setAlias($item);
            }

        }, 5);
    }
}
