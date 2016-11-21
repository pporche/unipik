<?php
/**
 * Created by PhpStorm.
 * User: mbignoux
 * Date: 19/10/16
 * Time: 11:23
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\InterventionBundle\Entity\Mocks\EtablissementMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ParticipeMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ProjetMock;
use Unipik\UserBundle\Entity\Contact;
use Unipik\UserBundle\Entity\Participe;
use Tests\Unipik\Unit\Utils\EntityTestCase;
use Doctrine\Common\Collections\ArrayCollection;

class ParticipeTest extends  EntityTestCase {
    protected static $repository = "UserBundle:Participe";

    public static function testCreate()
    {
        self::bootKernel();

        $participe = ParticipeMock::create();

        return $participe;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(ArrayCollection $participe) {
        foreach ($participe as $p) {
            $this->assertEquals($participe->getId(), null);

            $contact = ContactMock::create();
            $projet = ProjetMock::create();

            $this->assertEquals($participe->getProjet(), $projet);
            $this->assertEquals($participe->getContact(), $contact);

        }
    }

    public function validEntityProvider() {

        //creation de 4 contacts
        $c = ContactMock::create();

        //creation d'un projet
        $p = ProjetMock::create();

        //ajout d'un projet au contact 1 -> instance de la table participe
        $c->addProjet($p);

        //creation de 2 projets, et les ajouter au contact2
//        $p2 = clone $p;
//        $p3 = clone $p;
//        $c[2]->addProjet($p2);
//        $c[2]->addProjet($p3);



        return [
            "participe" => [$c->getParticipe()]
//            "3 Contacts" => [clone $c[0], clone $c[0], clone $c[0]],
//            "1 contact with 1 projet" => [$p, $c[1]],
//            "1 contact with 3 projets" => [$p2, $p3, $c[2]],
//            "1 Contact with all optional values" => [$c[3]]
        ];
    }

    public function badEntityProvider()
    {
//        $c = ContactMock::createMultiple(9);
//        $longName = str_repeat("a", 101);


        return [
//            "contact with badly formatted email" => [$c[0]->setEmail("invalid.email@")],
//            "Contact with bad type contact" => [$c[1]->setTypeContact("enseignant-chercheur")],
//            "Contact with too long nom" => [$c[2]->setNom($longName)],
//            "Contact with too long prenom" => [$c[3]->setPrenom($longName)],
//            "Contact with badly formatted Tel fixe" => [$c[4]->setTelFixe("02.32.01.02.03")],
//            "Contact with badly formatted Tel portable" => [$c[5]->setTelPortable("06.32.01.02.03")],
        ];
    }

    public function badSetterProvider()
    {
//        $c = ContactMock::createMultiple(3);


        return [
            null
            //"Contact with wrong type estTuteur" => [$c[0]->setEstTuteur("Vrai")],
            //"Contact with est tuteur but without any Projet" => [$c[1]->setEstTuteur(true)],
//            "Contact with wrong typeActivite" => [$c[2]->addTypeActivite("active inexistante")],
        ];
    }
}

