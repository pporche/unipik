<?php
/**
 * Created by PhpStorm.
 * User: mbignoux
 * Date: 19/10/16
 * Time: 11:11
 */
namespace Tests\Unipik\Unit\UserBundle\Entity\Mocks;

use Tests\Unipik\Unit\Utils\EntityMock;
use Unipik\UserBundle\Entity\Participe;

class ParticipeMock extends EntityMock
{

    /**
     * @return Participe
     */
    public static function create()
    {

        $contact = ContactMock::create();
        $projet = ProjetMock::create();

        $contact->addProjet($projet);

        return $contact->getParticipe();
    }

    /**
     * @param $nb
     * @return Participe[]
     */
    public static function createMultiple($nb)
    {
        return parent::createMultiple($nb);
    }
}
