<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends BaseController
{
    private const ALIAS_PARAM_NAME = 'page';

    public function page(Request $request, PageRepository $pageRepository): Response
    {
        if(!$request->attributes->has(self::ALIAS_PARAM_NAME)) {
            throw $this->createNotFoundException('Страница не найдена');
        }

        $pageName = $request->attributes->get(self::ALIAS_PARAM_NAME);
        $page = $pageRepository->findPageBySlug($pageName);

        if(null === $page) {
            throw $this->createNotFoundException('Страница не найдена');
        }

        return $this->render('page/index.html.twig', compact('page'));
    }
}