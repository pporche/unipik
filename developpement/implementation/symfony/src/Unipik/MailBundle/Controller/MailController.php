<?php

namespace Unipik\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:52
 */
class MailController extends Controller {

    public function sendFormAction($name) {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('')
            ->setTo('onch@yopmail.com')
            ->setBody(
                $this->renderView(
                    'MailBundle::email.txt.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;
        $this->get('mailer')->send($message);

        return $this->render('ArchitectureBundle::connexion.html.twig');
    }

    public function sendNewInterventionAction() {

    }

    public function sendInterventionCareAction() {

    }

    public function sendFinalAction() {

    }
}
