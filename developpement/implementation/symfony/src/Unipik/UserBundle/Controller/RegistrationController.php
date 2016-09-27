<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 12/09/16
 * Time: 11:12
 */

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;


class RegistrationController extends BaseController {

    public function registerAction(Request $request) {

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');  // Récupération du service form factory de fos user
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher'); // Récupération du gestionnaire d'évènements

        $user = $userManager->createUser(); // Récupération de l'utilisateur -> bénévole
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm(); // Création du formulaire
        $form->setData($user);

        $form->handleRequest($request);

        // Après le submit du formulaire
        if ($form->isValid()) {

            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            $responsibilitiesString = $this->arrayToString($responsibilitiesArray);
            $user->setResponsabiliteActivite($responsibilitiesString);

            $activitiesArray = $form->get("activitesPotentielles")->getData(); //récup les activités choisies sur le form + format pour persist
            $activitiesString = $this->arrayToString($activitiesArray);
            $activitiesString = $this->setActivitesPotentiellesValues($responsibilitiesArray, $activitiesString);
            $user->setActivitesPotentielles($activitiesString);

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

        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function checkEmailAction() {
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');
        $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('L\'utilisateur avec l\'adresse mail "%s" n\'existe pas !', $email));
        }

        return $this->redirectToRoute("user_admin_profil_benevole", array('username' => $user->getUsername()));
    }

    public function arrayToString($array) {
        $string = '{';
        foreach ($array as $value) {
            $string = $string.$value;
            if($value !== end($array)) {
                $string = $string.',';
            }
        }
        return $string.'}';
    }

    public function setActivitesPotentiellesValues($responsibilitiesArray, $activitiesString) {
        $activitiesString = trim($activitiesString, '}');
        if ($activitiesString != '{')
            $activitiesString = $activitiesString.',';
        if(($key = array_search('(admin_region)', $responsibilitiesArray)) !== false) {
            unset($responsibilitiesArray[$key]);
        }
        if(($key = array_search('(admin_comite)', $responsibilitiesArray)) !== false) {
            unset($responsibilitiesArray[$key]);
        }
        if (empty($responsibilitiesArray))
            $activitiesString = trim($activitiesString, ',');
        foreach ($responsibilitiesArray as $value) {
            $activitiesString = $activitiesString.$value;
            if($value !== end($responsibilitiesArray)) {
                $activitiesString = $activitiesString.',';
            }
        }
        return $activitiesString.'}';
    }

    public function confirmedAction() {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('UserBundle:Registration:confirmed.html.twig', array(
            'user' => $user,
            'targetUrl' => $this->getTargetUrlFromSession(),
        ));
    }

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

}