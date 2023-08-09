<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('nom' ,TextType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('prenom' ,TextType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('nom_ecole',TextType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('roles' ,ChoiceType::class, [
                'label'     => 'Role :',
                'attr' => ['class' => 'form-control abonnement'],
                'required' => true,
                'mapped'=>false,
                'choices'  => [
                    '' => null,
                    'admin' => 'admin',
                    'professeur' => 'prof',
                 
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'label'     => 'Niveau :',
                'attr' => ['class' => 'form-control abonnement'],
                'required' => true,
                'choices'  => [
                    '' => null,
                    'Primaie' => 'primaire',
                    'Collége' => 'college',
                    'Lycée' => 'lycee',
                 
                ],
            ])
            ->add('genre', ChoiceType::class, [
                'label'     => 'Niveau :',
                'attr' => ['class' => 'form-control abonnement'],
                'required' => true,
                'choices'  => [
                    '' => null,
                    'Femme' => 'femme',
                    'Homme' => 'homme',
                 
                ],
            ])
            ->add('image',  FileType::class, array('data_class' => null,'required' => false , 'attr' => ['class' => 'form-control abonnement']))
            ->add('password', PasswordType::class , array('attr' => ['class' => 'form-control abonnement' ]))
            ->add('save', SubmitType::class, ['label' => 'Enregistrer' ,'attr' => ['class' => 'form-control abonnement']])
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
