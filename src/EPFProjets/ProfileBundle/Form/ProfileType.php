<?php


namespace EPFProjets\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EPFProjets\ProfileBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ProfileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('description', TextareaType::class, array('label' => 'Décrivez vous en quelques mots'))
    ->add('image',     ImageType::class, array('label' => 'Photo de profil'))
    ->add('region', ChoiceType::class,array(
    'choices'  => array(
    '' => '*',
    'IDF' => 'IDF',
    'Nord' => 'Nord',
    'Est' => 'EST',
    'Sud' => 'Sud',
    'Ouest' => 'Ouest',
    )))
    ->add('save',      SubmitType::class, array('label' => 'Sauvegarde'))
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'EPFProjets\ProfileBundle\Entity\Profile'
    ));
  }
}
