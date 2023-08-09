<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('description',TextType::class , array('attr' => ['class' => 'form-control abonnement']))
            ->add('matiere',ChoiceType::class, [
                'label'     => 'Matiere :',
                'attr' => ['class' => 'form-control abonnement'],
                'required' => true,
                'choices'  => [
                    '' => null,
                    'Math' => 'math',
                    'Physique' => 'physique',
                    'Arab' => 'Arab',
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'label'     => 'Niveau :',
                'attr' => ['class' => 'form-control abonnement'],
                'required' => true,
                'choices'  => [
                    '' => null,
                    'Scientifique' => 'scientifique',
                    'Literaire' => 'literaire',
                 
                ],
            ])
            ->add('categorie',ChoiceType::class, [
                'label'     => 'Categorie :',
                'attr' => ['class' => 'form-control abonnement'],
                'required' => true,
                'choices'  => [
                    '' => null,
                    'Primaire' => 'primaire',
                    'College' => 'college',
                    'Lycee' => 'lycce',
                ],
            ])
            ->add('lien',  FileType::class, array('data_class' => null,'required' => false , 'attr' => ['class' => 'form-control abonnement']))
            ->add('video',  FileType::class, array('data_class' => null,'required' => false, 'mapped'=> false ,'attr' => ['class' => 'form-control abonnement']))
            ->add('test',  FileType::class, array('data_class' => null,'required' => false , 'mapped'=> false , 'attr' => ['class' => 'form-control abonnement']))
            ->add('save', SubmitType::class, ['label' => 'Enregistrer' ,'attr' => ['class' => 'form-control abonnement']])
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
