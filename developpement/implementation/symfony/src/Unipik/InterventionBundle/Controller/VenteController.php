<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 17/11/16
 * Time: 10:26
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
class VenteController extends Controller
{

    public function listeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $listVente = [];
        $venteRepository = $em->getRepository('InterventionBundle:Vente');
        if(!is_null($request->get('intervention'))){
            $interventionRepository= $em->getRepository('InterventionBundle:Intervention');
            $intervention = $interventionRepository->find($request->get('intervention'));
            $listVente = $venteRepository->findBy(array('intervention' => $intervention));
            return new Response("Ici s'affichera une liste de ventes par rapport à l'intervention" . count($listVente));
        }
        else if(!is_null($request->get('etablissement'))){
            $etablissementRepository= $em->getRepository('InterventionBundle:Etablissement');
            $etablissement = $etablissementRepository->find($request->get('etablissement'));
            $listVente = $venteRepository->findBy(array('etablissement' => $etablissement));
            return new Response("Ici s'affichera une liste de ventes par rapport à l'établissement" . count($listVente));
        }
        else
            return new Response("Ici s'affichera une liste de ventes classique");


    }

    public function consultationAction($id){
        $vente = $this->getDoctrine()->getManager()->getRepository("InterventionBundle:Vente")->find($id);

        return $this->render('InterventionBundle:Vente:consultation.html.twig',array('vente' => $vente));
    }

    public function editAction($id){
        return new Response("Ici on pourra modifier la vente ".$id);
    }

    public function addAction(Request $request){
        $vente = new Vente();

        $form = $this->createForm(VenteType::class,$vente);

        if($form->handleRequest($request)->isValid()){
            /*
             * Faire le traitement de sauvegarde  de la vente
             */
            $intervention = $request->get('intervention');
            $etablissement = $request->get('etablissement');

            if(is_null($etablissement) && is_null($etablissement))
                return new Response(" t'as rien rentré pti bout");
            if(is_null($intervention)){
                $etablissement = $this->getDoctrine()->getManager()->getRepository('InterventionBundle:Etablissement')->find($etablissement);
                $vente->setEtablissement($etablissement);
            }else{
                $intervention = $this->getDoctrine()->getManager()->getRepository('InterventionBundle:Intervention')->find($intervention);
                $vente->setIntervention($intervention);
                $vente->setEtablissement($intervention->getEtablissement());
            }
            $this->getDoctrine()->getManager()->persist($vente);
            $this->getDoctrine()->getManager()->flush();
            return new Response("Voili voilou ");
        }

        return $this->render('InterventionBundle:Vente:ajouterVente.html.twig',
            array('form' => $form->createView(),
                )
        );
    }

}

