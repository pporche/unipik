<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\MailBundle\Entity\MailTask;
use Unipik\MailBundle\Form\MailingType;

/**
 * Class MailBundle
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class MailController extends Controller {

    /**
     * Render the mailing view
     *
     * @param string $name Le nom
     *
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
     * @param Request $request La requete
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function mailingEtablissementAction(Request $request) {
        $form = $this->get('form.factory')
            ->createBuilder(MailingType::class)
            ->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Etablissement');

            $typeInstitute = $form->get("typeInstitute")->getData();
            $typeCenter = $form->get("typeCenter")->getData();
            $typeOther = $form->get("typeAutre")->getData();
            $relance = $form->get("typeRelance")->getData();
            $ville = $form->get("ville")->getData();
            if ($ville=='') {
                $ville = null;
            }

            $ids = array();
            if ($relance == 'relance') {
                $institutesArray = !empty($typeInstitute) ? $repository->getTypeAndNoInterventionThisYear('enseignement', $typeInstitute, $ville) : array();
                $centersArray = !empty($typeCenter) ? $repository->getTypeAndNoInterventionThisYear('centre', $typeCenter, $ville) : array();
                $othersArray = !empty($typeOther) ? $repository->getTypeAndNoInterventionThisYear('autreEtablissement', $typeOther, $ville) : array();
                $ids = array_merge($institutesArray, $centersArray, $othersArray);
            } else if ($relance == 'relancePlaidoyer') {
                $ids = array();
            } else {
                $institutesArray = !empty($typeInstitute) ? $repository->getType("enseignement", $typeInstitute, $ville, null, null) : array();
                $centersArray = !empty($typeCenter) ? $repository->getType("centre", $typeCenter, $ville, null, null) : array();
                $othersArray = !empty($typeOther) ? $repository->getType("autreEtablissement", $typeOther, $ville, null, null) : array();
                $mergedArray = array_merge($institutesArray, $centersArray, $othersArray);
                foreach ($mergedArray as $institute) {
                    array_push($ids, $institute->getId());
                }
            }

            if (!empty($ids)) {
                $mailtask = new MailTask();
                $mailtask
                    ->setName('Mail task')
                    ->setInterval(300)
                    ->setDateInsert(new \DateTime())
                    ->setIdEtablissement($ids);

                $em = $this->getDoctrine()->getManager();
                $em->persist($mailtask);
                $em->flush();
            }

            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('MailBundle:mailing:mailingEtablissements.html.twig', array('form' => $form->createView()));
    }
}
