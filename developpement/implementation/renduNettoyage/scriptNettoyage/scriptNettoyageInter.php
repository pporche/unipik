<?php

require_once('traitement/traitementInter.php');
/**
 * Created by Eclipse.
 * User: Kafui
 * Date: 01/03/16
 * Time: 10:32
 */

$csv = array_map('str_getcsv',file('fichierNettoyer/interventions.csv'));
$out = fopen('fichierNettoyer/donneeEpureeInter.csv', 'w+');

foreach($csv as $inter ) {
    if(count(array_filter($inter))  > 3 && $inter[0] != 'Date'  ) {
        traitementInter($inter);
        fputcsv($out, $inter);
    }
}
fclose($out);
unlink('fichierNettoyer/interventions.csv');
?>