<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 09:48
 */

namespace Unipik\InterventionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\InterventionBundle\Form\EtablissementType;
use Unipik\InterventionBundle\Form\Etablissement\RechercheAvanceeType;

class EtablissementController extends Controller {

    /**
     * @param $id integer Id de l'établissement souhaitant réaliser une demande.
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     */
    public function consultationAction($id) {
        return $this->render('InterventionBundle:Etablissement:consultation.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request) {
        $institute = new Etablissement();
        $form = $this->get('form.factory')->create(EtablissementType::class, $institute);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $educationTypeArray = $form->get("typeEnseignement")->getData();
            $institute->setTypeEnseignement($educationTypeArray);

            $otherTypeArray = $form->get("typeAutreEtablissement")->getData();
            $institute->setTypeAutreEtablissement($otherTypeArray);

            $centreTypeArray = $form->get("typeCentre")->getData();
            $institute->setTypeCentre($centreTypeArray);

            $em = $this->getDoctrine()->getManager();
            $em->persist($institute);
            $em->flush();

            return $this->redirectToRoute('architecture_homepage');
        }

        return $this->render('InterventionBundle:Etablissement:ajouterEtablissement.html.twig', array('form' => $form->createView()));
    }

    /**
     *
     */
    public function editAction() {

    }

    /**
     *
     */
    public function deleteAction() {

    }

    public function getEtablissementRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Etablissement');
    }

    /**
     * @return Response Renvoie vers la page affichant la liste des données des établissements.
     */
    public function listeAction(Request $request, $typeE) {
        $form = $this->get('form.factory')->create(RechercheAvanceeType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $typeEtablissement = $form->get("typeEtablissement")->getData();
            return $this->redirectToRoute('etablissement_list', array('typeE' => $typeEtablissement));
        }
//
//        $startI = $request->getSession()->get('startI');
//        $endI = $request->getSession()->get('endI');
//        $dateCheckedI = $request->getSession()->get('dateCheckedI');
        switch ($typeE) {
            case "enseignement":
                $repository = $this->getEtablissementRepository();
                $listEtablissement = $repository->getEnseignements();
                break;
            case "centre":
                $repository = $this->getEtablissementRepository();
                $listEtablissement = $repository->getCentresLoisirs();
                break;
            case "autreEtablissement":
                $repository = $this->getEtablissementRepository();
                $listEtablissement = $repository->getAutresEtablissements();
                break;
            default:
                $repository = $this->getEtablissementRepository();
                $listEtablissement = $repository->findAll();
                break;
        }

        return $this->render('InterventionBundle:Etablissement:liste.html.twig', array(
            'liste' => $listEtablissement,
//            'typeIntervention' => $typeI,
//            'isCheck' => $dateCheckedI,
//            'dateStart' => $startI,
//            'dateEnd' => $endI,
            'form' => $form->createView()
        ));
    }
}
