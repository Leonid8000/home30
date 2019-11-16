<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Answer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('answers',EntityType::class,[
                'class' => Answer::class,
                'choice_label' => 'answer',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Question::class
        ]);
    }
}

//            ->add('title2',TextType::class)
//            ->add('answers2',EntityType::class,[
//            'class' => Answer::class,
//            'choice_label' => 'answer',
//            'multiple' => true,
//            'expanded' => true,
//            ])
//            ->add('title3',TextType::class)
//            ->add('answers3',EntityType::class,[
//                'class' => Answer::class,
//                'choice_label' => 'answer',
//                'multiple' => true,
//                'expanded' => true,
//            ])
//            ->add('title4',TextType::class)
//            ->add('answers4',EntityType::class,[
//                'class' => Answer::class,
//                'choice_label' => 'answer',
//                'multiple' => true,
//                'expanded' => true,
//            ])
//            ->add('title5',TextType::class)
//            ->add('answers5',EntityType::class,[
//                'class' => Answer::class,
//                'choice_label' => 'answer',
//                'multiple' => true,
//                'expanded' => true,
//            ]);
