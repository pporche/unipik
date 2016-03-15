<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 15/03/16
 * Time: 13:56
 */

namespace Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Unipik\ArchitectureBundle\Entity\Name;
use Unipik\ArchitectureBundle\Form\NameType;

class HelloController extends Controller{

    public function helloUnicefAction() {

        return $this->render('ArchitectureBundle:Hello:helloUnicef.html.twig');
    }

    public function helloNameAction(Request $request) {


        $em = $this->getDoctrine()->getManager();
        $nameRepository = $em->getRepository('ArchitectureBundle:Name');
        $name=$nameRepository->find(1);

        $form =  $this->createForm(NameType::class, $name);
        $form->handleRequest($request);

        if($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($name);
            $em->flush();

        }






        $em = $this->getDoctrine()->getManager();
        $nameRepository = $em->getRepository('ArchitectureBundle:Name');
        $name=$nameRepository->find(1);

        if($name == null) {
            $name = new Name();
            $name->setName("Unicef");
        }

        return $this->render('ArchitectureBundle:Hello:helloName.html.twig', array('name' => $name, 'form' => $form->createView()));
    }

    public function helloNameSaveACtion(Request $request){
        $name = $request->request->get('name');

        if($name == null)
            $name = "Unicef";



    }

}