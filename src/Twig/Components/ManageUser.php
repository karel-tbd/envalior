<?php

namespace App\Twig\Components;

use App\Repository\UserRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ManageUser
{
    public function __construct(private readonly UserRepository $userRepository)
    {

    }

    public function getUsers(): array
    {
        $users = $this->userRepository->findAll();
        return $users;
    }
}
