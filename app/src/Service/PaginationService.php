<?php

namespace App\Service;

use Doctrine\ORM\Query;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class PaginationService
{
    public function __construct(
        private PaginatorInterface $paginator,
        private RequestStack $requestStack,
        private int $perPageCount
    ){}

    public function paginate(Query $query, ?int $perpage = null): PaginationInterface
    {
        $request = $this->requestStack->getCurrentRequest();

        return $this->paginator->paginate($query,
            $request->query->getInt('page', 1),
            $perpage ?? $this->perPageCount
        );
    }
}
