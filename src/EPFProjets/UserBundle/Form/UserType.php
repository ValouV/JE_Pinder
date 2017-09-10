<?php
// src/AppBundle/Form/RegistrationType.php

namespace EPFProjets\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
        ->add('name', TextType::class, array('label' => 'Prénom'))
        ->add('surname', TextType::class, array('label' => 'Nom de famille'))
        ->add('sexe', ChoiceType::class,array(
    'choices'  => array(
        'Masculin' => 'M',
        'Feminin' => 'F',
        'Autre' => 'NA',
    )))
        ->add('birthdate', BirthdayType::class, array('label' => 'Date de naissance'))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
