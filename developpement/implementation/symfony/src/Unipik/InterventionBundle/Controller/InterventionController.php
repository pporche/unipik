<?php

namespace Unipik\InterventionBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Entity\Intervention;
use Unipik\InterventionBundle\Form\DemandeType;
use Unipik\UserBundle\Entity\Contact;
use Unipik\InterventionBundle\Form\Intervention\RechercheAvanceeType;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\ArchitectureBundle\Entity\Adresse;
use Unipik\InterventionBundle\Entity\Demande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; //Utilisé
use Unipik\UserBundle\Entity\Comite;
use Unipik\ArchitectureBundle\Entity\MomentHebdomadaire;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:55
 */
class InterventionController extends Controller {

    /**
     * Add intervention.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAction(Request $request) {
        $intervention = new Intervention();
        $form = $this->createForm(DemandeType::class, $intervention);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            /*$educationTypeArray = $form->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray);

            $otherTypeArray = $form->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray);

            $centreTypeArray = $form->get("typeCentre")->getData();
            $institute->setTypeCentre($centreTypeArray);

            $emailsString = '{('.$form->get("emails")->getData().')}';
            $institute->setEmails($emailsString);

            $em = $this->getDoctrine()->getManager();
            $em->persist($institute);
            $em->flush();

            return $this->redirectToRoute('architecture_homepage');*/
        }

        return $this->render('InterventionBundle:Intervention:ajouterIntervention.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param $request Request
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention.
     */
    public function demandeAction(Request $request) {

        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);


        if($form->isValid()) {
            $dt =new \DateTime();
            $demande->setDateDemande($dt);

            // handle the contact

            $test = (object) $form->get('Contact')->getData();

            // Extraire le contact
            $em = $this->getDoctrine()->getManager();
            $contactPers = new Contact();
            $this->cast($contactPers, $test);
            $contactPers->setRespoEtablissement($test->isRespoEtablissement());
            $contactPers->setTypeActivite('{}');

            // handle the interventions
            $interventionsRawList = $form->get('Intervention')->getData();

            $interventionList = [];
            $listWeek = [];

            $startWeek = $form->get('plageDate')->get('debut')->getData()->format("W");
            $endWeek = $form->get('plageDate')->get('fin')->getData()->format("W");
            if($startWeek > $endWeek) {
                $endWeek = 1;
            }

            for($week = $startWeek; $week <= $endWeek; $week++) {
                $listWeek[] = '('.$week.')';
            }

            $this->treatmentInterventions($interventionsRawList,$interventionList);
            $this->treatmentContact($contactPers);
            $demande->setContact($contactPers);


            $this->treatmentMoment($form->get('jour')->getData(),$demande);

            $etablissement = $form->get('Etablissement');

            $institute = $etablissement->getData();

            $educationTypeArray = $etablissement->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray);

            $otherTypeArray = $etablissement->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray);

            $centreTypeArray = $etablissement->get("typeCentre")->getData();
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

            $list=[];
            if(($instituteResearched) !== null)
            {
                $instituteResearched = array_filter($instituteResearched);
                foreach($instituteResearched as $institute){
                    $list[] = $institute;
                }
            }
            if(sizeof($instituteResearched) == 0){
                $em = $this->getDoctrine()->getManager();
                $em->persist($institute);
            } else {
                $institute = array_pop($instituteResearched);
            }

            $demande->setListeSemaine(ArrayConverter::phpArrayToPgArray($listWeek));

            $this->getDoctrine()->getManager()->persist($demande);
            $em = $this->getDoctrine()->getManager();

            $em->flush();


            foreach($interventionList as $intervention){
                $intervention->setEtablissement($institute);
                $intervention->setDemande($demande);

                $this->getDoctrine()->getManager()->persist($intervention);
            }

            $em->flush();

            $this->linkAllMoments($demande->getMomentsVoulus(),$demande);

            $this->linkAllBMoments($demande->getMomentsAEviter(),$demande);
            $session =$request->getSession();
            $em->flush();


            $session->getFlashBag()->add('notice', array(
                'title' => 'Félicitation',
                'message' => 'Votre demande d\'intervention a bien été enregistrée. Nous vous contacterons sous peu',
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
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');
        $intervention = $repository->find($id);
        $user = $this->getUser();

        if($intervention->isFrimousse()) {
            return $this->render('InterventionBundle:Intervention/Frimousse:consultation.html.twig',array('intervention' => $intervention, 'user' => $user));
        } elseif ($intervention->isPlaidoyer()) {
           return $this->render('InterventionBundle:Intervention/Plaidoyer:consultation.html.twig',array('intervention' => $intervention, 'user' => $user));
        }
        else {
            return $this->render('InterventionBundle:Intervention:consultation.html.twig',array('intervention' => $intervention, 'user' => $user));
        }
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
        $user = $this->getUser();

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;
        $typeIntervention = $form->get("typeIntervention")->getData(); //Récupération des infos de filtre
        $start = $form->get("start")->getData();
        $end = $form->get("end")->getData();

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateIntervention");
        $desc = $request->get("desc", true);

        $repository = $this->getInterventionRepository();

        $listIntervention = $repository->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc);

        return $this->render('InterventionBundle:Intervention:liste.html.twig', array(
            'field' => $field,
            'desc' => $desc,
            'rowsPerPage' => $rowsPerPage,
            'liste' => $listIntervention,
            'typeIntervention' => $typeIntervention,
            'isCheck' => $dateChecked,
            'dateStart' => $start,
            'dateEnd' => $end,
            'user' => $user,
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

    /**
     * @param Request $request
     * @return Response
     */
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
     * @param Request $request
     * @return Response
     */
    public function attributionAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $user = $this->getUser();
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $intervention = $repository->find($id);

            $intervention->setBenevole($user);

            $em->persist($intervention);
            $em->flush();
            return new Response();
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function desattributionAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $intervention = $repository->find($id);

            $intervention->setBenevole(null);

            $em->persist($intervention);
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

    /**
     * @param $interventionsRawList
     * @param $interventionList
     * Iterates over the interventions requested to get the parameters
     */
    function treatmentInterventions($interventionsRawList, &$interventionList) {
        $comiteTest = $this->getDoctrine()->getManager()->getRepository('UserBundle:Comite')->find(1);

        if($interventionsRawList !== null) {
            $interventionsRawList = array_filter($interventionsRawList);

            foreach($interventionsRawList as $interventionRaw) {
                $interventionTemp = new Intervention();
                $interventionTemp->setRealisee(false);
                $interventionTemp->setDateIntervention(null);
                $interventionTemp->setMateriauxFrimousse(null);
                $interventionTemp->setNbPersonne($interventionRaw["participants"]["nbEleves"]);
                $interventionTemp->setComite($comiteTest);
                if(isset($interventionRaw["materiel"])){
                    $interventionTemp->setMaterielDispoPlaidoyer(ArrayConverter::phpArrayToPgArray($interventionRaw["materiel"]["materiel"]));
                }
                else if(isset($interventionRaw['materielFrimousse'])){
                    $interventionTemp->setMateriauxFrimousse(ArrayConverter::phpArrayToPgArray($interventionRaw['materielFrimousse']['materiel']));
                }
                return new Response(print_r((isset($interventionRaw['materielFrimousses']))));




                $interventionList[] = $interventionTemp;
            }
        }
    }

    /**
     * @param $contactPers
     * Iterates over a contact to check if she/he is already in the db, take the one from the db in the last case
     */
    function treatmentContact(&$contactPers) {
        $em = $this->getDoctrine()->getManager();
        $em = $em->getRepository('UserBundle:Contact');

        $contactBase = $em->findOneBy(
            array(
                'nom' => $contactPers->getNom(),
                'prenom' => $contactPers->getPrenom(),
                'email' => $contactPers->getEmail()
            )
        );

        if(!is_null($contactBase)) {
            $contactPers = $contactBase;
        } else {
            $this->getDoctrine()->getManager()->persist($contactPers);
            $this->getDoctrine()->getManager()->flush();
        }
    }

    /**
     * @param $moments
     * @param Demande $demande
     *  Iterates over the moments to fill the one from the demand
     */
    function treatmentMoment($moments,\Unipik\InterventionBundle\Entity\Demande &$demande) {
        $this->treatmentAvoidDay(array_keys($moments,'a-eviter'),$demande);
        $this->treatmentAllDay(array_keys($moments,'indifferent'),$demande);
    }

    function treatmentAvoidDay(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande) {
        foreach($days as $day) {
            $moment = new MomentHebdomadaire();
            $moment->setJour($day);
            $moment->setMoment('matin');

            $this->getDoctrine()->getManager()->persist($moment);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsAEviter()->add($moment);

            $momentP = new MomentHebdomadaire();
            $momentP->setJour($day);
            $momentP->setMoment('apres-midi');
            $this->getDoctrine()->getManager()->persist($momentP);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsAEviter()->add($momentP);

            $momentL = new MomentHebdomadaire();
            $momentL->setJour($day);
            $momentL->setMoment('soir');
            $this->getDoctrine()->getManager()->persist($momentL);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsAEviter()->add($momentL);
        }
    }

    function treatmentAllDay(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande) {
        foreach($days as $day) {
            $moment = new MomentHebdomadaire();
            $moment->setJour($day);
            $moment->setMoment('matin');

            $this->getDoctrine()->getManager()->persist($moment);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsVoulus()->add($moment);

            $momentP = new MomentHebdomadaire();
            $momentP->setJour($day);
            $momentP->setMoment('apres-midi');
            $this->getDoctrine()->getManager()->persist($momentP);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsVoulus()->add($momentP);

            $momentL = new MomentHebdomadaire();
            $momentL->setJour($day);
            $momentL->setMoment('soir');
            $this->getDoctrine()->getManager()->persist($momentL);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsVoulus()->add($momentL);
        }
    }

    function linkAllMoments($moments,\Unipik\InterventionBundle\Entity\Demande &$demande ) {
        foreach($moments as $moment) {
            $moment->addDemandeMomentsVoulus($demande);
        }
    }

    function linkAllBMoments($moments,\Unipik\InterventionBundle\Entity\Demande &$demande ) {
        foreach($moments as $moment) {
            $moment->addDemandeMomentsAEviter($demande);
        }
    }
}
