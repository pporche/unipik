<?php

namespace Unipik\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\UserBundle\Entity\Benevole;
use Unipik\InterventionBundle\Entity\Intervention;
use Unipik\UserBundle\Form\RegistrationType;

class UserController extends Controller {

    public function listeAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $listBenevoles = $repository->findAll();
        return $this->render('UserBundle::liste.html.twig', array('listBenevoles' => $listBenevoles));
    }

    /**
     * @param $username array Nom d'utilisateur du bénévole à supprimer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteVolunteerAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteer = $em->getRepository('UserBundle:Benevole');
        $volunteer = $repositoryVolunteer->findBy(array('username' => $username))[0];

        $this->deleteVolunteers($volunteer);

        return $this->redirectToRoute('user_admin_list');
    }

    public function deleteVolunteersAction(Request $request) {
        if($request->isXmlHttpRequest()) {
            $usernames = json_decode( $request->request->get('usernames'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('UserBundle:Benevole');
            $volunteers = $repository->findBy(array('username' => $usernames));
            foreach ($volunteers as $volunteer) {
                $this->deleteVolunteers($volunteer);
            }
            return new Response();
        }
        return new Response();
    }

    public function deleteVolunteers($volunteer) {
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteer = $em->getRepository('UserBundle:Benevole');
        $repositoryIntervention = $em->getRepository('InterventionBundle:Intervention');
        $interventions = $repositoryIntervention->findBy(array('benevole' => $volunteer)); // On récupère toutes les interventions réalisées par le bénévole à supprimer.

        if(!empty($interventions)) {
            $fictiveVolunteer = $repositoryVolunteer->findBy(array('id' => '1'))[0]; // On récupère le bénévole fictif.

            foreach ($interventions as $intervention) {
                $intervention->setBenevole($fictiveVolunteer); // On remplace le bénévole à supprimer par le fictif dans les interventions.
                $em->persist($intervention);
            }
        }
        $em->remove($volunteer); // On supprime le bénévole car il n'est plus lié à aucune intervention.
        $em->flush();
    }

    public function modifyAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $this->getUser();
       // $user = $userManager->findUserBy(array('id' => 1));
        $form = $formFactory->createForm();
        $form = $form->setData($user);

        $form->handleRequest($request);

        if($form->isValid()){
            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            $responsibilitiesString = $this->arrayToString($responsibilitiesArray);
            $user->setResponsabiliteActivite($responsibilitiesString);
        }
        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function showProfileAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $benevole = $repository->findBy(array('username' => $username))[0];
        $repositoryIntervention = $em->getRepository('InterventionBundle:Intervention');
        $listeInterventions = $repositoryIntervention->getInterventionsBenevole($benevole);
        return $this->render('UserBundle:Profile:showBenevole.html.twig', array('benevole' => $benevole, 'listeInterventions' => $listeInterventions));
    }

    public function editAction(Request $request, $id) {
        $benevole = $this->getDoctrine()
            ->getManager()
            ->getRepository('UserBundle:Benevole')
            ->find($id);

        $form = $this->get('form.factory')
            ->createBuilder(RegistrationType::class, $benevole)
            ->remove('plainPassword')
            ->add('Valider', SubmitType::class)
            ->getForm();

        if ($form->handleRequest($request)->isValid() && $request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($benevole);
            $em->flush();

            return $this->redirectToRoute('user_admin_profil_benevole', array('username' => $benevole->getUsername()));
        }

        return $this->render('UserBundle:Profile:editBenevole.html.twig', array('form' => $form->createView()));
    }
}
