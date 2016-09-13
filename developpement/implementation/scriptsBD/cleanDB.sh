# version 1.01, date 13/09/2016, auteur Julie Pain
# permet de vider la base de données en supprimant tous les tuplus mais en ne suppriment pas les tables

dbname="bdunicef"
username="unipik"
psql -U $username -W  -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_nettoyer_base.sql
