<?php

namespace EPFProjets\ProfileBundle\Controller;

use EPFProjets\ProfileBundle\Entity\Profile;
use EPFProjets\ProfileBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfileController extends Controller
{

    public function indexAction()
    {
        return $this->render('EPFProjetsProfileBundle:Profile:index.html.twig');
    }

    public function viewAction($id, Request $request)
    {
          $profile = $this->getDoctrine()
            ->getManager()
            ->find('EPFProjetsProfileBundle:Profile' , $id)
          ;

          if (null === $profile) {
                throw new NotFoundHttpException("Le profil d'id ".$id." n'existe pas.");
              }

          return $this->render('EPFProjetsProfileBundle:Profile:view.html.twig' , array( 'profile' => $profile ));
    }

    public function addAction(Request $request)
      {

            // On crée un objet Advert
            $profile = new Profile();

            // On crée le FormBuilder grâce au service form factory
            $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $profile);

            // On ajoute les champs de l'entité que l'on veut à notre formulaire
            $formBuilder
              ->add('description', TextareaType::class)
              ->add('save',      SubmitType::class)
            ;

            // À partir du formBuilder, on génère le formulaire
            $form = $formBuilder->getForm();

            // Si la requête est en POST
                if ($request->isMethod('POST')) {
                  // On fait le lien Requête <-> Formulaire
                  // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
                  $form->handleRequest($request);

                  // On vérifie que les valeurs entrées sont correctes
                  // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                  if ($form->isValid()) {
                    // On enregistre notre objet $advert dans la base de données, par exemple
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($profile);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

                    // On redirige vers la page de visualisation de l'annonce nouvellement créée
                    return $this->redirectToRoute('profile_view', array('id' => $profile->getId()));
                  }
                }

        return $this->render('EPFProjetsProfileBundle:Profile:add.html.twig' , array('form' => $form->createView()) );
      }

    public function editAction($id, Request $request)
      {

          if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('profile_view', array('id' => 5));
          }

          return $this->render('EPFProjetsProfileBundle:Profile:edit.html.twig' , array('id' => $id));
      }

}

//redirection
//return $this->redirectToRoute('oc_platform_home');

//json
//Créons nous-mêmes la réponse en JSON, grâce à la fonction json_encode()
//$response = new Response(json_encode(array('id' => $id)));
//$response->headers->set('Content-Type', 'application/json');


//session
// Récupération de la session
//$session = $request->getSession();
// On récupère le contenu de la variable user_id
//$userId = $session->get('user_id');
// On définit une nouvelle valeur pour cette variable user_id
//$session->set('user_id', 91);


// flash message
//$session->getFlashBag()->add('info', 'Annonce bien enregistrée');
// Puis on redirige vers la page de visualisation de cette annonce
//return $this->redirectToRoute('oc_platform_view', array('id' => 5));


//<div>
//{# On affiche tous les messages flash dont le nom est « info » #}
//{% for message in app.session.flashbag.get('info') %}
//<p>Message flash : {{ message }}</p>
//{% endfor %}
//</div>
