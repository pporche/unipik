# version 1.01, date 12/09/2016, auteur Julie Pain
# permet de supprimer la base de données bdunicef ainsi que l'utilisateur unipik 

sudo -i -u postgres psql -U postgres -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_suppression_base.sql
sudo -i -u postgres << EOF
dropuser unipik;
EOF

