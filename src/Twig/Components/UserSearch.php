<?php

namespace App\Twig\Components;

use App\Form\UserSearchType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class UserSearch extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function getUsers(): array
    {
        $search = $this->getForm()->getData() ?? [];
        $users = $this->userRepository->search($search);
        return $users;
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(UserSearchType::class);
    }

    private function getDataModelValue(): ?string
    {
        return 'on(input)|*';
    }

}
