<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ManageUserController extends AbstractController
{
    #[Route('/manage/user', name: 'app_manage_user')]
    public function index(): Response
    {
        return $this->render('manage_user/index.html.twig', [
            'controller_name' => 'ManageUserController',
        ]);
    }
}
