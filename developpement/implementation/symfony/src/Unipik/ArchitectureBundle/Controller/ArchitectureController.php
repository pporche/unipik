<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
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
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

/**
 * Manage the architecture actions
 *
 * @category None
 * @package  ArchitectureBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
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
            return $this->redirectToRoute('fos_user_security_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Intervention');
        $interventionsNonRealiseesBenevole = $repository->getNInterventionsRealiseesOuNonBenevole($user, false, 2);
        $interventionsRealiseesBenevole = $repository->getNInterventionsRealiseesOuNonBenevole($user, true, 2);
        $interventionsNonRealisees = $repository->getInterventionsRealiseesOuNon(false);
        $interventionsRealisees = $repository->getInterventionsRealiseesOuNon(true);

        return $this->render(
            'ArchitectureBundle::accueilBenevole.html.twig', array(
            'user' => $user,
            'interventionsNonRealiseesBenevole' => $interventionsNonRealiseesBenevole,
            'interventionsRealiseesBenevole' => $interventionsRealiseesBenevole,
            'interventionsNonRealisees' => $interventionsNonRealisees,
            'interventionsRealisees' => $interventionsRealisees
            )
        );
    }

    /**
     * Action no JS
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noJSAction(){
        return $this->render('::noJavascript.html.twig');
    }

    /**
     * Autocomplete du département
     *
     * @param Request $request La requete
     *
     * @return JsonResponse
     */
    public function autocompleteDepartementAction(Request $request) {

        $names = array();
        $term = trim(strip_tags($request->get('term')));
        $term=strtoupper($term);

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArchitectureBundle:Departement')->createQueryBuilder('d')
            ->where('d.nom LIKE :name')
            ->setParameter('name', $term.'%')
            ->orderBy('d.nom', 'ASC')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $names[] = $entity->getNom();
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;
    }

    /**
     * Autocomplete de la ville
     *
     * @param Request $request La requete
     *
     * @return JsonResponse
     */
    public function autocompleteVilleAction(Request $request) {

        $names = array();
        // Récupération de ce qui est tapé
        $term = trim(strip_tags($request->get('term')));
        $term = strtoupper($term);

        // Construction de la requête : on récupère les villes dont le nom commence par ce qui est tapé
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('ArchitectureBundle:Ville')->createQueryBuilder('v')
            ->where('v.nom LIKE :name')
            ->setParameter('name', $term.'%')
            ->orderBy('v.nom', 'ASC');

        $monfichier = fopen('/home/jpain01/Bureau/fichier.txt', 'r+');
        fputs($monfichier, 'coucou : '.trim(strip_tags($request->get('?dep'))));
        fclose($monfichier);
        // Nous testons si un département a été envoyé dans la requête
        if ($request->get('?dep')) {
            // Si oui, nous récupérons le département et ne récupérons seulement les villes situées dans ce département
            $dep = trim(strip_tags($request->get('?dep')));
            $dep = strtoupper($dep);

            $qb
                ->from('ArchitectureBundle:CodePostal','cp')
                ->andWhere('v.codePostal = cp')
                ->andWhere('cp.departement = :dep')
                ->setParameter('dep',$dep)
                ;
        }

        // Récupération des résultats
        $entities = $qb
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $names[] = $entity->getNom();
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;
    }

    /**
     * Autocomplete du code postal
     *
     * @param Request $request La requete
     *
     * @return JsonResponse
     */
    public function autocompleteCodeAction(Request $request) {

        $codes = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('ArchitectureBundle:CodePostal')->createQueryBuilder('c')
            ->where('c.code LIKE :code')
            ->setParameter('code', $term.'%')
            ->orderBy('c.code', 'ASC')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $codes[] = $entity->getCode();
        }

        $response = new JsonResponse();
        $response->setData($codes);

        return $response;
    }

    /**
     * Action code postal
     *
     * @param Request $request La requete
     *
     * @return JsonResponse|Response
     */
    public function codePostalAction(Request $request) {
        if ($request->isXmlHttpRequest()) {

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

    /**
     * Action ville
     *
     * @param Request $request La requete
     *
     * @return JsonResponse|Response
     */
    public function villeAction(Request $request) {
        if ($request->isXmlHttpRequest()) {

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
