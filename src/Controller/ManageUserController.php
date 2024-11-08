<?php

namespace App\Controller;

use App\Enum\Status;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ManageUserController extends AbstractController
{

    #[Route('/manage/user/{status}', name: 'app_manage_user')]
    public function status(UserRepository $userRepository, string $status = null): Response
    {
        if (!$status) {
            $status = 'Pending';
        }

        $users = $userRepository->getStatusUser($status);
        return $this->render('manage_user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/manage/user/accepted/{uuid}', name: 'app_manage_user_accepted')]
    public function accepted(UserRepository $userRepository, string $uuid, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findOneBy(['uuid' => $uuid]);
        if (!$user) {
            throw $this->createNotFoundException('Gebruiker niet gevonden');
        }
        $user->setStatus(Status::ACCEPTED);
        $entityManager->flush();
        return $this->render('manage_user/index.html.twig');
    }

    #[Route('/manage/user/rejected/{uuid}', name: 'app_manage_user_rejected')]
    public function rejected(UserRepository $userRepository, string $uuid, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findOneBy(['uuid' => $uuid]);
        if (!$user) {
            throw $this->createNotFoundException('Gebruiker niet gevonden');
        }
        $user->setStatus(Status::REJECTED);
        $entityManager->flush();
        return $this->render('manage_user/index.html.twig');
    }

    #[Route('/manage/user/deleted/{uuid}', name: 'app_manage_user_deleted')]
    public function deleted(UserRepository $userRepository, string $uuid, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findOneBy(['uuid' => $uuid]);
        if (!$user) {
            throw $this->createNotFoundException('Gebruiker niet gevonden');
        }
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->render('manage_user/index.html.twig');
    }

}
