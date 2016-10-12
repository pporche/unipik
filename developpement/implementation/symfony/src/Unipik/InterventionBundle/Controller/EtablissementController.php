<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 04/05/16
 * Time: 09:48
 */

namespace Unipik\InterventionBundle\Controller;


use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unipik\InterventionBundle\Entity\Etablissement;
use Unipik\InterventionBundle\Form\EtablissementType;
use Unipik\InterventionBundle\Form\Etablissement\RechercheAvanceeType;
use Unipik\ArchitectureBundle\Utils\ArrayConverter;

class EtablissementController extends Controller {

    /**
     * @param $id integer Id de l'établissement souhaitant réaliser une demande.
     * @return Response Renvoie vers la page de consultation liée à l'établissement.
     */
    public function consultationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('InterventionBundle:Etablissement');
        $etablissement = $repository->find($id);
        return $this->render('InterventionBundle:Etablissement:consultation.html.twig',array('etablissement' => $etablissement));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request) {
        $institute = new Etablissement();
        $form = $this->get('form.factory')->create(EtablissementType::class, $institute)->remove('etablissement_typeEnseignement_placeholder');

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($institute);
            $em->flush();

            return $this->redirectToRoute('etablissement_view', array('id' => $institute->getId()));
        }

        return $this->render('InterventionBundle:Etablissement:ajouterEtablissement.html.twig', array('form' => $form->createView()));
    }

    public function deleteEtablissementAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $institute = $this->getEtablissementRepository()->findOneBy(array('id' => $id));
        $em->remove($institute);
        $em->flush();

        return $this->redirectToRoute('etablissement_list');
    }

    public function deleteEtablissementsAction(Request $request) {
        if($request->isXmlHttpRequest()) {
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
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Unipik\InterventionBundle\Entity\EtablissementRepository
     */
    public function getEtablissementRepository(){
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('InterventionBundle:Etablissement');
    }

    /**
     * @return Response Renvoie vers la page affichant la liste des données des établissements.
     */
    public function listeAction(Request $request) {
        $formBuilder = $this->get('form.factory')->createBuilder(RechercheAvanceeType::class)->setMethod('GET'); // Creation du formulaire en GET
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        $typeEtablissement = $form->get("typeEtablissement")->getData();
        $ville = $form->get("ville")->getData();
        $typeEnseignement = $form->get("typeEnseignement")->getData();
        $typeCentre = $form->get("typeCentre")->getData();
        $typeAutre = $form->get("typeAutreEtablissement")->getData();

        $rowsPerPage = $request->get("rowsPerPage", 10);
        $field = $request->get("field", "nom");
        $desc = $request->get("desc", false);

        $repository = $this->getEtablissementRepository();

        $listEtablissement = $repository->getType($typeEtablissement, $typeEnseignement, $typeCentre, $typeAutre, $ville, $field, $desc);

        return $this->render('InterventionBundle:Etablissement:liste.html.twig', array(
            'field' => $field,
            'desc' => $desc,
            'rowsPerPage' => $rowsPerPage,
            'liste' => $listEtablissement,
            'typeEtablissement' => $typeEtablissement,
            'form' => $form->createView()
        ));
    }

    /**
     * @return mixed
     */
    public function editAction(Request $request, $id) {
        $institute = $this->getEtablissementRepository()
            ->findOneBy(array('id' => $id));

        $form = $this->get('form.factory')
            ->createBuilder(EtablissementType::class, $institute)
            ->add('Valider', SubmitType::class)
            ->getForm();

        if ($form->handleRequest($request)->isValid() && $request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $institute->removeAllEmails();

            $emails = $form->get("emails")->getData();
            foreach ($emails as $email) {
                $institute->addEmail($email);
            }

            $em->persist($institute);
            $em->flush();

            return $this->redirectToRoute('etablissement_view', array('id' => $id));
        }

        $emails = json_encode($institute->getEmails()->toArray());
        return $this->render('InterventionBundle:Etablissement:editEtablissement.html.twig', array('form' => $form->createView(),
                                                                                   'etablissement' => $institute,
                                                                                   'emails' => $emails,
        ));
    }
}
