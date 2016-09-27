<?php

namespace Unipik\InterventionBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Form\DemandeType;
use Unipik\UserBundle\Entity\Contact;
use Unipik\InterventionBundle\Form\Intervention\RechercheAvanceeType;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\ArchitectureBundle\Entity\Adresse;
use Unipik\InterventionBundle\Entity\Demande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:55
 */
class InterventionController extends Controller {

    /**
     * @param $request Request
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention.
     */
    public function demandeAction(Request $request) {

        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $dt = new \DateTime();
            $demande->setDate($dt);
            /*Sauvegarde du contact */
            // Extraire les données
            $test = (object)$form->get('Contact')->getData();
            // Extraire le contact
            $em = $this->getDoctrine()->getManager();
            $contactPers = new Contact();
            $this->cast($contactPers, $test);
            $contactPers->setRespoEtablissement(false);
            $contactPers->setTypeActivite('{}');
            $demande->setContact($contactPers);
            return new Response(\Doctrine\Common\Util\Debug::dump(($test)));
            $em = $em->getRepository('UserBundle:Contact');
            $contactBase = $em->findOneBy(
                array(
                    'nom' => $contactPers->getNom(),
                    'prenom' => $contactPers->getPrenom(),
                    'email' => $contactPers->getEmail()
                )
            );

            if ($contactBase != null) {
                $contactPers = $contactBase;
                $this->getDoctrine()->getManager()->persist($contactPers);
            }

            $demande->setContact($contactPers);
            /* Chopper l'établissement */

            $fullForm = (object)$form->getData();

            $institute = $form->get('Etablissement')->getData();

            $educationTypeArray = $form->get("Etablissement")->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray);

            $otherTypeArray = $form->get("Etablissement")->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray);

            $centreTypeArray = $form->get("Etablissement")->get("typeCentre")->getData();
            $institute->setTypeCentre($centreTypeArray);

            $institute->setEmails('{}');

            /* if the adress is already in the db it means the institute might be in there too */
            $repository = $this->getDoctrine()->getRepository('ArchitectureBundle:Adresse');
            $adresses = $repository->findBy(
                array('ville' => $institute->getAdresse()->getVille(),
                    'adresse' => $institute->getAdresse()->getAdresse(),
                    'codePostal' => $institute->getAdresse()->getCodePostal()
                )
            );

            $instituteResearched = null;
            $repository = $this->getDoctrine()->getManager();
            $repository = $repository->getRepository('InterventionBundle:Etablissement');
            foreach ($adresses as $adresse) {
                $adresseTemp = new Adresse();
                $this->cast($adresseTemp, (object)$adresse);
                $instituteResearched[] = $repository->findOneBy(
                    array('nom' => $institute->getNom(),
                        'typeEnseignement' => $institute->getTypeEnseignement(),
                        'typeAutreEtablissement' => $institute->getTypeAutreEtablissement(),
                        'typeCentre' => $institute->getTypeCentre(),
                        'adresse' => $adresseTemp->getId()
                    )
                );
            }

            $list = [];
            $instituteResearched = array_filter($instituteResearched);
            if (($instituteResearched) !== null)
                foreach ($instituteResearched as $institute) {
                    $list[] = $institute;
                }

            if (sizeof($instituteResearched) == 0) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($institute);
            } else
                $institute = $instituteResearched[0];

            $demande->getContact()->addEtablissement($institute);
            // Etablissement non présent est sauvegardé
            $demande->setListeSemaine('{}');

            $this->getDoctrine()->getManager()->persist($demande);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new Response(\Doctrine\Common\Util\Debug::dump(($demande)));
            $session = $request->getSession();

            $session->getFlashBag()->add('notice', array(
                'title' => 'Félicitation',
                'message' => 'Votre demande d/\'intervention a bien été enregistrée. Nous vous contacterons sous peu',
                'alert' => 'success'
            ));

            $intervention = $form->getData();
            return $this->RedirectToRoute('architecture_homepage');
        }
        return $this->render('InterventionBundle:Intervention:demande.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     */
    public function getConsultationVue() {
        return $this->render('InterventionBundle:Intervention:consultation.html.twig');
    }

    /**
     * @param $id integer Id de l'intervention.
     * @return Response Permet de récupérer la vue consultation pour l'héritage.
     * @Route("/intervention/{id}", name="intervention_view")
     */
    public function consultationAction($id) {
        // Faire la vérication si l'intervention est un plaidoyer, frimousse ou autre
        // Et appeler la vue correspondante
        return $this->getConsultationVue();
    }

    /**
     * @return RepositoryFactory Renvoie le repository Intervention.
     */
    public function getInterventionRepository() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Intervention');
    }

    /**
     * @return Response Renvoie vers la page affichant les établissements en passant en paramètre la liste des interventions.
     */
    public function listeAction(Request $request) {

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;
        $typeIntervention = $form->get("typeIntervention")->getData(); //Récupération des infos de filtre
        $start = $form->get("start")->getData();
        $end = $form->get("end")->getData();

        $repository = $this->getInterventionRepository();
        switch ($typeIntervention) {
            case "plaidoyer":
                $listIntervention = $repository->getPlaidoyers($start, $end, $dateChecked);
                break;
            case "frimousse":
                $listIntervention = $repository->getFrimousses($start, $end, $dateChecked);
                break;
            case "autreIntervention":
                $listIntervention = $repository->getAutresInterventions($start, $end, $dateChecked);
                break;
            default:
                $listIntervention = $repository->getToutesInterventions($start, $end, $dateChecked);
                break;
        }

        return $this->render('InterventionBundle:Intervention:liste.html.twig', array(
            'liste' => $listIntervention,
            'typeIntervention' => $typeIntervention,
            'isCheck' => $dateChecked,
            'dateStart' => $start,
            'dateEnd' => $end,
            'form' => $form->createView()
        ));

    }

    /**
     * @return Response Renvoie vers la page d'attribution d'intervention.
     */
    public function attribueesAction() {

        return $this->render('InterventionBundle:Intervention/Attribuees:liste.html.twig', array(
            'liste' => null
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getInterventionRepository();
        $intervention = $repository->find($id);
        // Attention : faire le test si elle est réalisée ou non (envoie de mail à l'établissement)
        $em->remove($intervention);
        $em->flush();
        return $this->redirectToRoute('intervention_list');
    }

    public function deleteInterventionsAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $ids = json_decode($request->request->get('ids'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $interventions = $repository->findBy(array('id' => $ids));
            foreach ($interventions as $intervention) {
                $em->remove($intervention);
            }
            $em->flush();
            return new Response();
        }
        return new Response();
    }

    /**
     * Class casting
     *
     * @param string|object $destination
     * @param object $sourceObject
     * @return object
     */
    function cast($destination, $sourceObject) {
        if (is_string($destination)) {
            $destination = new $destination();
        }
        $sourceReflection = new \ReflectionObject($sourceObject);
        $destinationReflection = new \ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination, $value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }

}
