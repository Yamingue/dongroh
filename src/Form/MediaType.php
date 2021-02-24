<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', FileType::class,[
                'attr'=>['class'=>'file-path'],
                'label'=>false,
                'constraints'=>[
                    new File([
                        'maxSize'=>'100000000',//definition a 100 MB
                        'mimeTypes'=>['image/jpeg','image/jpg','image/gif','video/mp4','image/png','video/mpg','video/3gp'],
                        'mimeTypesMessage'=>"le Fichier n'est pas un media Valide {{ type }}"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
