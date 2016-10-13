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
            ->setFrom('unipik.dev@gmail.com')
            ->setTo('onch1@yopmail.com')
            ->setBody(
                $this->renderView(
                    'MailBundle::emailMaternelle.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;

        $this->get('mailer')->send($message);

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

            $type = $form->get("type")->getData();

//            $etablissements = $repository->getEnseignementsByType(array($type));

            $emails = array("dev1@yopmail.com", "dev2@yopmail.com");

            $i = 0;
            foreach ($emails as $email) {
                $i++;
                $message = \Swift_Message::newInstance()
                    ->setSubject('Intervention de l\'unicef')
                    ->setFrom('unipik.dev@gmail.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'MailBundle::emailMaternelle.html.twig',
                            array('id' => $i)
                        ),
                        'text/html'
                    )
                ;

                $this->get('mailer')->send($message);
            }

            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('MailBundle:mailing:mailingEtablissements.html.twig', array('form' => $form->createView()));
    }

}
