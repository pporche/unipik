<?php
/**
 * Created by Eclipse.
 * User: Kafui
 * Date: 01/03/16
 * Time: 10:32
 */
require_once ('traitement/traitementPlaideur.php');

$csv = array_map('str_getcsv',file('fichierNettoyer/plaideurs.csv'));
$out = fopen('fichierNettoyer/donneeEpureePlaideur.csv', 'w+');

foreach($csv as $plaideur ) {
    if(count(array_filter($plaideur))  == 4 && $plaideur[0] != 'Pseudo') {
        traitemeentPlaideur($plaideur);
        fputcsv($out, $plaideur);
    }
}
fclose($out);

unlink('fichierNettoyer/plaideurs.csv');

?>

