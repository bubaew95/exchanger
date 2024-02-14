<?php

namespace App\Service;

use App\Entity\Banner;
use App\Repository\BannerRepository;

readonly class BannerService
{
    public function __construct(private BannerRepository $bannerRepository){}

    public function getBannerByUrl(string $url): ?array
    {
        $banners = $this->bannerRepository->findBannerByUrlOrAllPage($url);
        $items = [];

        foreach ($banners as $banner) {
            $items[$banner->getSection()][$banner->getBlock()][] = $banner;
        }

        return $items;
    }
}