<?php 

namespace CoreBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ActiviteType extends AbstractEnumType {
    const ACTPONCTUELLE    = 'actions ponctuelles';
    const PLAIDOYER = 'plaidoyers';
    const FRIMOUSSE  = 'frimousses';
    const PROJET  = 'projets';
    const AUTRE = 'autre';

    protected static $choices = [
     self::ACTPONCTUELLE    => 'actions ponctuelles',
     self::PLAIDOYER => 'plaidoyers',
    self::FRIMOUSSE  => 'frimousses',
    self::PROJET  => 'projets',
    self::AUTRE => 'autre'
    ];
}


