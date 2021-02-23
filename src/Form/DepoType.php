<?php

namespace App\Form;

use App\Entity\Depots;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType; 

class DepoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('depotit')
            ->add('depoavis')
            ->add('deporef')
            ->add('depocorres')
            ->add('imageFile', VichImageType::class, [
            'label'=> 'Image à ajouter',
            'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Suppression',
            'download_label' => 'Téléchargement',
            'download_uri' => true,
            'image_uri' => true,
            'asset_helper' => true,
            ])
           // ->add('genericFile', VichFileType::class, [
           //     'required' => false,
           //     'allow_delete' => true,
           //     'delete_label' => '...',
           //     'download_uri' => '...',
           //     'download_label' => '...',
           //     'asset_helper' => true,
            //])
               
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Docs::class,
        ]);
    }
}