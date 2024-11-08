<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\User;
use App\Enum\Status;
use App\Service\FormService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSearchType extends AbstractType
{

    public function __construct(private readonly FormService $formService)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'data' => $options['search']['name'] ?? null,
                'required' => false,
                'attr' => ['placeholder' => 'Search on email'],
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'Name',
                'autocomplete' => true,
                'placeholder' => 'Search on company',
                'data' => !empty($options['search']['users']) ? $this->formService->getEntityReferences(User::class, $options['search']['users']) : null,
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    Status::ACCEPTED->value => Status::ACCEPTED,
                    Status::PENDING->value => Status::PENDING,
                    Status::REJECTED->value => Status::REJECTED,
                ],
                'required' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
