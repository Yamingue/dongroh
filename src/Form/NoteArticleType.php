<?php

namespace App\Form;

use App\Entity\NoteArticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note',RangeType::class,[
                'label'=> 'Noter sur 5 le produit',
                'attr'=>[
                    'min'=>0,
                    'max'=>5,
                    'value'=>2,
                ]
            ])
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NoteArticle::class,
        ]);
    }
}
