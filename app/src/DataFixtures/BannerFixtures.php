<?php

namespace App\DataFixtures;

use App\Entity\Banner;
use Doctrine\Persistence\ObjectManager;

class BannerFixtures extends BaseFixtures
{
    private const BANNERS = [
        [
            'title' => 'Men Ezy Ankle Pants',
            'sub_title' => '',
            'text' => 'Phasellus vel elit efficitur, gravida libero sit amet, scelerisque mauris. Morbi tortor arcu, commodo sit amet nulla sed.',
            'button_name' => 'Discover More',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'https://thred.com/wp-content/uploads/2020/02/SD_15_11_19-1920x1100.jpg',
            'block' => 'slider',
            'url' => '/',
        ],
        [
            'title' => 'Men Ezy Ankle Pants',
            'sub_title' => '',
            'text' => 'Phasellus vel elit efficitur, gravida libero sit amet, scelerisque mauris. Morbi tortor arcu, commodo sit amet nulla sed.',
            'button_name' => 'Discover More',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'https://html.themexplosion.com/moly/assets/img/slider/slider-bg-5.jpg',
            'block' => 'slider',
            'url' => '/',
        ],
        [
            'title' => 'Men Ezy Ankle Pants',
            'sub_title' => '',
            'text' => 'Phasellus vel elit efficitur, gravida libero sit amet, scelerisque mauris. Morbi tortor arcu, commodo sit amet nulla sed.',
            'button_name' => 'Discover More',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'https://html.themexplosion.com/moly/assets/img/slider/slider-bg-5.jpg',
            'block' => 'slider',
            'url' => '/',
        ],
        [
            'title' => 'Get Discount Info Men\'s T-shirt Summer Fashion - 2019',
            'sub_title' => 'Up To 75%',
            'text' => '',
            'button_name' => 'Buy Now',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'https://html.themexplosion.com/moly/assets/img/product/product-bg-9.png',
            'block' => 'card',
            'url' => '/',
        ],
        [
            'title' => 'Save 30%',
            'sub_title' => 'New in Store',
            'text' => 'Nulla iaculis erat vitae erat elementum, eu interdum sem bibendum.',
            'button_name' => 'Buy Now',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'https://html.themexplosion.com/moly/assets/img/product/product-bg-10.png',
            'block' => 'card',
            'url' => '/',
        ],
        [
            'title' => 'Men Blazer Collection 2019',
            'sub_title' => 'New in Store',
            'text' => '',
            'button_name' => 'view all collections',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'https://html.themexplosion.com/moly/assets/img/product/product-bg-12.png',
            'block' => 'card',
            'url' => '/',
        ],

        [
            'title' => '',
            'sub_title' => '',
            'text' => '',
            'button_name' => 'view all collections',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'upload/banner/img_0.png',
            'block' => 'full_banner',
            'url' => '/advertisements',
        ],
        [
            'title' => '',
            'sub_title' => '',
            'text' => '',
            'button_name' => 'view all collections',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'upload/banner/img_1.png',
            'block' => 'full_banner',
            'url' => '/advertisements',
        ],
        [
            'title' => '',
            'sub_title' => '',
            'text' => '',
            'button_name' => 'view all collections',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'upload/banner/img_2.png',
            'block' => 'bottom',
            'url' => '',
            'section' => 'all'
        ],
        [
            'title' => '',
            'sub_title' => '',
            'text' => '',
            'button_name' => 'view all collections',
            'button_link' => 'https://webhook.site/#!/1d792d04-d7ce-43ee-963c-6420a8277f64/3a928684-7823-4957-84c2-9b2fa1a1afa7/1',
            'image' => 'upload/banner/img_0.png',
            'block' => 'top',
            'url' => '',
            'section' => 'all'
        ],
    ];

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Banner::class, function (Banner $banner, int $index) {
            $item = self::BANNERS[$index];

            $banner
                ->setTitle($item['title'])
                ->setSubTitle($item['sub_title'])
                ->setImage($item['image'])
                ->setText($item['text'])
                ->setBlock($item['block'])
                ->setButtonName($item['button_name'])
                ->setButtonLink($item['button_link'])
                ->setUrl($item['url'])
                ->setSection($item['section'] ?? 'page')
                ->setVisible(1)
            ;

        }, count(self::BANNERS));
    }
}
