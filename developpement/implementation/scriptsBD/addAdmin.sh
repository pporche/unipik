#version 1.02, date 12/09/2016, auteur Julie Pain 
#modification pour rendre le script exécutable

#version 1.01, date 11/05/2016, auteur Matthieu Martins-Baltar
#script pour ajouter un administrateur dans la base de donnée


dbname="bdunicef"
username="unipik"
psql -U $username -W  -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_admin.sql
cd ../symfony/
php bin/console fos:user:change-password admin admin






