<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 17/11/16
 * Time: 10:26
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
use Unipik\InterventionBundle\Entity\Vente;
use Unipik\InterventionBundle\Form\Vente\VenteType;

use Unipik\InterventionBundle\Form\Vente\RechercheAvanceeType;

/**
 * Le controller qui gère les ventes
 *
 * @category None
 * @package  InterventionBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class VenteController extends Controller {

    /**
     * Liste action
     *
     * @param Request $request La requete
     *
     * @return mixed
     */
    public function listeAction(Request $request) {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;

        $ville = $form->get("ville")->getData();
        $start = $form->get("start")->getData();
        $end = $form->get("end")->getData();
        $borne1 = $form->get("CADebut")->getData();
        $borne2 = $form->get("CAFin")->getData();
        $distance = $form->get("distance")->getData();
        $geolocalisation = $form->get("geolocalisation")->getData();
        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateVente");
        $desc = $request->get("desc", false);

        $venteRepository = $em->getRepository('InterventionBundle:Vente');
        $listVente = $venteRepository->getType($start, $end, $dateChecked, $field, $desc,  $user, $ville, $distance, $geolocalisation, null, null, $borne1, $borne2);



            return $this->render(
                'InterventionBundle:Vente:liste.html.twig', array( 'ventes' => $listVente,
                                                                    'rowsPerPage' => $rowsPerPage,
                                                                    'field' => $field,
                                                                    'desc' => $desc,
                                                                    'isCheck' => $dateChecked,
                                                                    'dateStart' => $start,
                                                                    'dateEnd' => $end,
                                                                    'user' => $user,
                                                                    'form' => $form->createView(),
                                                                    'venteEtablissementListe' => false,
                                                                    'venteInterventionListe' => false)
            );
    }

    /**
     * Liste des ventes liées à un établissement action
     *
     * @param Request $request La requete
     *
     * @return mixed
     */
    public function listeEtablissementAction(Request $request, $id) {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $listVente = [];

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;
        $ville = $form->get("ville")->getData();
        $start = $form->get("start")->getData();
        $borne1 = $form->get("CADebut")->getData();
        $borne2 = $form->get("CAFin")->getData();
        $end = $form->get("end")->getData();
        $distance = $form->get("distance")->getData();
        $geolocalisation = $form->get("geolocalisation")->getData();
        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateVente");
        $desc = $request->get("desc", false);

        $etablissement = $em->getRepository('InterventionBundle:Etablissement')->find($id);

        $venteRepository = $em->getRepository('InterventionBundle:Vente');

        $listVente = $venteRepository->getType($start, $end, $dateChecked, $field, $desc,  $user, $ville, $distance, $geolocalisation, $etablissement, null, $borne1, $borne2);



        return $this->render(
            'InterventionBundle:Vente:liste.html.twig', array( 'ventes' => $listVente,
                'rowsPerPage' => $rowsPerPage,
                'field' => $field,
                'desc' => $desc,
                'isCheck' => $dateChecked,
                'dateStart' => $start,
                'dateEnd' => $end,
                'user' => $user,
                'form' => $form->createView(),
                'venteEtablissementListe' => true,
                'venteInterventionListe' => false,
                'etablissementId' => $id
            )
        );
    }

    /**
     * Liste des ventes liées à une intervention action
     *
     * @param Request $request La requete
     *
     * @return mixed
     */
    public function listeInterventionAction(Request $request, $id) {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $listVente = [];

        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $dateChecked = ($request->isMethod('GET') && $form->isValid()) ? $form->get("date")->getData() : true;

        $ville = $form->get("ville")->getData();
        $start = $form->get("start")->getData();
        $end = $form->get("end")->getData();
        $borne1 = $form->get("CADebut")->getData();
        $borne2 = $form->get("CAFin")->getData();
        $distance = $form->get("distance")->getData();
        $geolocalisation = $form->get("geolocalisation")->getData();
        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "dateVente");
        $desc = $request->get("desc", false);

        $intervention = $em->getRepository('InterventionBundle:Intervention')->find($id);

        $venteRepository = $em->getRepository('InterventionBundle:Vente');

        $listVente = $venteRepository->getType($start, $end, $dateChecked, $field, $desc,  $user, $ville, $distance, $geolocalisation, null, $intervention, $borne1, $borne2);



        return $this->render(
            'InterventionBundle:Vente:liste.html.twig', array( 'ventes' => $listVente,
                'rowsPerPage' => $rowsPerPage,
                'field' => $field,
                'desc' => $desc,
                'isCheck' => $dateChecked,
                'dateStart' => $start,
                'dateEnd' => $end,
                'user' => $user,
                'form' => $form->createView(),
                'venteEtablissementListe' => false,
                'venteInterventionListe' => true,
                'interventionId' => $id
            )
        );
    }



    /**
     * Consultation action
     *
     * @param int $id L'id
     *
     * @return mixed
     */
    public function consultationAction($id) {
        $vente = $this->getDoctrine()->getManager()->getRepository("InterventionBundle:Vente")->find($id);
        return $this->render('InterventionBundle:Vente:consultation.html.twig', array('vente' => $vente));
    }

    /**
     * Edit action
     *
     * @param int $id L'id
     *
     * @return Response
     */
    public function editAction($id) {
        return new Response("Ici on pourra modifier la vente ".$id);
    }

    /**
     * Add action
     *
     * @param Request $request La requete
     *
     * @return Response
     */
    public function addAction(Request $request) {
        $vente = new Vente();
        $form = $this->createForm(VenteType::class, $vente);

        if ($form->handleRequest($request)->isValid()) {
            /*
             * Faire le traitement de sauvegarde  de la vente
             */
            $intervention = $request->get('intervention');
            $etablissement = $request->get('etablissement');

            if (is_null($etablissement) && is_null($intervention)) {
                return new Response(" t'as rien rentré pti bout");
            }
            if (is_null($intervention)) {
                $etablissement = $this->getDoctrine()->getManager()->getRepository('InterventionBundle:Etablissement')->find($etablissement);
                $vente->setEtablissement($etablissement);
            } else {
                $intervention = $this->getDoctrine()->getManager()->getRepository('InterventionBundle:Intervention')->find($intervention);
                $vente->setIntervention($intervention);
                $vente->setEtablissement($intervention->getEtablissement());
            }
            $this->getDoctrine()->getManager()->persist($vente);
            $this->getDoctrine()->getManager()->flush();
            return new Response("Voili voilou ");
        }

        return $this->render(
            'InterventionBundle:Vente:ajouterVente.html.twig',
            array('form' => $form->createView(),
                )
        );
    }

    /**
     * Delete vente action
     *
     * @param int $id L'id
     *
     * @return mixed
     */
    public function deleteVenteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $vente = $em->getRepository('InterventionBundle:Vente')->findOneBy(array('id' => $id));
        $em->remove($vente);
        $em->flush();

        return $this->redirectToRoute('vente_list');
    }

    /**
     * Delete ventes action
     *
     * @param Request $request La requete
     *
     * @return Response
     */
    public function deleteVentesAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $ids = json_decode($request->request->get('ids'));

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('InterventionBundle:Vente');
            $ventes = $repository->findBy(array('id' => $ids));

            foreach ($ventes as $vente) {
                $em->remove($vente);
            }

            $em->flush();
            return new Response();
        }
        return new Response();
    }



}

