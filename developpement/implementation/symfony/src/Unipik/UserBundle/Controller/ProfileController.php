<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 15/09/16
 * Time: 09:56
 */

namespace Unipik\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Unipik\UserBundle\Entity\Benevole;
use Symfony\Component\HttpFoundation\Request;

use FOS\UserBundle\Controller\ProfileController as BaseController;

class ProfileController extends BaseController
{
    public function modifyAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserBy(array('id' => 1));
        $form = $formFactory->createForm();
        $form = $form->setData($user);

        $form->handleRequest($request);

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
