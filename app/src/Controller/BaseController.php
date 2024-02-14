<?php

namespace App\Controller;

use App\Repository\MetaRepository;
use App\Service\BannerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    public function __construct(
        private readonly MetaRepository $metaRepository,
        protected readonly RequestStack   $requestStack,
        private readonly BannerService  $bannerService
    ) {}

    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $data = [
            ...$parameters,
            'meta' => $this->getMetaData(),
            'banners' => $this->getBanners(),
            'lang' => $this->getCurrentLanguage(),
        ];
        return parent::render($view, $data, $response);
    }

    public function getMetaData()
    {
        $url = $this->getCurrentUrl();
        return $this->metaRepository->findMetaByUrl($url) ?? [];
    }

    public function getBanners(): ?array
    {
        $url = $this->getCurrentUrl();

        return $this->bannerService->getBannerByUrl($url);
    }

    private function getCurrentUrl(): string
    {
        return $this->requestStack->getCurrentRequest()->getPathInfo();
    }

    private function getCurrentLanguage(): string
    {
        return $this->requestStack->getCurrentRequest()->attributes->get('_locale') ?? 'ru';
    }
}