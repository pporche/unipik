#!/bin/bash
#version 1.02, date 14/09/2016, auteur Matthieu Martins-Baltar
#ajouté un paramètre de scripts pour choisir un mode passe personnalisé (utilisé par jenkins)


#version 1.02, date 12/09/2016, auteur Julie Pain 
#modification pour rendre le script exécutable

#version 1.01, date 11/05/2016, auteur Matthieu Martins-Baltar
#script pour ajouter un administrateur dans la base de donnée

#si pas de mot de passe indiqué pour le nouvel admin, choisir "admin"
if [ -n "$1" ]; then
    password=$1
elif [ -n "${SYMFONY_ADMIN_PASSWORD}" ]; then
    password=$SYMFONY_ADMIN_PASSWORD
else
    password="admin"
    echo "Attention, utilisation du mot de passe par défaut!! (admin)"
    echo "pour choisir un mot de passe différent, indiquez le comme ceci: $0 password"
fi

#si pas de nom d'utilisateur psql indiqué, choisir "unipik"
if [ -n "$2" ]; then
    username=$2
elif [ -n "${DB_USERNAME}" ]; then
    username=$DB_USERNAME
else
    username="unipik"
fi

#si pas de DB indiqué, choisir "bdunicef"
if [ -n "$3" ]; then
    dbname=$3
elif [ -n "${DB_DBNAME}" ]; then
    dbname=$DB_DBNAME
else
    dbname="bdunicef"
fi

psql -U $username -W  -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_admin.sql
cd ../symfony/
php bin/console fos:user:change-password admin $password
