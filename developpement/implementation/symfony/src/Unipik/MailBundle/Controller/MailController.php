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
use Unipik\MailBundle\Entity\MailHistorique;
use Unipik\MailBundle\Entity\MailTask;
use Unipik\MailBundle\Form\MailingType;
use Unipik\MailBundle\Form\RechercheAvanceeType;

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
     * Renvoie le repository pour la mailtask
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Unipik\MailBundle\Entity\MailTaskRepository
     */
    public function getMailTaskRepository() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('MailBundle:MailTask');
    }

    /**
     * Renvoie le repository pour le mail historique
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Unipik\MailBundle\Entity\MailHistoriqueRepository
     */
    public function getMailHistoriqueRepository() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('MailBundle:MailHistorique');
    }


    /**
     * Render the view of the list of mails sent
     *
     * @param Request $request La requete
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function mailingHistoriqueAction(Request $request) {
        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $rowsPerPage = $request->get("rowsPerPage", 10);

        $repository = $this->getMailHistoriqueRepository();

        if ($request->isMethod('GET') && $form->isValid()) {
            $start = $form->get("start")->getData();
            $end = $form->get("end")->getData();

            $mails = $repository->getType($start, $end);
        } else {
            $start = "";
            $end = "";
            $mails = $repository->getType($start, $end);
        }

        return $this->render(
            'MailBundle::historiqueEmails.html.twig', array(
            'mails' => $mails,
            'rowsPerPage' => $rowsPerPage,
            'form' => $form->createView()
        ));
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

            // On récupère les données du formulaire
            $typeInstitute = $form->get("typeInstitute")->getData();
            $typeCenter = $form->get("typeCenter")->getData();
            $typeOther = $form->get("typeAutre")->getData();
            $relance = $form->get("typeRelance")->getData();
            $ville = $form->get("ville")->getData();
            $geolocalisation = $form->get("geolocalisation")->getData();
            $distance = $form->get("distance")->getData();
            if ($ville=='') {
                $ville = null;
            }
            if ($geolocalisation=='') {
                $geolocalisation = null;
            }
            if ($distance=='') {
                $distance = null;
            }

            $ids = array();
            $instituteExclude = $repository->getEtablissementDemandeNonSatisfaite(); // Les établissements qui ont fait une demande non satisfaite durant cette année scoalire

            if ($relance == 'relance') { // Les établissements qui ont pas fait de demande durant cette année scolaire
                $institutesArray = !empty($typeInstitute) ? $repository->getTypeAndNoInterventionThisYear('enseignement', $typeInstitute, null, $ville, $geolocalisation, $distance) : array();
                $centersArray = !empty($typeCenter) ? $repository->getTypeAndNoInterventionThisYear('centre', $typeCenter, null, $ville, $geolocalisation, $distance) : array();
                $othersArray = !empty($typeOther) ? $repository->getTypeAndNoInterventionThisYear('autreEtablissement', $typeOther, null, $ville, $geolocalisation, $distance) : array();
                $ids = array_merge($institutesArray, $centersArray, $othersArray);
            } else if ($relance == 'relancePlaidoyer') { // Les établissements qui ont pas fait de demande  de plaidoyers durant cette année scolaire
                $institutesArray = !empty($typeInstitute) ? $repository->getTypeAndNoInterventionThisYear('enseignement', $typeInstitute, 'plaidoyers', $ville, $geolocalisation, $distance) : array();
                $centersArray = !empty($typeCenter) ? $repository->getTypeAndNoInterventionThisYear('centre', $typeCenter, 'plaidoyers', $ville, $geolocalisation, $distance) : array();
                $othersArray = !empty($typeOther) ? $repository->getTypeAndNoInterventionThisYear('autreEtablissement', $typeOther, 'plaidoyers', $ville, $geolocalisation, $distance) : array();
                $ids = array_merge($institutesArray, $centersArray, $othersArray);
            } else { // Les établissements en général
                $institutesArray = !empty($typeInstitute) ? $repository->getType("enseignement", $typeInstitute, $ville, null, null, $geolocalisation, $distance) : array();
                $centersArray = !empty($typeCenter) ? $repository->getType("centre", $typeCenter, $ville, null, null, $geolocalisation, $distance) : array();
                $othersArray = !empty($typeOther) ? $repository->getType("autreEtablissement", $typeOther, $ville, null, null, $geolocalisation, $distance) : array();
                $mergedArray = array_merge($institutesArray, $centersArray, $othersArray);
                foreach ($mergedArray as $institute) {
                    array_push($ids, $institute->getId());
                }
            }
            $ids = array_diff($ids, $instituteExclude); // On dégage les établissements dont la demande a pas été satisfaite durant cette année scolaire

            if (!empty($ids)) { // Si la recherche donne pas d'établissement on créé pas d'entrée BD pour rien
                date_default_timezone_set("Europe/Paris");
                $mailtask = new MailTask();
                $mailtask
                    ->setName('Mail task')
                    ->setInterval(300) // Interval pour savoir quand on peut exécuter la tâche
                    ->setDateInsert(new \DateTime()) // Date d'insertion ie date à laquelle on effectue la demande d'envoi de mail
                    ->setIdEtablissement($ids); // id des établissements à qui on fait l'envoi

                $em = $this->getDoctrine()->getManager();
                $em->persist($mailtask);
                $em->flush();
            }
            return $this->redirectToRoute('architecture_homepage');
        }
        return $this->render('MailBundle:mailing:mailingEtablissements.html.twig', array('form' => $form->createView()));
    }

    /**
     * Une fonction de test
     *
     * @return void
     */
    public function kakiAction() {
        $em = $this->getDoctrine()->getManager();

        $mailHistorique = new MailHistorique();
        $mailHistorique
            ->setDateEnvoi(new \DateTime())
            ->setTypeEmail('relance')
            ->setIdEtablissement(12);

        $em->persist($mailHistorique);
        $em->flush();
    }
}
