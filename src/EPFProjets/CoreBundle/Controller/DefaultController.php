<?php

namespace EPFProjets\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EPFProjets\ProfileBundle\Entity\Profile;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    public function indexAction()
    {

      $profiles = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('EPFProjetsProfileBundle:Profile')
      ->getPageAcc()
      ;

      $form = $this->createFormBuilder()
      ->add('sexe', ChoiceType::class,array(
      'choices'  => array(
      '' => '*',
      'Masculin' => 'M',
      'Feminin' => 'F',
      'Autre' => 'NA',
      )))
      ->add('region', ChoiceType::class,array(
      'choices'  => array(
      '' => '*',
      'IDF' => 'IDF',
      'Nord' => 'Nord',
      'Est' => 'EST',
      'Sud' => 'Sud',
      'Ouest' => 'Ouest',
      )))
      ->add('age', ChoiceType::class,array(
      'choices'  => array(
      '' => '*',
      '0-19' => 0,
      '20-39' => 20,
      '40-59' => 40,
      '60+' => 60,
      )))
      ->add('name',    TextType::class, array('label' => 'Prénom' , 'required' => false))
      ->add('surname', TextType::class, array('label' => 'Nom de famille', 'required' => false))
      ->add('save',      SubmitType::class, array('label' => 'Rechercher'))
      ->setAction($this->generateUrl('profile_recherche'))
      ->setMethod('POST')
      ->getForm();

        return $this->render('EPFProjetsCoreBundle:Default:index.html.twig', array( 'profiles' => $profiles , 'form' => $form->createView()));
    }
}
