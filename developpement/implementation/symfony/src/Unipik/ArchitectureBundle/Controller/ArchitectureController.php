<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 */

namespace Unipik\ArchitectureBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Unipik\ArchitectureBundle\Form\DemandeInterventionType;

class ArchitectureController extends Controller {

    public function indexAction() {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            return $this->render('ArchitectureBundle::accueilAnonyme.html.twig');
        }

        return $this->render('ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));
    }

    public function plaidoyerAction() {

    }

    public function frimousseAction() {

    }

    public function mailAction() {

    }

}
