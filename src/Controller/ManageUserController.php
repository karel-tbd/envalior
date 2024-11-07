<?php

namespace App\Controller;

use App\Repository\UserRepository;
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

    #[Route('/manage/user/{status}', name: 'app_status')]
    public function accepted(UserRepository $userRepository, string $status): Response
    {
        $users = $userRepository->getStatusUser($status);
        return $this->render('manage_user/index.html.twig', [
            'users' => $users,
        ]);
    }
}
