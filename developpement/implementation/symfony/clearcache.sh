#version 1.01, date 11/05/2016, auteur Matthieu Martins-Baltar
#script pour vider le cache symphony

#cette commande modifie les droits sur les fichiers, il est donc nécessaire de les rectifier ensuite
sudo php bin/console cache:clear

bash majdroits.sh
