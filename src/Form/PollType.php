<?php

namespace App\Form;

use App\Entity\Poll;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PollType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_question')
            ->add('user_answer')
            ->add('user_id');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
//            'data_class' => Poll::class
        ]);
    }
}

//$builder
//    ->add('sur_recommend', ChoiceType::class, array(
//        'mapped' => false,
//        'label' => 'I would recommend this program to my friends and '.
//            'family as a great opportunity',
//        'choice_label' => false,
//        'choices' => array(
//            'strong_A' => 'strong_A',
//            'some_A' => 'some_A',
//            'some_D' => 'some_D',
//            'strong_D' => 'strong_D',
//        ),
//        'expanded' => true,
//        'multiple' => false,
//    ))
//;