<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 10:00
 */

namespace Unipik\InterventionBundle\Controller;


//use Unipik\ArchitectureBundle\Repository\PlaidoyerRepository;
use Symfony\Component\HttpFoundation\Response;
use Unipik\ArchitectureBundle\Entity\Plaidoyer;

class PlaidoyerController extends InterventionController
{

    /**
     * @return Response Renvoie vers la vue de consultation liée au plaidoyer.
     */
    public function getConsultationVue(){
        return $this->render('InterventionBundle:Intervention/Plaidoyer:consultation.html.twig');
    }

    /**
     * @param $listePlaidoyers array de l'établissement souhaitant réaliser une demande.
     * @return Response Renvoie vers la page permettant l'affichage de l'ensemble des interventions de type plaidoyers.
     */
    public function getListeVue($listePlaidoyers){

        return $this->render('InterventionBundle:Intervention/Plaidoyer:liste.html.twig', array(
            'liste' => $listePlaidoyers
        ));
    }


    /**
     * @return RepositoryFactory Renvoie le repository Plaidoyer.
     */
    public function getListeRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ArchitectureBundle:Plaidoyer');
    }

}
