<?php

namespace Unipik\InterventionBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Entity\Intervention;
use Unipik\InterventionBundle\Form\DemandeType;
use Unipik\InterventionBundle\Form\Intervention\AttributionType;
use Unipik\InterventionBundle\Form\Intervention\InterventionType;
use Unipik\UserBundle\Entity\Contact;
use Unipik\InterventionBundle\Form\Intervention\RechercheAvanceeType;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\ArchitectureBundle\Entity\Adresse;
use Unipik\InterventionBundle\Entity\Demande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; //Utilisé
use Unipik\UserBundle\Entity\Comite;
use Unipik\ArchitectureBundle\Entity\MomentHebdomadaire;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Util\Debug;
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
        $repo = $this->getInterventionRepository();
        $intervention = $repo->findOneBy(array('id' => 15));
//        $intervention = new Intervention();

        $form = $this->createForm(InterventionType::class, $intervention);

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
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * edit intervention
     */
    public function editAction(Request $request, $id) {
        $repository = $this->getInterventionRepository();

        $intervention = $repository->find(array('id' => $id));

        $form = $this->createForm(InterventionType::class);

        if($form->handleRequest($request)->isValid() && $request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $intervention->setDateIntervention($form->get('dateIntervention')->getData());
            $intervention->setLieu($form->get('lieu')->getData());
            $intervention->setNbPersonne($form->get('nbPersonne')->getData());

            if($intervention->isFrimousse()) {
                $intervention->removeAllMateriauxFrimousse();
                $materiauxData = $form->get('materiauxFrimousse')->getData();
                foreach ($materiauxData as $mat) {
                    $intervention->addMateriauxFrimousse($mat);
                }
            } elseif ($intervention->isPlaidoyer()) {
                $intervention->removeAllMaterielDispoPlaidoyer();
                $materiauxData = $form->get('materielDispoPlaidoyer')->getData();
                foreach ($materiauxData as $mat) {
                    $intervention->addMaterielDispoPlaidoyer($mat);
                }
            } else {
                $materiauxData = array("kaki");
            }

            $em->persist($intervention);
            $em->flush();

            return $this->redirectToRoute('intervention_view', array('id' => $id));
        }

        if($intervention->isFrimousse()) {
            $materiaux = $intervention->getMateriauxFrimousse()->toArray();
        } elseif ($intervention->isPlaidoyer()) {
            $materiaux = $intervention->getMaterielDispoPlaidoyer()->toArray();
        } else {
            $materiaux = array("kaki");
        }

        $materiaux = json_encode($materiaux);

        return $this->render('InterventionBundle:Intervention:editIntervention.html.twig', array('form' => $form->createView(),
                                                                                 'intervention' => $intervention,
                                                                                 'materiaux' => $materiaux,
        ));
    }

    /**
     * @param $request Request
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention.
     * demande d'intervention
     */
    public function demandeAction(Request $request, $id) {

        $demande = new Demande();

        $form = $this->createForm(DemandeType::class, $demande);

        $repository = $this->getDoctrine()->getManager();
        $repository = $repository->getRepository('InterventionBundle:Etablissement');

       $instituteTest = $repository->find($id);
        $form->get('Etablissement')->setData($instituteTest);

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
            $contactPers->setTypeContact($test->getTypeContact());

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
                $listWeek[] = $week;
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

            $institute->removeAllEmails();

            $emails = $etablissement->get("emails")->getData();

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

            if(sizeof($emails) != 0)
                foreach ($emails as $email) {
                    if(!$institute->getEmails()->contains($email))
                        $institute->addEmail($email);
                }

            foreach($listWeek as $week)
                $demande->addSemaine($week);

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
                'message' => 'Votre demande d\'intervention a bien été enregistrée. Nous vous contacterons sous peu.',
                'alert' => 'success'
            ));

            $intervention = $form->getData();
            return $this->RedirectToRoute('architecture_homepage');
        }

//        $typeEtablissementEncoded = [];
//        if($instituteTest->getTypeEnseignement()){
//            $typeEtablissementEncoded = array(
//                'ens' => $instituteTest->getTypeEnseignement()
//            );
//        }
//        else if($instituteTest->getTypeCentre()){
//            $typeEtablissementEncoded = array(
//                'centre' => $instituteTest->getTypeCentre()
//            );
//        }else{
//            $typeEtablissementEncoded = array(
//                'autre' => $instituteTest->getTypeAutreEtablissement()
//            );
//        }


        return $this->render('InterventionBundle:Intervention:demande.html.twig', array(
            'form' => $form->createView(),
            //'typEnseignement' => json_encode($typeEtablissementEncoded)
        ));
    }

    /**
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     * get consultation
     */
    public function getConsultationVue() {
        return $this->render('InterventionBundle:Intervention:consultation.html.twig');
    }

    /**
     * @param $id integer Id de l'intervention.
     * @return Response Permet de récupérer la vue consultation pour l'héritage.
     * @Route("/intervention/{id}", name="intervention_view")
     * consulter une action
     */
    public function consultationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');
        $intervention = $repository->find($id);
        $user = $this->getUser();

        $formAttr = $this->get('form.factory')->createBuilder(AttributionType::class)->getForm()->createView();

        if($intervention->isFrimousse()) {
            return $this->render('InterventionBundle:Intervention/Frimousse:consultation.html.twig',array('intervention' => $intervention, 'user' => $user, 'formAttr' => $formAttr));
        } elseif ($intervention->isPlaidoyer()) {
           return $this->render('InterventionBundle:Intervention/Plaidoyer:consultation.html.twig',array('intervention' => $intervention, 'user' => $user, 'formAttr' => $formAttr));
        }
        else {
            return $this->render('InterventionBundle:Intervention:consultation.html.twig',array('intervention' => $intervention, 'user' => $user, 'formAttr' => $formAttr));
        }
    }

    /**
     * @return RepositoryFactory
     * Renvoie le repository Intervention.
     */
    public function getInterventionRepository() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Intervention');
    }

    /**
     * @param une requête $request
     * @return Response
     * Renvoie vers la page affichant les établissements en passant en paramètre la liste des interventions.
     */
    public function listeAction(Request $request) {
        $user = $this->getUser();

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;
        $typeIntervention = $form->get("typeIntervention")->getData(); //Récupération des infos de filtre
        $statutIntervention = $form->get("statutIntervention")->getData(); //Récupération du statut de l'intervention
        $niveauFrimousse = $form->get("niveauFrimousse")->getData();
        $niveauPlaidoyer = $form->get("niveauPlaidoyer")->getData();
        $ville = $form->get("ville")->getData();
        $theme = $form->get("theme")->getData();
        $start = $form->get("start")->getData();
        $end = $form->get("end")->getData();


        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateIntervention");
        $desc = $request->get("desc", false);

        $repository = $this->getInterventionRepository();

        $listIntervention = $repository->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statutIntervention, null, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville);

//        Création du formulaire pour la popup
        $fB = $this->get('form.factory')->createBuilder(AttributionType::class);
        $f = $fB->getForm();
        $f->handleRequest($request);

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
            'form' => $form->createView(),
            'formAttr' => $f->createView(),
            'onlyMyIntervention' => false,
        ));

    }

    /**
     * @param une requête $request
     * @return Response
     * Renvoie vers la page d'attribution d'intervention.
     */
    public function maListeAction(Request $request) {
        $user = $this->getUser();

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;
        $typeIntervention = $form->get("typeIntervention")->getData(); //Récupération des infos de filtre
        $statutIntervention =$form->get("statutMesInterventions")->getData(); //Récupération du statut de l'intervention
        $niveauFrimousse = $form->get("niveauFrimousse")->getData();
        $niveauPlaidoyer = $form->get("niveauPlaidoyer")->getData();
        $ville = $form->get("ville")->getData();
        $theme = $form->get("theme")->getData();
        $start = $form->get("start")->getData();
        $end = $form->get("end")->getData();

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateIntervention");
        $desc = $request->get("desc", false);

        $repository = $this->getInterventionRepository();

        $listIntervention = $repository->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statutIntervention, $user, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville);

        //        Création du formulaire pour la popup
        $fB = $this->get('form.factory')->createBuilder(AttributionType::class);
        $f = $fB->getForm();
        $f->handleRequest($request);

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
            'form' => $form->createView(),
            'formAttr' => $f->createView(),
            'onlyMyIntervention' => true,
        ));
    }

    /**
     * @param id $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * supprimer intervention
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
     * supprimer intervention
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
     * Attribuer une intervention a un benevole
     */
    public function attributionABenevoleAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $username = $request->request->get('username');
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $repositoryVolunteer = $em->getRepository('UserBundle:Benevole');
            $volunteer = $repositoryVolunteer->findOneBy(array('username' => $username));
            $repositoryIntervention = $em->getRepository('InterventionBundle:Intervention');
            $intervention = $repositoryIntervention->find($id);

            $intervention->setBenevole($volunteer);

            $em->persist($intervention);
            $em->flush();

            $infos = array('nom' => $volunteer->getNom(), 'prenom' => $volunteer->getPrenom());

            return new JsonResponse($infos);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     * désattribuer l'intervention a un bénévole
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
     * @param Request $request
     * @return Response
     * attribuer a un bénévole
     */
    public function attributionAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $user = $this->getUser();
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $intervention = $repository->find($id);

            if($intervention->getBenevole() != null) {
                throw new Exception("Exception");
            }

            $intervention->setBenevole($user);

            $em->persist($intervention);
            $em->flush();
            return new Response();
        }
        return new Response();
    }

    public function realisationAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $intervention = $repository->find($id);

            $intervention->setRealisee(true);

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
        $lvlThemeRepository = $this->getDoctrine()->getManager()->getRepository('ArchitectureBundle:NiveauTheme');
        if($interventionsRawList !== null) {
            $interventionsRawList = array_filter($interventionsRawList);

            foreach($interventionsRawList as $interventionRaw) {
                $interventionTemp = new Intervention();
                $interventionTemp->setRealisee(false);
                $interventionTemp->setDateIntervention(null);
                $interventionTemp->setNbPersonne($interventionRaw["nbPersonne"]);
                $interventionTemp->setComite($comiteTest);
                if(isset($interventionRaw["materiel"]) && !empty($interventionRaw["materiel"]["materiel"])){
                    $interventionTemp->addMaterielDispoPlaidoyer($interventionRaw["materiel"]["materiel"]);
                }
                else if(isset($interventionRaw['materielFrimousse']) && !empty($interventionRaw['materielFrimousse']['materiel'])){
                    $interventionTemp->addMateriauxFrimousse($interventionRaw['materielFrimousse']['materiel']);
                }
                if(isset($interventionRaw["niveauTheme"])){
                    $lvlTheme = $lvlThemeRepository->findOneBy(
                        array('niveau' => $interventionRaw["niveauTheme"]->getNiveau(),
                            'theme' => $interventionRaw["niveauTheme"]->getTheme()
                        )
                    );
                    $interventionTemp->setNiveauTheme($lvlTheme);
                }

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
        $this->treatmentMorning(array_keys($moments,'matin'),$demande);
        $this->treatmentAftNoon(array_keys($moments,'apres-midi'),$demande);
    }

    /**
     * @param array $days
     * @param Demande $demande
     * traite les matins
     */
    function treatmentMorning(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande){
        foreach($days as $day) {
            $moment = new MomentHebdomadaire();
            $moment->setJour($day);
            $moment->setMoment('matin');

            $this->getDoctrine()->getManager()->persist($moment);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsVoulus()->add($moment);
        }
    }

    /**
     * @param array $days
     * @param Demande $demande
     * traite les apres midi
     */
    function treatmentAftNoon(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande){
        foreach($days as $day) {
            $moment = new MomentHebdomadaire();
            $moment->setJour($day);
            $moment->setMoment('apres-midi');

            $this->getDoctrine()->getManager()->persist($moment);
            $this->getDoctrine()->getManager()->flush();
            $demande->getMomentsVoulus()->add($moment);
        }
    }

    /**
     * @param array $days
     * @param Demande $demande
     * liste les jours a eviter
     */
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

    /**
     * @param array $days
     * @param Demande $demande
     * liste les jours complets
     */
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

    /**
     * @param $moments
     * @param Demande $demande
     * liste les moments voulus
     */
    function linkAllMoments($moments, \Unipik\InterventionBundle\Entity\Demande &$demande ) {
        foreach($moments as $moment) {
            $demande->addMomentsVoulus($moment);
        }
    }

    /**
     * @param $moments
     * @param Demande $demande
     * liste les moments a éviter
     */
    function linkAllBMoments($moments, \Unipik\InterventionBundle\Entity\Demande &$demande ) {
        foreach($moments as $moment) {
            $demande->addMomentsAEviter($moment);
        }
    }
}
