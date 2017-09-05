<?php

namespace EPFProjets\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EPFProjets\ProfileBundle\Entity\Profile;

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

        return $this->render('EPFProjetsCoreBundle:Default:index.html.twig', array( 'profiles' => $profiles ));
    }
}
