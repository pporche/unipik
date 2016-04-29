<?php 

namespace CoreBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ThemeType extends AbstractEnumType {
    const CONVINTER = 'convention internationale des droits de l enfant';
    const EDUCATION = 'education';
    const SANTEG = 'sante en general';
    const SANTEALM = 'sante et alimentation';
    const VIHSIDA = 'VIH et sida';
    const EAU = 'eau';
    const URGMND = 'urgences mondiales';
    const TRVENFANT = 'travail des enfants';
    const ENFSLD = 'enfants soldats';
    const HARCELEMENT = 'harcelement';
    const ROLUNICEF = 'role de l Unicef';
    const MILDVT = 'millenaire pour le developpement';
    
    protected static $choices = [
     self::CONVINTER => 'convention internationale des droits de l enfant',
     self::EDUCATION => 'education',
     self::SANTEG => 'sante en general',
     self::SANTEALM => 'sante et alimentation',
     self::VIHSIDA => 'VIH et sida',
     self::EAU => 'eau',
     self::URGMND => 'urgences mondiales',
     self::TRVENFANT => 'travail des enfants',
     self::ENFSLD => 'enfants soldats',
     self::HARCELEMENT => 'harcelement',
     self::ROLUNICEF => 'role de l Unicef',
     self::MILDVT => 'millenaire pour le développement'
    ];
}


