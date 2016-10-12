<?php

namespace Unipik\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Unipik\MailBundle\Form\MailingType;
use Unipik\MailBundle\Service\SecondMail;

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
            ->setFrom('unipik.unicef@laposte.net')
            ->setTo('onch@yopmail.com')
            ->setBody(
                $this->renderView(
                    'MailBundle::emailToast.txt.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;

        $this->get('second_mailer')->send($message);

        return $this->redirectToRoute('architecture_homepage');
    }

    public function mailingEtablissementAction(Request $request) {
        $form = $this->get('form.factory')
            ->createBuilder(MailingType::class)
            ->getForm()
        ;

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Etablissement');


            $etablissements = $repository->getEnseignementsByType('');

            $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('unipik.unicef@laposte.net')
                ->setTo('onch@yopmail.com')
                ->setBody(
                    $this->renderView(
                        'MailBundle::emailToast.txt.twig',
                        array('name' => $name)
                    ),
                    'text/html'
                )
            ;

            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('MailBundle:mailing:mailingEtablissements.html.twig', array('form' => $form->createView()));
    }

}
