<?php

namespace App\Controller;

use App\Service\BannerService;

class BannerController extends BaseController
{
    public function getBanner(string $url, BannerService $bannerService): ?array
    {
        return $bannerService->getBannerByUrl($url);
    }
}