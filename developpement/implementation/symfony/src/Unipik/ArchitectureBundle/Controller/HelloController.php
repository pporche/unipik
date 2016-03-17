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
        $name = new Name();
        $form =  $this->createForm(NameType::class, $name);
        $form->handleRequest($request);

        if($form->isValid())
            return $this->render('ArchitectureBundle:Hello:helloName.html.twig', array('name' => $name));

        $name->setNom("Unicef");
        return $this->render('ArchitectureBundle:Hello:helloNameForm.html.twig', array('name' => $name, 'form' => $form->createView()));
    }

}
