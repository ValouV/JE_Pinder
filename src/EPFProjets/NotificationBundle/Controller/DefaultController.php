<?php

namespace EPFProjets\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use EPFProjets\NotificationBundle\Entity\Notification;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
      $user = $this->getUser();
      if ($user == null){return $this->json(null);}
      $notifications = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('EPFProjetsNotificationBundle:Notification')
        ->findByIdUser($user->getId())
      ;

      $unseen_notifications = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('EPFProjetsNotificationBundle:Notification')
        ->getNbrOfUnread($user->getId())
      ;

      $output = $this->renderView('EPFProjetsNotificationBundle::index.html.twig', array('notifications' => $notifications));

      $data = array(
        'notification'   => $output,
        'unseen_notification' => $unseen_notifications
       );
       return $this->json($data);
    }

    public function vuAction(Request $request){
      $user = $this->getUser();
      if ($user == null){return $this->json(null);}
      $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('EPFProjetsNotificationBundle:Notification')
          ->seenNotif($user->getId())
      ;

      return $this->redirectToRoute('notif');
    }
}
