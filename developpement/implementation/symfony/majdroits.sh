#version 1.01, date 11/05/2016, auteur Matthieu Martins-Baltar
#script pour rectifier les droits sur les fichiers du projet

#On utilise la variable $USER pour définir les droits
#Il est donc important de vérifier que le script n'est pas exécuté en mode root!
if [ "$USER" == "root" ]
then
    echo "Attention ! Vous etes en root !"
else
    sudo chmod 755 -R ./
    sudo chown $USER -R ./
    sudo chgrp $USER -R ./
    sudo chmod 777 -R var/logs/
    sudo chmod 777 -R var/cache/
    sudo chmod 777 -R var/sessions/
    sudo chmod +x *.sh
    sudo chown www-data -R var/sessions/
fi
