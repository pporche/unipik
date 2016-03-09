<?php

require_once ('traitement/traitementCp.php');
/**
 * Created by Eclipse.
 * User: Kafui
 * Date: 01/03/16
 * Time: 10:32
 */

$csv = array_map('str_getcsv',file('fichierNettoyer/codePostalCommunes.csv'));
$out = fopen('fichierNettoyer/donneeEpureeCp.csv', 'w+');
foreach($csv as $cp) {
    if(count(array_filter($cp))  == 2 && $cp[0] !='') {
	traitementCp($cp);
        fputcsv($out, $cp);
    }
}
fclose($out);
unlink('fichierNettoyer/codePostalCommunes.csv');

?>


