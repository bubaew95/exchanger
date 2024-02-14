<?php

namespace App\Service;

use App\Repository\NewsRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;

readonly class NewsService
{
    public function __construct(
        private NewsRepository    $newsRepository,
        private PaginationService $paginationService
    ){}

    public function newsWithPaginator(): PaginationInterface
    {
        $newsQuery = $this->newsRepository->getNewsQuery();

        return $this->paginationService->paginate($newsQuery);
    }
}