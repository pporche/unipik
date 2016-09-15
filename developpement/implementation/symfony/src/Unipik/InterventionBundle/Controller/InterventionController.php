<?php

namespace Unipik\InterventionBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Form\DemandeInterventionType;
use Unipik\InterventionBundle\Form\Intervention\RechercheAvanceeType;
use Unipik\InterventionBundle\Entity\InterventionRepository;

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:55
 */
class InterventionController extends Controller
{

    /**
     * @param $request Request
     * @param $id integer Id du formaulaire de demande d'intervention.
     * @return FormBuilderInterface Renvoie vers la page contenant le formualaire de demande d'intervention.
     */
    public function demandeAction(Request $request, $id)
    {

        $form = $this->createForm(DemandeInterventionType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $session = $request->getSession();
            $session->getFlashBag()->add('notice', array(
                'title' => 'Félicitation',
                'message' => 'Votre demande a bien été enregistrée.',
                'alert' => 'success'
            ));


            return $this->RedirectToRoute('');
        }
        return $this->render('InterventionBundle:Intervention:demande.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     */
    public function getConsultationVue()
    {
        return $this->render('InterventionBundle:Intervention:consultation.html.twig');
    }

    /**
     * @param $id integer Id de l'intervention.
     * @return Response Permet de récupérer la vue consultation pour l'héritage.
     */
    public function consultationAction($id)
    {
        // Faire la vérication si l'intervention est un plaidoyer, frimousse ou autre
        // Et appeler la vue correspondante
        return $this->getConsultationVue();
    }

    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }


    /**
     * @param $liste array Liste des établissements.
     * @return Response Renvoie vers la page permettant l'affichage de l'ensemble des interventions.
     */
    public function getListeVue($liste, $form)
    {

        return $this->render('InterventionBundle:Intervention:liste.html.twig', array(
            'liste' => $liste,
            'form' => $form->createView()
        ));
    }

    /**
     * @return RepositoryFactory Renvoie le repository Intervention.
     */
    public function getInterventionRepository()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Intervention');
    }

    /**
     * @return Response Renvoie vers la page affichant les établissements en passant en paramètre la liste des interventions.
     */
    public function listeAction(Request $request, $typeI)
    {

        $form = $this->get('form.factory')->create(RechercheAvanceeType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $typeIntervention = $form->get("typeIntervention")->getData();
            $start = $form->get("start")->getData();
            $end = $form->get("end")->getData();
            return $this->redirectToRoute('intervention_list', array('typeI' => $typeIntervention, 'startI' => $start, 'endI' => $end));
        }


        $startI = $request->attributes->get('startI');
        $endI = $request->attributes->get('endI');
        switch ($typeI) {
            case "plaidoyer":
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->getPlaidoyers(new \DateTime('2000-01-01'), new \DateTime('0001-01-01'));
                //               $listIntervention = $repository->getPlaidoyers(null, null);
                break;
            case "frimousse":
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->getFrimousses(new \DateTime('0001-01-01'), new \DateTime('0001-01-01'));
                //               $listIntervention = $repository->getFrimousses(null, null);
                break;
            case "autre":
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->getAutresInterventions(new \DateTime('0001-01-01'), new \DateTime('0001-01-01'));
                //               $listIntervention = $repository->getAutresEtablissements(null, null);
                break;
            default:
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->findAll();
                break;
        }

        return $this->getListeVue($listIntervention, $form);

    }

    /**
     * @return Response Renvoie vers la page d'attribution d'intervention.
     */
    public function attribueesAction()
    {

        return $this->render('InterventionBundle:Intervention/Attribuees:liste.html.twig', array(
            'liste' => null
        ));
    }

    public function annulerAction($id)
    {

        $em = $this - getListeRepository();
        $intervention = $em->find($id);
        $this->getDoctrine()->getManager()->remove($intervention);
        return $this->render('InterventionBundle:Intervention:annulationDemande.html.twig');
    }

    public function locationAction()
    {

    }

}
