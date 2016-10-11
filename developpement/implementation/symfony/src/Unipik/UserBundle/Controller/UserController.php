<?php

namespace Unipik\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\UserBundle\Entity\BenevoleRepository;
use Unipik\InterventionBundle\Entity\Intervention;
use Unipik\UserBundle\Form\RechercheAvanceeType;
use Unipik\UserBundle\Form\RegistrationType;

/**
 * Manage volunteer actions
 *
 * Class UserController
 * @package Unipik\UserBundle\Controller
 */
class UserController extends Controller {

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|BenevoleRepository
     */
    public function getBenevoleRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('UserBundle:Benevole');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function listeAction(Request $request) {


        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $activites = $form->get("activites")->getData();
        $responsabilites = $form->get("responsabilitesActivites")->getData();
        $ville = $form->get("ville")->getData();

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "nom");
        $desc = $request->get("desc", false);

        $repository = $this->getBenevoleRepository();

        $listBenevoles = $repository->getType($field, $desc);


        return $this->render('UserBundle::liste.html.twig', array(
            'field' => $field,
            'desc' => $desc,
            'rowsPerPage' => $rowsPerPage,
            'listBenevoles' => $listBenevoles,
            'form' => $form->createView()));
    }

    /**
     * Delete a volunteer from the database
     *
     * @param $username
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteVolunteerAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteer = $em->getRepository('UserBundle:Benevole');
        $volunteer = $repositoryVolunteer->findOneBy(array('username' => $username));

        $this->deleteVolunteers($volunteer);

        return $this->redirectToRoute('user_admin_list');
    }

    /**
     * Delete many volunteers from the database
     *
     * @param Request $request
     * @return Response
     */
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

    /**
     * @param $volunteer
     */
    private function deleteVolunteers($volunteer) {
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

    /**
     * @param Request $request
     * @return Response
     */
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

    /**
     * Render a volunteer's profile page
     *
     * @param $username
     * @return Response
     */
    public function showProfileAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UserBundle:Benevole');
        $benevole = $repository->findOneBy(array('username' => $username));
        $repositoryIntervention = $em->getRepository('InterventionBundle:Intervention');
        $listeInterventions = $repositoryIntervention->getInterventionsBenevole($benevole);
        return $this->render('UserBundle:Profile:showBenevole.html.twig', array('benevole' => $benevole, 'listeInterventions' => $listeInterventions));
    }

    /**
     * Edit a volunteer's profile
     *
     * @param Request $request
     * @param $username
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editAction(Request $request, $username) {
        $benevole = $this->getDoctrine()
            ->getManager()
            ->getRepository('UserBundle:Benevole')
            ->findOneBy(array('username' => $username));

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


    public function autocompleteAction(Request $request){
        $username = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('UserBundle:Benevole')->createQueryBuilder('b')
            ->where('LOWER(b.username) LIKE LOWER(:username)')
            ->setParameter('username', '%'.$term.'%')
            ->orderBy('b.username','ASC')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $username[] = $entity->getUsername();
        }

        $response = new JsonResponse();
        $response->setData($username);

        return $response;
    }

    /**
     * Render a volunteer's planning page
     *
     * @param Request $request
     * @param $username
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     */
    public function showPlanningAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');
        $interventionsNonRealiseesBenevole = $repository->getInterventionsRealiseesOuNon(false);
        $interventionsRealiseesBenevole = $repository->getInterventionsRealiseesOuNon(true);
        return $this->render('UserBundle::myPlanning.html.twig', array('user' => $user, 'interventionsNonRealisees' => $interventionsNonRealiseesBenevole, 'interventionsRealisees' => $interventionsRealiseesBenevole));

    }

}
