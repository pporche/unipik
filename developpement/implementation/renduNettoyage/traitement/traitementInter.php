<?php
// version 1.00 date 24/02/2016 auteur(s) Kafui Atanley 
function traitementInter(&$inter) {
    $classe = &$inter[3];
    traitementClasse($classe);
    $materiel = &$inter[8];
    traitementMateriel($materiel);
}

function traitementClasse(&$classe) {
    switch($classe) {
        case !empty(mb_stripos($classe,'PS/MS')) :
            $classe = 'petiteMoyenneSection';
            break;
        case !empty(mb_stripos($classe,'MS/GS')) :
            $classe = 'moyenneGrandeSection';
            break;
        case !empty(mb_stripos($classe,'CP-CE1')) :
            $classe = 'CPCE1';
            break;
        case !empty(mb_stripos($classe,'CE1-CE2')) :
            $classe = 'CE1CE2';
            break;
        case !empty(mb_stripos($classe,'CE2-CM1')) :
            $classe = 'CE2CM1';
            break;
        case !empty(mb_stripos($classe,'CM1-CM2')) :
            $classe = 'CM1CM2';
            break;
        case !empty(mb_stripos($classe,'PS')) :
            $classe = 'PS';
            break;
        case !empty(mb_stripos($classe,'MS')) :
            $classe = 'MS';
            break;
        case !empty(mb_stripos($classe,'GS')) :
            $classe = 'GS';
            break;
        case !empty(mb_stripos($classe,'CP')) :
            $classe = 'CP';
            break;
        case !empty(mb_stripos($classe,'CE1')) :
            $classe = 'CE1';
            break;
        case !empty(mb_stripos($classe,'CE2')) :
            $classe = 'CE2';
            break;
        case !empty(mb_stripos($classe,'CM1')) :
            $classe = 'CM1';
            break;
        case !empty(mb_stripos($classe,'CM2')) :
            $classe = 'CM2';
            break;
        case !empty(mb_stripos($classe,'6ème')) :
            $classe = '6eme';
            break;
        case !empty(mb_stripos($classe,'5ème')) :
            $classe = '5eme';
            break;
        case !empty(mb_stripos($classe,'4ème')) :
            $classe = '4eme';
            break;
        case !empty(mb_stripos($classe,'3ème')) :
            $classe = '3eme';
            break;
        case !empty(mb_stripos($classe,'CLIS')) :
            $classe = 'CLIS';
            break;
    }
}

function traitementMateriel(&$materiel) {
    $remplacement ='';
    if(!empty(preg_match("/audio/i",$materiel)))
        $remplacement = $remplacement . 'Audio-';
    if(!empty(preg_match("/vidéo/i",$materiel)))
        $remplacement = $remplacement . 'Video-';
    if(!empty(preg_match("/TBI/i",$materiel)))
        $remplacement =  $remplacement . 'TBI-';
    if($remplacement == '')
        $remplacement = 'Rien-';
    $materiel = substr($remplacement,0,strlen($remplacement)-1) ;
}

?>























}
