<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 10:00
 */

namespace Unipik\InterventionBundle\Controller;


//use Unipik\ArchitectureBundle\Repository\PlaidoyerRepository;
use Unipik\ArchitectureBundle\Entity\Plaidoyer;

class PlaidoyerController extends InterventionController
{

    public function getConsultationVue(){
        return $this->render('InterventionBundle:Consultation:consultationPlaidoyer.html.twig');
    }

    public function getListeVue($listePlaidoyers){

        return $this->render('InterventionBundle:Liste:listePlaidoyer.html.twig', array(
            'liste' => $listePlaidoyers
        ));
    }


    public function getListeRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('ArchitectureBundle:Plaidoyer');
    }

}
