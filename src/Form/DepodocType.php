<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Depots;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class DepodocType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('depotit')
            ->add('depoavis')
            ->add('deporef')
            ->add('depocorres')
               
            ->add('depoFilename', FileType::class, [
               'label' => 'Document (Fichier PDF) à déposer',
               'mapped' => false, 
               'required' => false,
               
               'constraints' => [
                new File([
                    'maxSize' => '8M',
                    'mimeTypes' => [
                        'application/pdf',
                        'application/x-pdf',
                    ],
                    'mimeTypesMessage' => 'Veuillez charger un fichier PDF ',
                ])
            ],

          ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Depots::class,
        ]);
    }
}