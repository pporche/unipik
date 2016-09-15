#version 1.00, date 14/09/2016, auteur Melissa Bignoux
#script pour ajouter les donnees tests dans la base (benevole)


dbname="bdunicef"
username="unipik"
psql -U $username -W  -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_donnees_test.sql
cd ../symfony/
php bin/console fos:user:change-password kafui coucou
php bin/console fos:user:change-password florian coucou
php bin/console fos:user:change-password mathieu coucou
php bin/console fos:user:change-password francois coucou
php bin/console fos:user:change-password pierre coucou
php bin/console fos:user:change-password sergi coucou
php bin/console fos:user:change-password juliana coucou
php bin/console fos:user:change-password matthieu coucou
php bin/console fos:user:change-password julie coucou
php bin/console fos:user:change-password michel coucou
