<?php
// version 1.00 date 24/02/2016 auteur(s) Kafui Atanley 
// Ce script appelera tout les autres pour déléguer le travail.
if(file_exists('fichierNettoyer/codePostalCommunes.csv'))
require_once('scriptNettoyage/scriptNettoyageCp.php');
else echo "fichier de code postale non trouvé\n";

if(file_exists('fichierNettoyer/etablissement.csv'))
require_once ('scriptNettoyage/scriptNettoyageEtablissement.php');
else echo "fichier d'établissement non trouvé\n";

if(file_exists('fichierNettoyer/geolocalisation.csv'))
require_once ('scriptNettoyage/scriptNettoyageGeo.php');
else echo "fichier de geolocalisation non trouvé\n";

if(file_exists('fichierNettoyer/interventions.csv'))
require_once ('scriptNettoyage/scriptNettoyageInter.php');
else echo "fichier d'Intervention non trouvé\n";

if(file_exists('fichierNettoyer/plaideurs.csv'))
require_once ('scriptNettoyage/scriptNettoyagePlaideur.php');
else echo "fichier de plaideurs non trouvé\n";

if(file_exists('fichierNettoyer/themes.csv'))
require_once ('scriptNettoyage/scriptNettoyageTheme.php');
else echo "fichier de themes non trouvé\n";

/* Améliorations possibles : signaler les lignes qui posent problème pour chaque fichier
Donner la possibilité de rentrer des noms différents  */

?>

