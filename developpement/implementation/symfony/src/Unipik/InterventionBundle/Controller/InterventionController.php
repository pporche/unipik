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
use Unipik\InterventionBundle\Form\DemandeAnonymeType;
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
     * @param Int     $id      L'identifiant de l'etablissement
     *
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention.
     */
    public function demandeAction(Request $request, $id) {

        $demande = new Demande();

        $form = $this->createForm(DemandeType::class, $demande);

        $em = $this->getDoctrine()->getManager();
        $repositoryEtablissement = $em->getRepository('InterventionBundle:Etablissement');

        $institute = $repositoryEtablissement->find($id);

        if (is_null($institute)) {
            $session =$request->getSession();

            $session->getFlashBag()->add(
                'notice', array(
                    'title' => 'Erreur',
                    'message' => 'L\'établissement demandé n\'existe pas.',
                    'alert' => 'danger'
                )
            );
            // rediriger vers demande anonyme
            return $this->RedirectToRoute('architecture_homepage');
        }

        // Pré-remplir les champs d'établissement
        $form->get('Etablissement')->setData($institute);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Spécifier la date de la demande
            $dt =new \DateTime();
            $demande->setDateDemande($dt);

            // Extraire et traiter les interventions
            $interventionsRawList = $form->get('Intervention')->getData();
            $interventionList = [];
            $this->treatmentInterventions($interventionsRawList, $interventionList);

            // Extraire et traiter le contact
            $contact = (object) $form->get('Contact')->getData();
            $contactPers = new Contact();
            $this->cast($contactPers, $contact);
            $contactPers->setRespoEtablissement($contact->isRespoEtablissement());
            $contactPers->setTypeContact($contact->getTypeContact());

            $this->treatmentContact($contactPers);
            $demande->setContact($contactPers);

            // Extraire et traiter l'établissement
            $etablissementRaw = $form->get('Etablissement');

            $institute = $etablissementRaw->getData();
            $this->treatmentEtablissement($institute, $etablissementRaw);

            // Extraire et traiter la plage de disponibilité de l'établissement
            $startDate = $form->get('plageDate')->get('debut')->getData();
            $endDate = $form->get('plageDate')->get('fin')->getData();
            $demande->setDateDebutDisponibilite($startDate);
            $demande->setDateFinDisponibilite($endDate);


            // Extraire et traiter les moments voulus et à éviter
            $this->treatmentMoment($form->get('jour')->getData(), $demande);

            // Persit la demande
            $this->getDoctrine()->getManager()->persist($demande);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // Reliement des interventions avec leur établissement et la demande correspondant
            foreach ($interventionList as $intervention) {
                $intervention->setEtablissement($institute);
                $intervention->setDemande($demande);
                $this->getDoctrine()->getManager()->persist($intervention);
            }
            $em->flush();

            // Message de félicitation
            $session =$request->getSession();
            $session->getFlashBag()->add(
                'notice', array(
                'title' => 'Félicitation',
                'message' => 'Votre demande d\'intervention a bien été enregistrée. Nous vous contacterons sous peu.',
                'alert' => 'success'
                )
            );

            // Envoie de l'email
            $message = \Swift_Message::newInstance()
                ->setSubject('Intervention de l\'unicef')
                ->setFrom('unipik.dev@gmail.com')
                ->setTo('dev1@yopmail.com')
                ->setBody($this->renderView('MailBundle::emailConfirmationPriseEnCompte.html.twig'), 'text/html');
            $this->get('mailer')->send($message);

            return $this->RedirectToRoute('architecture_homepage');
        }

        // Envoie de paramètres initiaux à la vue
        if ($institute->getTypeEnseignement()) {
            $typeEtablissementEncoded = array(
                'ens' => $institute->getTypeEnseignement()
            );
        } else if ($institute->getTypeCentre()) {
            $typeEtablissementEncoded = array(
                'centre' => $institute->getTypeCentre()
            );
        } else {
            $typeEtablissementEncoded = array(
                'autre' => $institute->getTypeAutreEtablissement()
            );
        }


        return $this->render(
            'InterventionBundle:Intervention:demande.html.twig', array(
            'form' => $form->createView(),
            'typEnseignement' => json_encode($typeEtablissementEncoded),
            'id' => $id,
            'etablissement' => $institute
            )
        );
    }

    /**
     * Demande d'intervention anonyme (on ne connait pas l'établissement qui fait la demande)
     *
     * @param Request $request La requete
     *
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention anonyme.
     */
    public function demandeAnonymeAction(Request $request) {
        $demande = new Demande();
        $form = $this->createForm(DemandeAnonymeType::class, $demande);

        return $this->render(
            'InterventionBundle:Intervention:demandeAnonyme.html.twig', array(
                'form' => $form->createView(),
//                'typEnseignement' => json_encode($typeEtablissementEncoded),
//                'id' => $id,
//                'etablissement' => $institute
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
            $idvente = $this->getDoctrine()->getManager()->getRepository("InterventionBundle:Vente")->findOneBy(array('intervention' => $intervention));
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
        $distance = $form->get("distance")->getData();
        $geolocalisation = $form->get("geolocalisation")->getData();

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateIntervention");
        $desc = $request->get("desc", false);

        $repository = $this->getInterventionRepository();

        $listIntervention = $repository->getType($start, $end, $dateChecked, $typeIntervention, $field, $desc, $statutIntervention, false, $user, $niveauFrimousse, $niveauPlaidoyer, $theme, $ville, $distance, $geolocalisation);

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
        // Affectation de l'intervention au comite "Haute-normandie"
        $comite = $this->getDoctrine()->getManager()->getRepository('UserBundle:Comite')->find(1);

        $repositoryNiveauTheme = $this->getDoctrine()->getManager()->getRepository('ArchitectureBundle:NiveauTheme');
        if ($interventionsRawList !== null) {
            // Si le formulaire a été validé sans intervention, $interventionsRawList = NULL
            $interventionsRawList = array_filter($interventionsRawList);

            foreach ($interventionsRawList as $interventionRaw) {
                $interventionTemp = new Intervention();
                $interventionTemp->setRealisee(false);
                $interventionTemp->setDateIntervention(null);
                $interventionTemp->setNbPersonne($interventionRaw["nbPersonne"]);
                $interventionTemp->setComite($comite);

                if ($interventionRaw["TypeGeneral"]=="pld") {
                    $interventionTemp->setTypeIntervention("plaidoyers");
                    foreach ($interventionRaw["materielDispoPlaidoyer"]["materiel"] as $materiel) {
                        $interventionTemp->addMaterielDispoPlaidoyer($materiel);
                    }
                    if (isset($interventionRaw["niveauTheme"])) {
                        $niveauTheme = $repositoryNiveauTheme->findOneBy(
                            array('niveau' => $interventionRaw["niveauTheme"]->getNiveau(),
                                'theme' => $interventionRaw["niveauTheme"]->getTheme()
                            )
                        );
                        $interventionTemp->setNiveauTheme($niveauTheme);

                    }
                } elseif ($interventionRaw["TypeGeneral"]=="frim") {
                    $interventionTemp->setTypeIntervention("frimousse");
                    foreach ($interventionRaw['materiauxFrimousse']["materiel"] as $materiel) {
                        $interventionTemp->addMateriauxFrimousse($materiel);
                    }
                    if (isset($interventionRaw["niveauTheme"])) {
                        $interventionTemp->setNiveauFrimousse($interventionRaw["niveauTheme"]->getNiveau());
                    }
                } elseif ($interventionRaw["TypeGeneral"]=="aut") {
                    $interventionTemp->setTypeIntervention("autre_intervention");
                    if (isset($interventionRaw["remarques"])) {
                        $interventionTemp->setDescription($interventionRaw["remarques"]);
                    }
                }

                $interventionList[] = $interventionTemp;
            }
        }
    }

    /**
     * Permet d'effectuer le traitement sur l'établissement
     * Si l'établissement modifie les informations les concernant, elle doivent être enregistrées
     *
     * @param $institute
     * @param $etablissementRaw
     *
     * @return void
     */
    function treatmentEtablissement($institute, $etablissementRaw) {
        $emails = $etablissementRaw->get("emails")->getData();
        if (sizeof($emails) != 0) {
            foreach ($emails as $email) {
                if (!$institute->getEmails()->contains($email)) {
                    $institute->addEmail($email);
                }
            }
        }

        $nomEtablissement = $etablissementRaw->get("nom")->getData();
        $institute->setNom($nomEtablissement);

        $telFixeEtablissement = $etablissementRaw->get("telFixe")->getData();
        $institute->setTelFixe($telFixeEtablissement);

        // Extraire et traiter l'adresse
        $adresse = $etablissementRaw->get("adresse")->getData();
        $institute->setAdresse($adresse);
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
        $repositoryContact = $em->getRepository('UserBundle:Contact');

        // Récupération du contact en base de données
        $contactBase = $repositoryContact->findOneBy(
            array(
                'nom' => $contactPers->getNom(),
                'prenom' => $contactPers->getPrenom(),
                'email' => $contactPers->getEmail()
            )
        );

        // Si $contactBase=null alors le contact n'était pas présent dans la base de données, il faut donc l'ajouter
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
     * Permet d'associer les matins où l'établissement est disponible avec la demande
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentMorning(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande){
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repositoryMomentHebdomadaire = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $moment = $repositoryMomentHebdomadaire->getByDayAndMoment($day, 'matin');

            $demande->addMomentsVoulus($moment);
        }
    }

    /**
     * Permet d'associer les après-midi où l'établissement est disponible avec la demande
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentAftNoon(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande){
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repositoryMomentHebdomadaire = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $moment = $repositoryMomentHebdomadaire->getByDayAndMoment($day, 'apres-midi');

            $demande->addMomentsVoulus($moment);
        }
    }

    /**
     * Permet d'associer les jours complets où l'établissement n'est pas disponible avec la demande
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentAvoidDay(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande) {
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repositoryMomentHebdomadaire = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $momentM = $repositoryMomentHebdomadaire->getByDayAndMoment($day, 'matin');
            $demande->addMomentsAEviter($momentM);

            $momentAM = $repositoryMomentHebdomadaire->getByDayAndMoment($day, 'apres-midi');
            $demande->addMomentsAEviter($momentAM);
        }
    }

    /**
     * Permet d'associer les jours complets où l'établissement est disponible avec la demande
     *
     * @param array   $days    les jours
     * @param Demande $demande la demande
     *
     * @return object
     */
    function treatmentAllDay(Array $days, \Unipik\InterventionBundle\Entity\Demande &$demande) {
        foreach ($days as $day) {
            $em = $this->getDoctrine()->getManager();
            $repositoryMomentHebdomadaire = $em->getRepository('ArchitectureBundle:MomentHebdomadaire');
            $momentM = $repositoryMomentHebdomadaire->getByDayAndMoment($day, 'matin');
            $demande->addMomentsVoulus($momentM);

            $momentAM = $repositoryMomentHebdomadaire->getByDayAndMoment($day, 'apres-midi');
            $demande->addMomentsVoulus($momentAM);
        }
    }
}
