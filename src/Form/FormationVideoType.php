<?php

namespace App\Form;

use App\Entity\FormationVideo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FormationVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('prix')
            ->add('poster',FileType::class,[
                'constraints'=>[
                    new File([
                        'mimeTypes'=>['image/jpeg','image/gif','image/jpg','image/png','video/mp4'],
                        'maxSize'=> 50*1024*1024,
                        'maxSizeMessage'=> "Le fichier depasse les 10MB"
                    ])
                ]
            ])
            ->add('description')
            ->add('fichier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormationVideo::class,
        ]);
    }
}
