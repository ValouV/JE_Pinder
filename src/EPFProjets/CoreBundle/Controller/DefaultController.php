<?php

namespace EPFProjets\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EPFProjetsCoreBundle:Default:index.html.twig');
    }
}
