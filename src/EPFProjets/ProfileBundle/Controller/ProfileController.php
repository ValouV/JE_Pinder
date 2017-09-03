<?php

namespace EPFProjets\ProfileBundle\Controller;

use EPFProjets\ProfileBundle\Entity\Profile;
use EPFProjets\ProfileBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EPFProjets\ProfileBundle\Form\ProfileType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{

    public function indexAction(Request $request)
    {
    //tests identification
    $user = $this->getUser();
    if (null === $user) {
    $request->getSession()->getFlashBag()->add('error', 'Vous devez être identifiés pour voir cette page');
    return $this->redirectToRoute('fos_user_security_login');
    }


    return $this->render('EPFProjetsProfileBundle:Profile:index.html.twig');
    }

    public function viewAction($id, Request $request)
    {
      //tests identification
      $user = $this->getUser();
      if (null === $user) {
      $request->getSession()->getFlashBag()->add('notice', 'Vous devez être identifiés pour voir cette page');
      return $this->redirectToRoute('fos_user_security_login');
      }


          $profile = $this->getDoctrine()
            ->getManager()
            ->find('EPFProjetsProfileBundle:Profile' , $id)
          ;

          if (null === $profile) {
                throw new NotFoundHttpException("Le profil d'id ".$id." n'existe pas.");
          }
          $profile->setNbreVues($profile->getNbreVues()+1);
          $em = $this->getDoctrine()->getManager();
          $em->flush();
          return $this->render('EPFProjetsProfileBundle:Profile:view.html.twig' , array( 'profile' => $profile ));
    }

    public function addAction(Request $request)
      {

        //tests identification
        $user = $this->getUser();
        if (null === $user) {
        $request->getSession()->getFlashBag()->add('notice', 'Vous devez être identifiés pour voir cette page');
        return $this->redirectToRoute('fos_user_security_login');
        }


            // On crée un objet Advert
            $profile = new Profile();

            // On crée le FormBuilder grâce au service form factory
            $form = $this->get('form.factory')->create(ProfileType::class, $profile);


            // Si la requête est en POST
                if ($request->isMethod('POST')) {
                  // On fait le lien Requête <-> Formulaire
                  // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
                  $form->handleRequest($request);
                  $profile->setUser($this->getUser());

                  /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                  $file = $profile->getImage()->getImageFile();

                  // Generate a unique name for the file before saving it
                  $fileName = md5(uniqid()).'.'.$file->guessExtension();

                  $file->move(
                                  $this->getParameter('images_directory'),
                                  $fileName
                              );

                  // Update the 'brochure' property to store the PDF file name
                  // instead of its contents
                  $profile->getImage()->setImageFile($fileName);

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

    public function editAction(Request $request)
      {


        //tests identification
        $user = $this->getUser();
        if (null === $user) {
        $request->getSession()->getFlashBag()->add('notice', 'Vous devez être identifiés pour voir cette page');
        return $this->redirectToRoute('fos_user_security_login');
        }

        $profile = new Profile();

        $repository= $this->getDoctrine()->getRepository('EPFProjetsProfileBundle:Profile');
        $profile = $repository->findOneBy(array( 'user' => $user ));

        $form = $this->get('form.factory')->create(ProfileType::class, $profile);

          if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
          {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $profile->getImage()->getImageFile();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                            $this->getParameter('images_directory'),
                            $fileName
                        );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $profile->getImage()->setImageFile($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Profil bien modifié.');
            return $this->redirectToRoute('profile_view', array('id' => $profile->getId()));
          }

        return $this->render('EPFProjetsProfileBundle:Profile:edit.html.twig' , array('form' => $form->createView()) );
      }

    public function meAction(Request $request)
      {

        //tests identification
        $user = $this->getUser();
        if (null === $user) {
        $request->getSession()->getFlashBag()->add('notice', 'Vous devez être identifiés pour voir cette page');
        return $this->redirectToRoute('fos_user_security_login');
        }

        $profile = new Profile();

        $repository= $this->getDoctrine()->getRepository('EPFProjetsProfileBundle:Profile');
        $profile = $repository->findOneBy(array( 'user' => $user ));
        if ($profile!=null){
          return $this->redirectToRoute('profile_edit');
        } else {
          return $this->redirectToRoute('profile_add');
        }

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
