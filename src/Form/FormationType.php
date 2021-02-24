<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('begin_at',DateTimeType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'attr' => array('class' => 'form-control input-inline datetimepicker',
                                 'data-provide' => 'datetimepicker',
                                 'data-format' => 'dd-mm-yyyy HH:ii',  
                                    ),
            ])
            ->add('media',MediaType::class)
            ->add('poster',FileType::class)
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
