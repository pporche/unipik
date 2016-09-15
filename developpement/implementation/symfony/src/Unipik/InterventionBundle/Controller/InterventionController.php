<?php

namespace Unipik\InterventionBundle\Controller;

use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Form\DemandeType;
use Unipik\UserBundle\Entity\Contact;
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

        $form = $this->createForm(DemandeType::class);
        $form->handleRequest($request);


        if($form->isValid()) {
            // Extraire les données
            $test = (object) $form->getData();
            // Extraire le contact
            $em = $this->getDoctrine()->getManager();
            $contactSub = $em->getRepository('UserBundle:Contact')->findOneById(15);

            return new Response(print_r( (object) $contactSub));
            $contactSub = (object) $test->Contact;
            $contactPers = new Contact();
            $this->cast($contactPers,$contactSub);
            $contactPers->setRespoEtablissement(false);
            $contactPers->setTypeActivite('{}');
            $em->persist($contactPers);
            $em->flush();
            return new Response(print_r( $contactPers->getEmail()));
            $session =$request->getSession();

            $session->getFlashBag()->add('notice', array(
                'title'=>'Félicitation',
                'message'=>'Votre demande d/\'intervention a bien été enregistrée. Nous vous contacterons sous peu',
                'alert'=>'success'
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
     */
    public function consultationAction($id) {
        // Faire la vérication si l'intervention est un plaidoyer, frimousse ou autre
        // Et appeler la vue correspondante
        return $this->getConsultationVue();
    }

    /**
     * @param $liste array Liste des établissements.
     * @return Response Renvoie vers la page permettant l'affichage de l'ensemble des interventions.
     */
    public function getListeVue($liste,  $typeI, $dateCheckedI, $startI, $endI, $form)
    {

        return $this->render('InterventionBundle:Intervention:liste.html.twig', array(
            'liste' => $liste,
            'typeIntervention' => $typeI,
            'isCheck' => $dateCheckedI,
            'dateStart' => $startI,
            'dateEnd' => $endI,
            'form' => $form->createView()
        ));
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
    public function listeAction(Request $request, $typeI) {

        $form = $this->get('form.factory')->create(RechercheAvanceeType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $typeIntervention = $form->get("typeIntervention")->getData();
            $start = $form->get("start")->getData();
            $end = $form->get("end")->getData();
            $dateChecked = $form->get("date")->getData();
            $request->getSession()->set('startI',$start);
            $request->getSession()->set('endI',$end);
            $request->getSession()->set('dateCheckedI',$dateChecked);
            return $this->redirectToRoute('intervention_list', array('typeI' => $typeIntervention));
        }

        $startI = $request->getSession()->get('startI');
        $endI = $request->getSession()->get('endI');
        $dateCheckedI = $request->getSession()->get('dateCheckedI');
        switch ($typeI) {
            case "plaidoyer":
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->getPlaidoyers($startI, $endI, $dateCheckedI);
                break;
            case "frimousse":
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->getFrimousses($startI, $endI, $dateCheckedI);
                break;
            case "autre":
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->getAutresInterventions($startI, $endI, $dateCheckedI);
                break;
            default:
                $repository = $this->getInterventionRepository();
                $listIntervention = $repository->findAll();
                break;
        }

        return $this->getListeVue($listIntervention, $typeI, $dateCheckedI, $startI, $endI, $form);

    }

    /**
     * @return Response Renvoie vers la page d'attribution d'intervention.
     */
    public function attribueesAction() {

        return $this->render('InterventionBundle:Intervention/Attribuees:liste.html.twig', array(
            'liste' => null
        ));
    }

    public function annulerAction($id) {

        $em = $this - getListeRepository();
        $intervention = $em->find($id);
        $this->getDoctrine()->getManager()->remove($intervention);
        return $this->render('InterventionBundle:Intervention:annulationDemande.html.twig');
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
                $propDest->setValue($destination,$value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }

}
