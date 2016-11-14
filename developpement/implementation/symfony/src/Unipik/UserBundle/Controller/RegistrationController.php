<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 12/09/16
 * Time: 11:12
 */

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Unipik\ArchitectureBundle\Entity\Adresse;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;
use Ivory\HttpAdapter\CurlHttpAdapter;
use Geocoder\Provider\GoogleMaps;


/**
 * Manage the registration actions
 *
 * Class RegistrationController
 *
 * @package Unipik\UserBundle\Controller
 */
class RegistrationController extends BaseController {

    /**
     * Action for registration
     *
     * @param  Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request) {

        /**
 * @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface 
*/
        $formFactory = $this->get('fos_user.registration.form.factory');  // Récupération du service form factory de fos user
        /**
 * @var $userManager \FOS\UserBundle\Model\UserManagerInterface 
*/
        $userManager = $this->get('fos_user.user_manager');
        /**
 * @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface 
*/
        $dispatcher = $this->get('event_dispatcher'); // Récupération du gestionnaire d'évènements

        $user = $userManager->createUser(); // Récupération de l'utilisateur -> bénévole
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        $this->get('session')->getFlashBag()->clear();

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm(); // Création du formulaire
        $form->setData($user);

        $form->handleRequest($request);

        // Après le submit du formulaire
        if ($form->isValid()) {
            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            foreach ($responsibilitiesArray as $responsabilite) {
                $user->addResponsabiliteActivite($responsabilite);
                if($responsabilite != 'admin_region' && $responsabilite != 'admin_comite') {
                    $user->addActivitesPotentielles($responsabilite);
                }
            }

            $activitesPotentiellesArray = $form->get("activitesPotentielles")->getData();
            foreach ($activitesPotentiellesArray as $activite) {
                $user->addActivitesPotentielles($activite);
            }

            $nom = $form->get('nom')->getData();
            $prenom = $form->get('prenom')->getData();
            $user->setNom(ucfirst(strtolower($nom)));
            $user->setPrenom(ucfirst(strtolower($prenom)));

            $adresse = $form->get('adresse')->getData();
            $adresse->setAdresse(strtoupper($adresse->getAdresse()));
            $adresse->setComplement(strtoupper($adresse->getComplement()));

            //            $geolocalisation = $this->findGeolocalisation($adresse);
            //            var_dump($geolocalisation);

            //            $adresse->setGeolocalisation($geolocalisation);

            $user->setAdresse($adresse);

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render(
            'FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
            )
        );
    }

    /**
     * Check email
     *
     * @return RedirectResponse
     */
    public function checkEmailAction() {
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');
        $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('L\'utilisateur avec l\'adresse mail "%s" n\'existe pas !', $email));
        }

        return $this->redirectToRoute("user_admin_profil_benevole", array('username' => $user->getUsername()));
    }

    /**
     * Add values of responsibilities to the set of potential activities.
     *
     * @param  $responsibilitiesArray
     * @param  $activitiesString
     * @return string
     */
    public function setActivitesPotentiellesValues($responsibilitiesArray, $activitiesString) {
        $activitiesString = trim($activitiesString, '}');
        if ($activitiesString != '{') {
            $activitiesString = $activitiesString . ',';
        }
        if(($key = array_search('(admin_region)', $responsibilitiesArray)) !== false) {
            unset($responsibilitiesArray[$key]);
        }
        if(($key = array_search('(admin_comite)', $responsibilitiesArray)) !== false) {
            unset($responsibilitiesArray[$key]);
        }
        if (empty($responsibilitiesArray)) {
            $activitiesString = trim($activitiesString, ',');
        }
        foreach ($responsibilitiesArray as $value) {
            $activitiesString = $activitiesString.$value;
            if($value !== end($responsibilitiesArray)) {
                $activitiesString = $activitiesString.',';
            }
        }
        return $activitiesString.'}';
    }

    /**
     * Confirmation after registration
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmedAction() {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('L\'utilisateur n\'a pas accès à cette section.');
        }
        $this->get('session')->getFlashBag()->clear();

        return $this->render(
            'UserBundle:Registration:confirmed.html.twig', array(
            'user' => $user,
            'targetUrl' => $this->getTargetUrlFromSession(),
            )
        );
    }

    /**
     * Get the original requested url before registration.
     *
     * @return mixed
     */
    private function getTargetUrlFromSession() {
        if (interface_exists('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface')) {
            $tokenStorage = $this->get('security.token_storage');
        } else {
            $tokenStorage = $this->get('security.context');
        }

        $key = sprintf('_security.%s.target_path', $tokenStorage->getToken()->getProviderKey());

        if ($this->get('session')->has($key)) {
            return $this->get('session')->get($key);
        }
    }

    //    /**
    //     * Find the geolocalisation from an address.
    //     *
    //     * @param $adresse
    //     * @return \Geocoder\Model\AddressCollection
    //     */
    //    private function findGeolocalisation($adresse) {
    //        $adapter  = new Guzzle6HttpAdapter();
    //        $geocoder = new GoogleMaps($adapter);
    //
    //        return $geocoder->geocode($adresse->getAdresse());
    //    }
}
