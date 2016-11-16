<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
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
use Unipik\InterventionBundle\Form\MomentType;
use Unipik\InterventionBundle\InterventionBundle;
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
 * Le controller qui gère les interventions
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class InterventionController extends Controller {

    /**
     * Action édition
     *
     * @param Request $request La requete
     * @param Int     $id      L'identifiant d'intervention
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * edit intervention
     */
    public function editAction(Request $request, $id) {
        $repository = $this->getInterventionRepository();

        $intervention = $repository->find(array('id' => $id));

        $form = $this->createForm(InterventionType::class);

        if ($form->handleRequest($request)->isValid()
            && $request->isMethod('POST')
        ) {
            $em = $this->getDoctrine()->getManager();

            $intervention->setDateIntervention(
                $form->get('dateIntervention')
                    ->getData()
            );
            $intervention->setLieu($form->get('lieu')->getData());
            $intervention->setNbPersonne($form->get('nbPersonne')->getData());

            if ($intervention->isFrimousse()) {
                $intervention->removeAllMateriauxFrimousse();
                $materiauxData = $form->get('materiauxFrimousse')->getData();
                foreach (reset($materiauxData) as $mat) {
                    $intervention->addMateriauxFrimousse($mat);
                }
                $niveauFrimousse = $form->get('niveau')->getData();
                $intervention->setNiveauFrimousse($niveauFrimousse);
            } elseif ($intervention->isPlaidoyer()) {
                $intervention->removeAllMaterielDispoPlaidoyer();
                $materiauxData = $form->get('materielDispoPlaidoyer')->getData();
                foreach (reset($materiauxData) as $mat) {
                    $intervention->addMaterielDispoPlaidoyer($mat);
                }

                $repositoryTheme = $em->getRepository("ArchitectureBundle:NiveauTheme");
                $themeArray = $form->get('niveauTheme')->get('theme')->getData();
                $theme = reset($themeArray);
                $niveauTheme = $repositoryTheme->findOneBy(
                    array("theme" => $theme,
                    "niveau" => $form->get('niveauTheme')->get('niveau')->getData()
                    )
                );
                $intervention->setNiveauTheme($niveauTheme);
            } else {
                $materiauxData = array();
            }

            $heure = $form->get('heure')->get('hour')->getData();
            $heure = sprintf("%02d", $heure);
            $minute = $form->get('heure')->get('minute')->getData();
            $minute = sprintf("%02d", $minute);
            $heure .= ":".$minute;
            $intervention->setHeure($heure);
            $description = $form->get('description')->getData();
            $intervention->setDescription($description);


            $em->persist($intervention);
            $em->flush();

            return $this->redirectToRoute('intervention_view', array('id' => $id));
        }

        if ($intervention->isFrimousse()) {
            $materiaux = $intervention->getMateriauxFrimousse()->toArray();
        } elseif ($intervention->isPlaidoyer()) {
            $materiaux = $intervention->getMaterielDispoPlaidoyer()->toArray();
        } else {
            $materiaux = array("kaki");
        }

        $materiaux = json_encode($materiaux);

        return $this->render(
            'InterventionBundle:Intervention:editIntervention.html.twig', array('form' => $form->createView(),
                                                                                 'intervention' => $intervention,
                                                                                 'materiaux' => $materiaux,
                                                                                 'demande' => $intervention->getDemande(),
            )
        );
    }

    /**
     * Demande d'intervention
     *
     * @param Request $request La requete
     * @param Int     $id      L'identifiant de la demande
     *
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention.
     */
    public function demandeAction(Request $request, $id) {

        $demande = new Demande();

        $form = $this->createForm(DemandeType::class, $demande);

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Etablissement');

        $instituteTest = $repository->find($id);

        /** Add a message to indicate the error to the user */
        if(is_null($instituteTest)) {
            return $this->RedirectToRoute('architecture_homepage');
        }
        $form->get('Etablissement')->setData($instituteTest);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $dt =new \DateTime();
            $demande->setDateDemande($dt);

            // handle the contact

            $test = (object) $form->get('Contact')->getData();

            // Extraire le contact
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
            if ($startWeek > $endWeek) {
                $endWeek = 1;
            }

            for ($week = $startWeek; $week <= $endWeek; $week++) {
                $listWeek[] = $week;
            }

            $this->treatmentInterventions($interventionsRawList, $interventionList);

            $this->treatmentContact($contactPers);
            $demande->setContact($contactPers);



            $etablissement = $form->get('Etablissement');

            $institute = $etablissement->getData();

            $educationTypeArray = $etablissement->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray);

            $otherTypeArray = $etablissement->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray);

            $centreTypeArray = $etablissement->get("typeCentre")->getData();
            $institute->setTypeCentre($centreTypeArray);

            // TODO
            // On ne doit pas effacer tous les emails puisque l'etablissement peut choisir de ne pas les re-remplir !!!!!!
            $institute->removeAllEmails();

            $emails = $etablissement->get("emails")->getData();

            /* if the adress is already in the db it means the institute might be in there too */
            $repository = $this->getDoctrine()->getRepository('ArchitectureBundle:Adresse');


            $instituteResearched = null;
            $repository = $this->getDoctrine()->getManager();
            $repository = $repository->getRepository('InterventionBundle:Etablissement');

            $institute = $instituteTest;

            if (sizeof($emails) != 0) {
                foreach ($emails as $email) {
                    if (!$institute->getEmails()->contains($email)) {
                        $institute->addEmail($email);
                    }
                }
            }

            foreach ($listWeek as $week) {
                $demande->addSemaine($week);
            }

            $this->treatmentMoment($form->get('jour')->getData(), $demande);

            $this->getDoctrine()->getManager()->persist($demande);

            $em = $this->getDoctrine()->getManager();

            $em->flush();

            foreach ($interventionList as $intervention) {
                $intervention->setEtablissement($institute);
                $intervention->setDemande($demande);

                $this->getDoctrine()->getManager()->persist($intervention);
            }

            $em->flush();


            //            $this->linkAllMoments($demande->getMomentsVoulus(), $demande);
            //
            //            $this->linkAllBMoments($demande->getMomentsAEviter(), $demande);
            $session =$request->getSession();
            $em->flush();


            $session->getFlashBag()->add(
                'notice', array(
                'title' => 'Félicitation',
                'message' => 'Votre demande d\'intervention a bien été enregistrée. Nous vous contacterons sous peu.',
                'alert' => 'success'
                )
            );

            $message = \Swift_Message::newInstance()
                ->setSubject('Intervention de l\'unicef')
                ->setFrom('unipik.dev@gmail.com')
                ->setTo('dev1@yopmail.com')
                ->setBody($this->renderView('MailBundle::emailConfirmationPriseEnCompte.html.twig'), 'text/html');
            $this->get('mailer')->send($message);

            return $this->RedirectToRoute('architecture_homepage');
        }

        if ($instituteTest->getTypeEnseignement()) {
            $typeEtablissementEncoded = array(
                'ens' => $instituteTest->getTypeEnseignement()
            );
        } else if ($instituteTest->getTypeCentre()) {
            $typeEtablissementEncoded = array(
                'centre' => $instituteTest->getTypeCentre()
            );
        } else {
            $typeEtablissementEncoded = array(
                'autre' => $instituteTest->getTypeAutreEtablissement()
            );
        }


        return $this->render(
            'InterventionBundle:Intervention:demande.html.twig', array(
            'form' => $form->createView(),
            'typEnseignement' => json_encode($typeEtablissementEncoded),
            'id' => $id,
            'etablissement' => $instituteTest
            )
        );
    }

    /**
     * Obtenir la vue
     *
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     * get consultation
     */
    public function getConsultationVue() {
        return $this->render('InterventionBundle:Intervention:consultation.html.twig');
    }

    /**
     * Consulter une action
     *
     * @param Integer $id Id de l'intervention.
     *
     * @return                      Response Permet de récupérer la vue consultation pour l'héritage.
     * @Route("/intervention/{id}", name="intervention_view")
     */
    public function consultationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');
        $intervention = $repository->find($id);
        $user = $this->getUser();

        $formAttr = $this->get('form.factory')->createBuilder(AttributionType::class)->getForm()->createView();

        if ($intervention->isFrimousse()) {
            return $this->render('InterventionBundle:Intervention/Frimousse:consultation.html.twig', array('intervention' => $intervention, 'user' => $user, 'formAttr' => $formAttr));
        } elseif ($intervention->isPlaidoyer()) {
            return $this->render('InterventionBundle:Intervention/Plaidoyer:consultation.html.twig', array('intervention' => $intervention, 'user' => $user, 'formAttr' => $formAttr));
        } else {
            return $this->render('InterventionBundle:Intervention:consultation.html.twig', array('intervention' => $intervention, 'user' => $user, 'formAttr' => $formAttr));
        }
    }

    /**
     * Consulter la demande associée à une intervention
     *
     * @param int $id L'id
     *
     * @return Response
     */
    public function consultationDemandeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');
        $intervention = $repository->find($id);
        $user = $this->getUser();
        $demande = $intervention->getDemande();
        $interventionsDeLaDemande = $repository->getInterventionsDeDemande($demande);
        $formAttr = $this->get('form.factory')->createBuilder(AttributionType::class)->getForm()->createView();
        return $this->render('InterventionBundle:Intervention:demandeConsultation.html.twig', array('intervention'=>$intervention, 'interventionsAssociees'=>$interventionsDeLaDemande, 'user' => $user, 'formAttr' => $formAttr));

    }


    /**
     * Renvoie le repository Intervention.
     *
     * @return RepositoryFactory
     */
    public function getInterventionRepository() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Intervention');
    }

    /**
     * Renvoie vers la page affichant les établissements en passant en paramètre la liste des interventions.
     *
     * @param Request $request une requête
     *
     * @return Response
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
        $distance = $form->get("distance")->getData() ? $form->get("distance")->getData() : null;

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateIntervention");
        $desc = $request->get("desc", false);

        $repository = $this->getInterventionRepository();

        $listIntervention = $repository->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statutIntervention, false, $user, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville, $distance);

        //        Création du formulaire pour la popup
        $fB = $this->get('form.factory')->createBuilder(AttributionType::class);
        $f = $fB->getForm();
        $f->handleRequest($request);

        return $this->render(
            'InterventionBundle:Intervention:liste.html.twig', array(
            'field' => $field,
            'desc' => $desc,
            'rowsPerPage' => $rowsPerPage,
            'liste' => $listIntervention,
            'typeIntervention' => $typeIntervention,
            'isCheck' => $dateChecked,
            'dateStart' => $start,
            'dateEnd' => $end,
            //            'distance' => $distance,
            'user' => $user,
            'form' => $form->createView(),
            'formAttr' => $f->createView(),
            'onlyMyIntervention' => false,
            'onlyNonAttribues' => false
            )
        );

    }

    /**
     * Renvoie vers la page affichant les demandes recentes
     *
     * @param Request $request La requete
     *
     * @return Response
     */
    public function recentDemandesListeAction(Request $request){
        $user = $this->getUser();

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;
        $typeIntervention = $form->get("typeIntervention")->getData(); //Récupération des infos de filtre

        $statutIntervention = "nonAttribuees"; //Récupération du statut de l'intervention
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

        //Création du formulaire pour la popup
        $fB = $this->get('form.factory')->createBuilder(AttributionType::class);
        $f = $fB->getForm();
        $f->handleRequest($request);

        return $this->render(
            'InterventionBundle:Intervention:liste.html.twig', array(
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
            'onlyNonAttribues' => true
            )
        );
    }

    /**
     * Renvoie vers la page d'attribution d'intervention.
     *
     * @param Request $request Une requête
     *
     * @return Response
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

        $listIntervention = $repository->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statutIntervention, true, $user, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville);

        //        Création du formulaire pour la popup
        $fB = $this->get('form.factory')->createBuilder(AttributionType::class);
        $f = $fB->getForm();
        $f->handleRequest($request);

        return $this->render(
            'InterventionBundle:Intervention:liste.html.twig', array(
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
            'onlyNonAttribues' => false
            )
        );
    }

    /**
     * Supprimer intervention
     *
     * @param Int $id id
     *
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
     * Supprimer intervention
     *
     * @param Request $request Une requete
     *
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
     * Attribuer une intervention a un benevole
     *
     * @param Request $request Une requete
     *
     * @return Response
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

            $message = \Swift_Message::newInstance()
                ->setSubject('Intervention de l\'unicef')
                ->setFrom('unipik.dev@gmail.com')
                ->setTo('dev1@yopmail.com')
                ->setBody(
                    $this->renderView(
                        'MailBundle::emailConfirmationPriseEnCharge.html.twig'
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return new JsonResponse($infos);
        }
        return new Response();
    }

    /**
     * Désattribuer l'intervention a un bénévole
     *
     * @param Request $request une requete
     *
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
     * Attribuer a un bénévole
     *
     * @param Request $request une requete
     *
     * @return Response
     */
    public function attributionAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $user = $this->getUser();
            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $intervention = $repository->find($id);

            if ($intervention->getBenevole() != null) {
                throw new Exception("Exception");
            }

            $intervention->setBenevole($user);

            $em->persist($intervention);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Intervention de l\'unicef')
                ->setFrom('unipik.dev@gmail.com')
                ->setTo('dev1@yopmail.com')
                ->setBody(
                    $this->renderView(
                        'MailBundle::emailConfirmationPriseEnCharge.html.twig'
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return new Response();
        }
        return new Response();
    }

    /**
     * Action réalisée
     *
     * @param Request $request une requete
     *
     * @return Response
     */
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
     * Intervention réalisée
     *
     * @param Request $request une requete
     *
     * @return Response
     */
    public function realisationInterventionsAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $interventions = json_decode($request->request->get('interventions'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Intervention');
            $int = $repository->findBy(array('id' => $interventions));
            foreach ($int as $i) {
                $i->setRealisee(true);
                $em->persist($i);
            }
            $em->flush();
            return new Response();
        }
        return new Response();
    }

    /**
     * Class casting
     *
     * @param string|object $destination  la destination
     * @param object        $sourceObject la source
     *
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
     * Iterates over the interventions requested to get the parameters
     *
     * @param List $interventionsRawList la liste brute
     * @param List $interventionList     la liste
     *
     * @return object
     */
    function treatmentInterventions($interventionsRawList, &$interventionList) {
        $comiteTest = $this->getDoctrine()->getManager()->getRepository('UserBundle:Comite')->find(1);
        $lvlThemeRepository = $this->getDoctrine()->getManager()->getRepository('ArchitectureBundle:NiveauTheme');
        if ($interventionsRawList !== null) {
            $interventionsRawList = array_filter($interventionsRawList);

            foreach ($interventionsRawList as $interventionRaw) {
                $interventionTemp = new Intervention();
                $interventionTemp->setRealisee(false);
                $interventionTemp->setDateIntervention(null);
                $interventionTemp->setNbPersonne($interventionRaw["nbPersonne"]);
                $interventionTemp->setComite($comiteTest);
                $lvlTheme = "";

                if ($interventionRaw["TypeGeneral"]=="pld") {
                    foreach ($interventionRaw["materielDispoPlaidoyer"]["materiel"] as $materiel) {
                        $interventionTemp->addMaterielDispoPlaidoyer($materiel);
                    }
                    if (isset($interventionRaw["niveauTheme"])) {
                        $lvlTheme = $lvlThemeRepository->findOneBy(
                            array('niveau' => $interventionRaw["niveauTheme"]->getNiveau(),
                                'theme' => $interventionRaw["niveauTheme"]->getTheme()
                            )
                        );
                        $interventionTemp->setNiveauTheme($lvlTheme);

                    }
                } elseif ($interventionRaw["TypeGeneral"]=="frim") {
                    foreach ($interventionRaw['materiauxFrimousse']["materiel"] as $materiel) {
                        $interventionTemp->addMateriauxFrimousse($materiel);
                    }
                    if (isset($interventionRaw["niveauTheme"])) {
                        $interventionTemp->setNiveauFrimousse($interventionRaw["niveauTheme"]->getNiveau());
                    }
                } elseif ($interventionRaw["TypeGeneral"]=="aut") {
                    if (isset($interventionRaw["remarques"])) {
                        $interventionTemp->setDescription($interventionRaw["remarques"]);
                    }
                }

                //                if(isset($interventionRaw["materielDispoPlaidoyer"]) && !empty($interventionRaw["materielDispoPlaidoyer"]["materiel"])){
                //                    foreach ($interventionRaw["materielDispoPlaidoyer"]["materiel"] as $materiel){
                //                        $interventionTemp->addMaterielDispoPlaidoyer($materiel);
                //                    }
                //                    if(isset($interventionRaw["niveauTheme"])){
                //                        $lvlTheme = $lvlThemeRepository->findOneBy(
                //                            array('niveau' => $interventionRaw["niveauTheme"]->getNiveau(),
                //                                'theme' => $interventionRaw["niveauTheme"]->getTheme()
                //                            )
                //                        );
                //                        $interventionTemp->setNiveauTheme($lvlTheme);
                //
                //                    }
                //                }
                //
                //                 if(isset($interventionRaw['materiauxFrimousse']) && !empty($interventionRaw['materiauxFrimousse']["materiel"])){
                //                    foreach ($interventionRaw['materiauxFrimousse']["materiel"] as $materiel){
                //                        $interventionTemp->addMateriauxFrimousse($materiel);
                //                    }
                //                    if(isset($interventionRaw["niveauTheme"])) {
                //                        $interventionTemp->setNiveauFrimousse($interventionRaw["niveauTheme"]->getNiveau());
                //                    }
                //                }

                $interventionList[] = $interventionTemp;
            }
        }
    }

    /**
     * Iterates over a contact to check if she/he is already in the db, take the one from the db in the last case
     *
     * @param Contact $contactPers le contact
     *
     * @return object
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

        if (!is_null($contactBase)) {
            $contactPers = $contactBase;
        } else {
            $this->getDoctrine()->getManager()->persist($contactPers);
            $this->getDoctrine()->getManager()->flush();
        }
    }

    /**
     * Iterates over the moments to fill the one from the demand
     *
     * @param MomentType $moments moment
     * @param Demande    $demande demande
     *
     * @return object
     */
    function treatmentMoment($moments,\Unipik\InterventionBundle\Entity\Demande &$demande) {
        $this->treatmentAvoidDay(array_keys($moments, 'a-eviter'), $demande);
        $this->treatmentAllDay(array_keys($moments, 'indifferent'), $demande);
        $this->treatmentMorning(array_keys($moments, 'matin'), $demande);
        $this->treatmentAftNoon(array_keys($moments, 'apres-midi'), $demande);
    }

    /**
     * Traite les matins
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentMorning(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande){
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $moment = $repository->getByDayAndMoment($day, 'matin');

            $demande->addMomentsVoulus($moment);
        }
    }

    /**
     * Traite les apres midi
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentAftNoon(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande){
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $moment = $repository->getByDayAndMoment($day, 'apres-midi');

            $this->getDoctrine()->getManager()->persist($moment);
            $this->getDoctrine()->getManager()->flush();
            $demande->addMomentsVoulus($moment);
        }
    }

    /**
     * Liste les jours a eviter
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentAvoidDay(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande) {
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $moment = $repository->getByDayAndMoment($day, 'matin');
            $demande->addMomentsAEviter($moment);

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $momentP = $repository->getByDayAndMoment($day, 'apres-midi');
            $demande->addMomentsAEviter($momentP);
        }
    }

    /**
     * Liste les jours complets
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentAllDay(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande) {
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $moment = $repository->getByDayAndMoment($day, 'matin');
            $demande->addMomentsVoulus($moment);

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $momentP = $repository->getByDayAndMoment($day, 'apres-midi');
            $demande->addMomentsVoulus($momentP);
        }
    }
}
