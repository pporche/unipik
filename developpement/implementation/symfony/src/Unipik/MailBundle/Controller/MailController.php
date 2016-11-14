<?php

namespace Unipik\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Unipik\MailBundle\Entity\CronTask;
use Unipik\MailBundle\Entity\MailTask;
use Unipik\MailBundle\Form\MailingType;

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:52
 */
class MailController extends Controller {

    /**
     * Render the mailing view
     *
     * @param  $name
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
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
            );

        $this->get('mailer')->send($message);

        return $this->redirectToRoute('architecture_homepage');
    }

    /**
     * Render the view to send the email
     *
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function mailingEtablissementAction(Request $request) {
        $form = $this->get('form.factory')
            ->createBuilder(MailingType::class)
            ->getForm();

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Etablissement');

            $typeInstitute = $form->get("typeInstitute")->getData();
            $typeCenter = $form->get("typeCenter")->getData();

            $institutesArray = !empty($typeInstitute) ? $repository->getType("enseignement", $typeInstitute, null, null, null, null, null) : array();
            $centersArray = !empty($typeCenter) ? $repository->getType("centre", null, $typeCenter, null, null, null, null) : array();
            $mergedArray = array_merge($institutesArray, $centersArray);

            $ids = array();
            foreach ($mergedArray as $institute) {
                array_push($ids, $institute->getId());
            }

            $mailtask = new MailTask();
            $mailtask
                ->setName('Mail task')
                ->setInterval(300)
                ->setDateInsert(new \DateTime())
                ->setIdEtablissement($ids);

            $em = $this->getDoctrine()->getManager();
            $em->persist($mailtask);
            $em->flush();

            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('MailBundle:mailing:mailingEtablissements.html.twig', array('form' => $form->createView()));
    }

}
