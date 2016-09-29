#!/bin/bash
# version 1.00, date 28/09/2016, auteur Mélissa Bignoux
# permet de vider toutes les tables sauf pays, region, departement, ville


prompt_token() {
  local VAL=""
  while [ "$VAL" = "" ]; do
    echo -n "${2:-$1} : "
    read -s VAL
    if [ "$VAL" = "" ]; then
      echo "Please provide a value"
    fi
  done
  VAL=$(printf '%q' "$VAL")
  eval $1=$VAL
}

#si pas de chemin, on en demande un
if [ "$1" = "" ]; then
    prompt_token 'password'        "Veuillez entrer le mot de passe de la base de données"
else
    password=$1
fi

dbname="bdunicef"
username="unipik"
fichier="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_vider_tables_sauf_donnees_france.sql"
export PGPASSWORD="$password"


psql -U $username -w  -d $dbname  -h 127.0.0.1 -f $fichier

