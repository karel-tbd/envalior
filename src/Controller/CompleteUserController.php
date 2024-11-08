<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompleteUserController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        dd('test');

        return $this->render('home/index.html.twig', []);
    }
}
