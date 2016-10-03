<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 15/09/16
 * Time: 09:56
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
 * Class ProfileController
 * @package Unipik\UserBundle\Controller
 */
class ProfileController extends BaseController {

    /**
     * Edit the current user profile
     *
     * @param Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request) {

        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $activitiesArray = $form->get("activitesPotentielles")->getData();
            $activitiesString = ArrayConverter::phpArrayToPgArray($activitiesArray);
            $user->setResponsabiliteActivite($activitiesString);

            $responsibilitiesArray = $form->get("responsabiliteActivite")->getData();
            $responsibilitiesString = ArrayConverter::phpArrayToPgArray($responsibilitiesArray);
            $user->setResponsabiliteActivite($responsibilitiesString);

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

        return $this->render('UserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
