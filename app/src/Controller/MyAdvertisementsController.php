<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyAdvertisementsController extends BaseController
{
    #[Route('/my-advertisements', name: 'app_my_advertisements')]
    public function index(): Response
    {
        return $this->render('my_advertisements/index.html.twig', [
            'controller_name' => 'MyAdvertisementsController',
        ]);
    }
}
