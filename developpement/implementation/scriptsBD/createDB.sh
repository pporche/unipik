# version 1.01, date 12/09/2016, auteur Julie Pain

dbname="bdunicef"
username="unipik"
sudo -i -u postgres psql -U postgres -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_creation_base.sql
psql -U $username -W  -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_creation_tables.sql
