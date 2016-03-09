<?php

require_once ('traitement/traitementEtablissement.php');
/**
 * Created by Eclipse.
 * User: Kafui
 * Date: 01/03/16
 * Time: 10:32
 */

$csv = array_map('str_getcsv',file('fichierNettoyer/etablissement.csv'));
$out = fopen('fichierNettoyer/donneeEpureeEtablissement.csv', 'w+');
foreach($csv as $nv_etablissement )
    if(count(array_filter($nv_etablissement))  > 6 && $nv_etablissement[0] !='Ville' && $nv_etablissement[0] != '') {
        traitementEta($nv_etablissement);
        fputcsv($out, $nv_etablissement);
    }
fclose($out);

unlink('fichierNettoyer/etablissement.csv');
?>



