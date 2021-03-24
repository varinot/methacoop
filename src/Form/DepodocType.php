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
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder->add('depoFilename', VichFileType::class, [
            'label' => 'Document (Fichier PDF) à déposer',
            'mapped' => false, 
            'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Suppression du document déposé',
            'download_label' => 'Téléchargement',
            'download_uri' => true,
            'asset_helper' => true,
        
               'constraints' => [
                new File([
                    'maxSize' => '18M',
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