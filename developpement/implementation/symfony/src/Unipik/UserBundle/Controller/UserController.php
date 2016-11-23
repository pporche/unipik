<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

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
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class UserController extends Controller {

    /**
     * Create the Benevole Repository
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository|BenevoleRepository
     */
    public function getBenevoleRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('UserBundle:Benevole');
    }

    /**
     * Render list of volunteers
     *
     * @param Request $request La requete
     *
     * @return Response
     */
    public function listeAction(Request $request) {


        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        $ville = $form->get("ville")->getData();

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "nom");
        $desc = $request->get("desc", false);

        $repository = $this->getBenevoleRepository();

        $listBenevoles = $repository->getType($field, $desc, $ville);


        return $this->render(
            'UserBundle::liste.html.twig', array(
            'field' => $field,
            'desc' => $desc,
            'rowsPerPage' => $rowsPerPage,
            'listBenevoles' => $listBenevoles,
            'form' => $form->createView())
        );
    }

    /**
     * Delete a volunteer from the database
     *
     * @param string $username Le nom d'utilisateur
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteVolunteerAction($username) {
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteer = $em->getRepository('UserBundle:Benevole');
        $volunteer = $repositoryVolunteer->findOneBy(array('username' => $username));

        $this->_deleteVolunteers($volunteer);

        return $this->redirectToRoute('user_admin_list');
    }

    /**
     * Delete many volunteers from the database
     *
     * @param Request $request La requete
     *
     * @return Response
     */
    public function deleteVolunteersAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $usernames = json_decode($request->request->get('usernames'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('UserBundle:Benevole');
            $volunteers = $repository->findBy(array('username' => $usernames));
            foreach ($volunteers as $volunteer) {
                $this->_deleteVolunteers($volunteer);
            }
            return new Response();
        }
        return new Response();
    }

    /**
     * Delete a volunteer from the database
     *
     * @param string $volunteer Le benevole
     *
     * @return object
     */
    private function _deleteVolunteers($volunteer) {
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteer = $em->getRepository('UserBundle:Benevole');
        $repositoryIntervention = $em->getRepository('InterventionBundle:Intervention');
        $interventions = $repositoryIntervention->findBy(array('benevole' => $volunteer)); // On récupère toutes les interventions réalisées par le bénévole à supprimer.

        if (!empty($interventions)) {
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
     * Modify volunteer from the database
     *
     * @param Request $request La requete
     *
     * @return Response
     */
    public function modifyAction(Request $request) {
        /**
         * Le formfactory
         *
         * @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface
         */
        $formFactory = $this->get('fos_user.profile.form.factory');
         /**
         * Le manager
         *
         * @var $userManager \FOS\UserBundle\Model\UserManagerInterface
         */
        $user = $this->getUser();
        $form = $formFactory->createForm();
        $form = $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            $responsibilitiesString = $this->arrayToString($responsibilitiesArray);
            $user->setResponsabiliteActivite($responsibilitiesString);
        }
        return $this->render(
            'FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            )
        );
    }

    /**
     * Render a volunteer's profile page
     *
     * @param string $username Le nom d'utilisateur
     *
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
     * @param Request $request  La requete
     * @param string  $username Le nom d'utilisateur
     *
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

            $benevole->removeAllResponsabilitesActivites();
            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            foreach ($responsibilitiesArray as $responsabilite) {
                $benevole->addResponsabiliteActivite($responsabilite);
                if ($responsabilite != 'admin_region' && $responsabilite != 'admin_comite') {
                    $benevole->addActivitesPotentielles($responsabilite);
                }
            }

            $activitesPotentiellesArray = $form->get("activitesPotentielles")->getData();
            foreach ($activitesPotentiellesArray as $activite) {
                $benevole->addActivitesPotentielles($activite);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($benevole);
            $em->flush();

            return $this->redirectToRoute('user_admin_profil_benevole', array('username' => $benevole->getUsername()));
        }

        $activities = json_encode($benevole->getActivitesPotentielles()->toArray());
        $responsabilities = json_encode($benevole->getResponsabiliteActivite()->toArray());

        return $this->render(
            'UserBundle:Profile:editBenevole.html.twig', array(
            'form' => $form->createView(),
            'benevole' => $benevole,
            'activitesPotentielles' => $activities,
            'responsabiliteActivite' => $responsabilities
            )
        );
    }

    /**
     * Autocomplete user inputs
     *
     * @param Request $request La requete
     *
     * @return JsonResponse
     */
    public function autocompleteAction(Request $request){
        $users = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('UserBundle:Benevole')->createQueryBuilder('b')
            ->where('LOWER(b.nom) LIKE LOWER(:nom)')
            ->setParameter('nom', '%'.$term.'%')
            ->orWhere('LOWER(b.prenom) LIKE LOWER(:prenom)')
            ->setParameter('prenom', '%'.$term.'%')
            ->orWhere('LOWER(b.username) LIKE LOWER(:username)')
            ->setParameter('username', '%'.$term.'%')
            ->orderBy('b.username', 'ASC')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $users[] = ucfirst($entity->getPrenom())." ".ucfirst($entity->getNom())." (".$entity->getUsername().")";
        }

        $response = new JsonResponse();
        $response->setData($users);

        return $response;
    }

    /**
     * Render a volunteer's planning page
     *
     * @param Request $request La requete
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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
