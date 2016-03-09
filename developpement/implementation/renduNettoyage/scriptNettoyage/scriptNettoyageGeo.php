<?php

require_once ('traitement/traitementGeo.php');
/**
 * Created by Eclipse.
 * User: Kafui
 * Date: 01/03/16
 * Time: 10:32
 */

$csv = array_map('str_getcsv',file('fichierNettoyer/geolocalisation.csv'));
$out = fopen('fichierNettoyer/donneeEpureeGeo.csv', 'w+');

foreach($csv as $geo ) {
    if(count(array_filter($geo)) == 5 && $geo[0] != 'UAI') {
        traitementGeo($geo);
        fputcsv($out, $geo);
    }
}
fclose($out);
unlink('fichierNettoyer/geolocalisation.csv');
?>