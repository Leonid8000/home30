<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Survey;
use App\Entity\SurveyQuestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SurveyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question',TextType::class)
//            ->add('questions',EntityType::class,[
//                'class' => SurveyQuestion::class,
//                'choice_label' => 'question',
//                'multiple' => true,
//                'expanded' => true,
//            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => SurveyQuestion::class
        ]);
    }
}
