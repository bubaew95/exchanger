<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use App\Service\NewsService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends BaseController
{
    #[Route('/news', name: 'app_news')]
    public function index(NewsService $service): Response
    {
        return $this->render('news/index.html.twig', [
            'pagination' => $service->newsWithPaginator(),
        ]);
    }

    #[Route('/news/{alias}', name: 'app_news_details')]
    public function details(News $news): Response
    {
        return $this->render('news/details.html.twig', [
            'news' => $news,
        ]);
    }

    public function lastNewsFromIndexPage(NewsRepository $newsRepository, int $limit = 8): Response
    {
        return $this->render('news/last-news.html.twig', [
            'lastNews' => $newsRepository->getLastNews($limit)
        ]);
    }
}
