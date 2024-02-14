<?php

namespace App\Controller;

use App\Form\AccountType;
use App\Service\UserAccountUpdateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends BaseController
{
    #[Route('/account', name: 'app_account')]
    public function index(Request $request, UserAccountUpdateService $service): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(AccountType::class, $this->getUser());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $service->update($form->getData());

            $this->addFlash('success', 'Данные успешно обновлены.');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
