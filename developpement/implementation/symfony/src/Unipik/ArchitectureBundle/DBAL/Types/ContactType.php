<?php

namespace Unipik\ArchitectureBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ContactType extends AbstractEnumType {
    const ENSEIGNANT    = 'enseignant';
    const ANIMATEUR = 'animateur';
    const ELEVE  = 'eleve';
    const ETUDIANT  = 'etudiant';
    const AUTRE = 'autre';

    protected static $choices = [
     self::ENSEIGNANT    => 'enseignant',
     self::ANIMATEUR => 'animateur',
    self::ELEVE  => 'eleve',
    self::ETUDIANT  => 'etudiant',
    self::AUTRE => 'autre'
    ];
}


