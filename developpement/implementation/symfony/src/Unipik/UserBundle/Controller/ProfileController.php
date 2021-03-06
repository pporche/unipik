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

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

use FOS\UserBundle\Controller\ProfileController as BaseController;

/**
 * Manage the user profile
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class ProfileController extends BaseController {

    /**
     * Edit the current user profile
     *
     * @param Request $request La requete
     *
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request) {

        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /**
         * Le dispatcher
         *
         * @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface
         */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /**
         * Le formfactory
         *
         * @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface
         */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /**
             * Le manager
             *
             * @var $userManager \FOS\UserBundle\Model\UserManagerInterface
             */
            $userManager = $this->get('fos_user.user_manager');

            $user->removeAllResponsabilitesActivites();
            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData(); //récup les responsabilités choisies sur le form + format pour persist
            foreach ($responsibilitiesArray as $responsabilite) {
                $user->addResponsabiliteActivite($responsabilite);
                if ($responsabilite != 'admin_region' && $responsabilite != 'admin_comite') {
                    $user->addActivitesPotentielles($responsabilite);
                }
            }

            $activitesPotentiellesArray = $form->get("activitesPotentielles")->getData();
            foreach ($activitesPotentiellesArray as $activite) {
                $user->addActivitesPotentielles($activite);
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        $activities = json_encode($user->getActivitesPotentielles()->toArray());
        $responsabilities = json_encode($user->getResponsabiliteActivite()->toArray());

        return $this->render(
            'UserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            'benevole' => $user,
            'activitesPotentielles' => $activities,
            'responsabiliteActivite' => $responsabilities,
            )
        );
    }

    /**
     * Show the user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction() {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $repositoryIntervention = $em->getRepository('InterventionBundle:Intervention');

        $listeInterventions = $repositoryIntervention->getNInterventionsRealiseesOuNonBenevole($user, false, 5);

        return $this->render(
            'FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'listeInterventions' => $listeInterventions
            )
        );
    }
}
