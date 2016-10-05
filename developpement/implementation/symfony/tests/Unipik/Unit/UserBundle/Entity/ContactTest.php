<?php
/**
 * Created by PhpStorm.
 * User: mmartinsbaltar
 * Date: 29/09/16
 * Time: 08:25
 */

namespace Tests\Unipik\Unit\UserBundle\Entity;

use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ContactMock;
use Tests\Unipik\Unit\UserBundle\Entity\Mocks\ProjetMock;
use Unipik\UserBundle\Entity\Contact;
use Tests\Unipik\Unit\Utils\EntityTestCase;

class ContactTest extends  EntityTestCase
{
    protected static $repository = "UserBundle:Contact";

    public static function testCreate()
    {
        self::bootKernel();

        $c = ContactMock::create();

        return $c;
    }

    /**
     * @depends testCreate
     */
    public function testGettersSetters(Contact $c)
    {
        $this->assertEquals($c->getId(), null);
        $this->assertEquals($c->getNom(), "Dupond");
        $this->assertEquals($c->getEmail(), "contact@bigcorp.eu");
        $this->assertEquals($c->getTypeContact(), "enseignant");

        $c->setNom("Dupont")
            ->setEmail("dupont@super-univ.fr")
            ->setTypeContact("etudiant")
            ->setPrenom("Alfred")
            ->setTelFixe("0232010203")
            ->setTelPortable("0601020304")
            ->setTypeActivite("frimousses")
        ;

        $this->assertEquals($c->getNom(),"Dupont");
        $this->assertEquals($c->getEmail(), "dupont@super-univ.fr");
        $this->assertEquals($c->getTypeContact(), "etudiant");
        $this->assertEquals($c->getPrenom(), "Alfred");
        $this->assertEquals($c->getTelFixe(), "0232010203");
        $this->assertEquals($c->getTelPortable(), "0601020304");
        $this->assertEquals($c->getTypeActivite(), "frimousses");

        $c->setEstTuteur(true);
        $this->assertEquals($c->isEstTuteur(), true);
        $c->setEstTuteur(false);
        $this->assertEquals($c->isEstTuteur(), false);

        $c->setRespoEtablissement(true);
        $this->assertEquals($c->isRespoEtablissement(), true);
        $c->setRespoEtablissement(false);
        $this->assertEquals($c->isRespoEtablissement(), false);

        $p = ProjetMock::create();
        $c->addProjet($p);
        $this->assertEquals($c->getProjet()[0], $p);
        $c->removeProjet($p);
        $this->assertEquals($c->getProjet()[0], null);

        $c->addTypeActivite("frimousses");
        $this->assertEquals($c->getTypeActivite()[0], "frimousses");
        $c->removetypeActivite("frimousses");
        $this->assertEquals($c->getTypeActivite()[0], null);

    }

    public function validEntityProvider() {
        $c = ContactMock::createMultiple(4);
        $p = ProjetMock::create();
        $c[1]->addProjet($p);
        $p2 = clone $p;
        $p3 = clone $p;
        $c[2]->addProjet($p2);
        $c[2]->addProjet($p3);

        $c[3]->setNom("Dupont")
            ->setEmail("dupont@super-univ.fr")
            ->setTypeContact("etudiant")
            ->setPrenom("Alfred")
            ->setTelFixe("0232010203")
            ->setTelPortable("0601020304")
            ->addTypeActivite("frimousses")
            ;
        $c[3]->setRespoEtablissement(true);
        $c[3]->setRespoEtablissement(true);

        return [
            "1 Contact" => [$c[0]],
            "3 Contacts" => [clone $c[0], clone $c[0], clone $c[0]],
            "1 contact with 1 projet" => [$p, $c[1]],
            "1 contact with 3 projets" => [$p2, $p3, $c[2]],
            "1 Contact with all optional values" => [$c[3]]
        ];
    }

    public function badEntityProvider()
    {
        $c = ContactMock::createMultiple(9);
        $longName = str_repeat("a", 101);


        return [
            "contact with badly formatted email" => [$c[0]->setEmail("invalid.email@")],
            "Contact with bad type contact" => [$c[1]->setTypeContact("enseignant-chercheur")],
            "Contact with too long nom" => [$c[2]->setNom($longName)],
            "Contact with too long prenom" => [$c[3]->setPrenom($longName)],
            "Contact with badly formatted Tel fixe" => [$c[4]->setTelFixe("02.32.01.02.03")],
            "Contact with badly formatted Tel portable" => [$c[5]->setTelPortable("06.32.01.02.03")],
        ];
    }

    public function badSetterProvider()
    {
        $c = ContactMock::createMultiple(3);


        return [
            //"Contact with wrong type estTuteur" => [$c[0]->setEstTuteur("Vrai")],
            //"Contact with est tuteur but without any Projet" => [$c[1]->setEstTuteur(true)],
            "Contact with wrong typeActivite" => [$c[2]->addTypeActivite("active inexistante")],
        ];
    }
}
