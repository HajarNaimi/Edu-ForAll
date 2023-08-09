<?php

namespace App\Form;

use App\Entity\Histoire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class HistoireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre' ,TextType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('histoire' ,TextareaType::class , array('attr' => ['class' => 'form-control abonnement']))
             ->add('save', SubmitType::class, ['label' => 'Enregistrer' ,'attr' => ['class' => 'form-control abonnement']])
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Histoire::class,
        ]);
    }
}
