<?php

namespace App\Form;

use App\Entity\SearchQuery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('word', TextType::class, [
                'attr' => [
                    'placeholder' => 'for example, "run"',
                    'maxlength' => 30,
                    'pattern' => "^[A-Za-z]+$"
                ],
            ])
            ->add('language', ChoiceType::class, [
                'choices' => [
                    'British English' => 'en-gb',
                    'American English' => 'en-us'
                ]
            ]);
    }
}
