<?php

namespace Unipik\InterventionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:55
 */
class InterventionController extends Controller {

    public function consultationAction($id) {

        return $this->render('InterventionBundle::consultation.html.twig');
    }

    public function addAction() {

    }

    public function editAction() {

    }

    public function deleteAction() {

    }

    public function listViewAction() {

    }

    public function locationAction() {

    }
}
