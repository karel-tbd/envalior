<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class MainPrevAdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prevAdv', LiveCollectionType::class, [
                'entry_type' => UserFormType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
                'constraints' => [
                    new Count(['min' => 1]),
                ],
                'error_bubbling' => false,
            ]);
        /*  ->add('informationICE', LiveCollectionType::class, [
              'entry_type' => InformationFormType::class,
              'entry_options' => ['label' => false],
              'label' => false,
              'required' => false,
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false,
              'constraints' => [
                  new Count(['min' => 1]),
              ],
          ])
          ->add('informationUrgentSupport', LiveCollectionType::class, [
              'entry_type' => InformationFormType::class,
              'entry_options' => ['label' => false],
              'label' => false,
              'allow_add' => true,
              'required' => false,
              'allow_delete' => true,
              'by_reference' => false,
              'constraints' => [
                  new Count(['min' => 1]),
              ],
          ]);*/
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
