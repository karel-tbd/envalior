<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, CompanyRepository $companyRepository): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyName = $form->get('company')->getData();
            $vatNumber = $form->get('contractNumber')->getData();

            if ($companyName) {
                if (empty($company = $companyRepository->findOneBy(['name' => $companyName]))) {
                    $company = new Company();
                    $company->setName($companyName);
                    $company->setVatNumber($vatNumber);
                    $entityManager->persist($company);
                }

                $user->setCompany($company);
            }

            /* if ($contractNumber) {
                 $contract = (new Contract());
                 $contract->setCompany($company);
                 $contract->setNumber($contractNumber);
                 $contract->setCompany($user->getCompany());
                 $contract->setCreatedAt(new \DateTimeImmutable());
                 $contract->setUpdatedAt(new \DateTimeImmutable());
                 $contract->setUuidAtValue();

                 $entityManager->persist($contract);
             }*/

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
