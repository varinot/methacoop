<?php

namespace App\Form;

use App\Entity\Docs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType; 

class DocuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('doctit')
            ->add('docref')
            ->add('imageFile', VichImageType::class, [
            'label'=> 'Image à ajouter',
            'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Suppression de cette image',
            'download_label' => 'Téléchargement',
            'download_uri' => true,
            'image_uri' => true,
            'asset_helper' => true,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Docs::class,
        ]);
    }
}
