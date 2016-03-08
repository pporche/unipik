<?php

namespace Unipik\ArchitectureBundle\Controller;

use Doctrine\DBAL\Types\StringType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Unipik\ArchitectureBundle\Entity\Volunteer;

class VolunteerController extends Controller {

    public function indexAction(Request $request) {
        return $this->render('ArchitectureBundle:Volunteer:index.html.twig');
    }

    public function addAction() {

        //Création d'un objet Volunteer (Un bénévole)
        $volunteer = new Volunteer();

        $formBuilder = $this->createFormBuilder($volunteer)
            ->add('prenom', StringType::class)
            ->add('nom', 'text')
            ->add('telFixe', 'text')
            ->add('telPortable', 'text')
            ->add('email', 'text')
        ;

        $form = $formBuilder->getForm();

        return $this->render('ArchitectureBundle:Volunteer:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
