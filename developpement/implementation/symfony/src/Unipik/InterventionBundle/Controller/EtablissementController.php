<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 09:48
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


use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\InterventionBundle\Form\EtablissementType;
use Unipik\InterventionBundle\Form\Etablissement\RechercheAvanceeType;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;
/**
 * Le controller qui gère les etablissements
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class EtablissementController extends Controller {

    /**
     * Renvoie vers la page de consultation liée à l'établissement.
     *
     * @param integer $id Id de l'établissement souhaitant réaliser une demande.
     *
     * @return Response
     */
    public function consultationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repositoryEtablissement = $em->getRepository('InterventionBundle:Etablissement');
        $etablissement = $repositoryEtablissement->find($id);
        $repositoryIntervention =  $em->getRepository('InterventionBundle:Intervention');
        $interventionsRealisees = $repositoryIntervention->getInterventionsRealiseesOuNonEtablissement($etablissement, true);
        $interventionsDemandeesNonRealisees = $repositoryIntervention->getInterventionsRealiseesOuNonEtablissement($etablissement, false);
        return $this->render('InterventionBundle:Etablissement:consultation.html.twig', array('etablissement' => $etablissement, 'listeInterventionsRealisees'=> $interventionsRealisees, 'listeInterventionsDemandeesNonRealisees'=> $interventionsDemandeesNonRealisees));
    }

    /**
     * Ajoute un etablissement
     *
     * @param Request $request la requete
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request) {
        $institute = new Etablissement();
        $form = $this->get('form.factory')->create(EtablissementType::class, $institute)->remove('etablissement_typeEnseignement_placeholder');

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $educationTypeArray = $form->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray);

            $otherTypeArray = $form->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray);

            $centreTypeArray = $form->get("typeCentre")->getData();
            $institute->setTypeCentre($centreTypeArray);

            $emails = $form->get("emails")->getData();
            foreach ($emails as $email) {
                $institute->addEmail($email);
            }

            $institute->setNom(strtoupper($institute->getNom()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($institute);
            $em->flush();

            $repositoryAdresse = $em->getRepository("ArchitectureBundle:Adresse");
            $adresse = $repositoryAdresse->findOneBy(array('id' => $institute->getAdresse()));
            $adresse->setAdresse(strtoupper($adresse->getAdresse()));
            $adresse->setComplement(strtoupper($adresse->getComplement()));

            $em->persist($adresse);
            $em->flush();

            return $this->redirectToRoute('etablissement_view', array('id' => $institute->getId()));
        }

        return $this->render('InterventionBundle:Etablissement:ajouterEtablissement.html.twig', array('form' => $form->createView()));
    }

    /**
     * Supprime un etablissement
     *
     * @param Int $id id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteEtablissementAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $institute = $this->getEtablissementRepository()->findOneBy(array('id' => $id));
        $em->remove($institute);
        $em->flush();

        return $this->redirectToRoute('etablissement_list');
    }

    /**
     * Supprime des etablissements
     *
     * @param Request $request la requete
     *
     * @return Response
     */
    public function deleteEtablissementsAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $ids = json_decode($request->request->get('ids'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Etablissement');
            $etablissements = $repository->findBy(array('id' => $ids));
            foreach ($etablissements as $etablissement) {
                $em->remove($etablissement);
            }
            $em->flush();
            return new Response();
        }
        return new Response();
    }

    /**
     * Renvoie les etablissements
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Unipik\InterventionBundle\Entity\EtablissementRepository
     */
    public function getEtablissementRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Etablissement');
    }

    /**
     * Renvoie vers la page affichant la liste des données des établissements.
     *
     * @param Request $request la requete
     *
     * @return Response
     */
    public function listeAction(Request $request) {
        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $typeEtablissement = $form->get("typeEtablissement")->getData();
        $ville = $form->get("ville")->getData();
        $geolocalisation = $form->get("geolocalisation")->getData();
        $distance = $form->get("distance")->getData();
        $types = $typeEtablissement!="" ? $form->get("type".ucfirst($typeEtablissement))->getData() : null;

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "nom");
        $desc = $request->get("desc", false);

        $repository = $this->getEtablissementRepository();

        $listEtablissement = $repository->getType($typeEtablissement, $types, $ville, $field, $desc, $geolocalisation, $distance);

        return $this->render(
            'InterventionBundle:Etablissement:liste.html.twig', array(
            'field' => $field,
            'desc' => $desc,
            'rowsPerPage' => $rowsPerPage,
            'liste' => $listEtablissement,
            'typeEtablissement' => $typeEtablissement,
            'form' => $form->createView()
            )
        );
    }

    /**
     * Modification d'un etablissement
     *
     * @param Request $request la requete
     * @param int     $id      l'id
     *
     * @return mixed
     */
    public function editAction(Request $request, $id) {
        $institute = $this->getEtablissementRepository()
            ->findOneBy(array('id' => $id));

        $form = $this->get('form.factory')
            ->createBuilder(EtablissementType::class, $institute)
            ->getForm();

        if ($form->handleRequest($request)->isValid() &&  $request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $institute->removeAllEmails();

            $emails = $form->get("emails")->getData();
            foreach ($emails as $email) {
                $institute->addEmail($email);
            }

            $instituteType =  $form->get('TypeGeneral')->getData();

            if ($instituteType == 'ens') {
                $institute->setTypeEnseignement($form->get('typeEnseignement')->getData());
                $institute->setTypeCentre(null);
                $institute->setTypeAutreEtablissement(null);
            } else if ($instituteType == 'centre') {
                $institute->setTypeCentre($form->get('typeCentre')->getData());
                $institute->setTypeEnseignement(null);
                $institute->setTypeAutreEtablissement(null);
            } else {
                $institute->setTypeAutreEtablissement($form->get('typeAutreEtablissement')->getData());
                $institute->setTypeEnseignement(null);
                $institute->setTypeCentre(null);
            }

            $institute->setNom(strtoupper($institute->getNom()));

            $em->persist($institute);
            $em->flush();

            $repositoryAdresse = $em->getRepository("ArchitectureBundle:Adresse");
            $adresse = $repositoryAdresse->findOneBy(array('id' => $institute->getAdresse()));
            $adresse->setAdresse(strtoupper($adresse->getAdresse()));
            $adresse->setComplement(strtoupper($adresse->getComplement()));

            $em->persist($adresse);
            $em->flush();

            return $this->redirectToRoute('etablissement_view', array('id' => $id));
        }

        $emails = json_encode($institute->getEmails()->toArray());
        return $this->render(
            'InterventionBundle:Etablissement:editEtablissement.html.twig', array('form' => $form->createView(),
                                                                                   'etablissement' => $institute,
                                                                                   'emails' => $emails,
            )
        );
    }

    /**
     * Autocomplétion du nom d'un établissement
     *
     * @param Request $request La requete
     *
     * @return JsonResponse
     */
    public function etablissementAutocompleteAction(Request $request) {
        $names = array();

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Etablissement');


        // Récupération de ce qui est tapé
        $term = trim(strip_tags($request->get('term')));
        $term = strtoupper($term);
        // Récupération du département
        if ($request->get('?dep')) {
            $dep = trim(strip_tags($request->get('?dep')));
            $dep = strtoupper($dep);
        } else {
            $dep = null;
        }
        // Récupération de la ville
        if ($request->get('?ville')) {
            $ville = trim(strip_tags($request->get('?ville')));
            $ville = strtoupper($ville);
        } else {
            $ville = null;
        }
        // Récupération du type Enseignement
        if ($request->get('?ens')) {
            $typeEns = trim(strip_tags($request->get('?ens')));
        } else {
            $typeEns = null;
        }
        // Récupération du type Centre
        if ($request->get('?centre')) {
            $typeCentre = trim(strip_tags($request->get('?centre')));
        } else {
            $typeCentre = null;
        }
        // Récupération du type Autre Etablissement
        if ($request->get('?autre')) {
            $typeAutre = trim(strip_tags($request->get('?autre')));
        } else {
            $typeAutre = null;
        }

        $entities = $repository->etablissementAutocomplete($term, $dep, $ville, $typeEns, $typeCentre, $typeAutre);

        foreach ($entities as $entity) {
            $names[] = $entity->getNom();
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;

    }

    public function verifyEtablissementAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $etablissementNom = $request->get('etablissement');
            $etablissementNom = strtoupper($etablissementNom);


            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Etablissement');

            $etablissement = $repository->findOneBy(array('nom' => $etablissementNom));

            if ($etablissement){
                return new JsonResponse(array('result' => true));
            }else {
                return new JsonResponse(array('result' => false));
            }

        }
        return new Response();
    }
}
