<?php
/**
 * Created by Eclipse.
 * User: Kafui
 * Date: 01/03/16
 * Time: 10:32
 */
require_once ('traitement/traitementTheme.php');

$csv = array_map('str_getcsv',file('fichierNettoyer/themes.csv'));
$out = fopen('fichierNettoyer/donneeEpureeThemes.csv', 'w+');

foreach($csv as $theme )
    if(count(array_filter($theme))  == 1 && $theme[0] != 'Thèmes des interventions lors des Plaidoyers') {
        traitementTheme($theme);
        fputcsv($out, $theme);
    }
fclose($out);

unlink('fichierNettoyer/themes.csv');
?>
