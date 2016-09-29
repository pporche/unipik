<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 */

namespace Unipik\ArchitectureBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\ArchitectureBundle\Entity\CodePostal;
use Unipik\ArchitectureBundle\Entity\Ville;
use Unipik\ArchitectureBundle\Form\DemandeInterventionType;

/**
 * Manage the architecture actions
 *
 * Class ArchitectureController
 * @package Unipik\ArchitectureBundle\Controller
 */
class ArchitectureController extends Controller {

    /**
     * Render the home page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            return $this->render('ArchitectureBundle::accueilAnonyme.html.twig');
        }

        return $this->render('ArchitectureBundle::accueilBenevole.html.twig', array('user' => $user));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noJSAction(){
        return $this->render('::noJavascript.html.twig');
    }

    public function autocompleteVilleAction(Request $request) {

        $names = array();
        $term = trim(strip_tags($request->get('term')));
        $term=strtoupper($term);

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArchitectureBundle:Ville')->createQueryBuilder('v')
            ->where('v.nom LIKE :name')
            ->setParameter('name', $term.'%')
            ->orderBy('v.nom','ASC')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $names[] = $entity->getNom();
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;
    }

    public function autocompleteCodeAction(Request $request) {

        $codes = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArchitectureBundle:CodePostal')->createQueryBuilder('c')
            ->where('c.code LIKE :code')
            ->setParameter('code', $term.'%')
            ->orderBy('c.code','ASC')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $codes[] = $entity->getCode();
        }

        $response = new JsonResponse();
        $response->setData($codes);

        return $response;
    }

    public function codePostalAction(Request $request) {
        if($request->isXmlHttpRequest()) {

            $nomVille = $request->get('ville');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:Ville');
            $ville = $repository->findOneBy(array('nom' => $nomVille));

            $codePostal = ($ville != "") ? $ville->getCodePostal()[0] : "";

            $code = $codePostal->getCode();

            return new JsonResponse(array('codePostal' => $code));
        }
        return new Response();
    }

    public function villeAction(Request $request) {
        if($request->isXmlHttpRequest()) {

            $code = $request->get('codePostal');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ArchitectureBundle:CodePostal');
            $codePostal = $repository->findOneBy(array('code' => $code));

            $ville = ($codePostal != "") ? $codePostal->getVille()[0] : "";

            $villeNom = $ville->getNom();

            return new JsonResponse(array('ville' => $villeNom));
        }
        return new Response();
    }
}
