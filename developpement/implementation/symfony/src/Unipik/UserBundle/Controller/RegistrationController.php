<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 26/04/16
 * Time: 13:10
 */

namespace Unipik\UserBundle\Controller;


use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Unipik\UserBundle\Form\RegistrationType;

class RegistrationController extends BaseController {

    public function registerController(Request $request) {
        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);
        $form->createView();
        return parent::registerAction($request);
    }
}
