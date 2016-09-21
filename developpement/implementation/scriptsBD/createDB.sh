#!/bin/bash
# version 1.01, date 12/09/2016, auteur Julie Pain
# permet de créer la base de données bdunicef ainsi que l'utilisateur unipik

#fonction pour demander une entrée utilisateur
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

#si pas de mot de passe indiqué, en demander un
if [ -n "$1" ]; then
    password=$1
elif [ -n "${DB_PASSWORD}" ]; then
    password=$DB_PASSWORD
else
    prompt_token 'password'
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


sudo -i -u postgres psql -U postgres << EOF
CREATE DATABASE "$dbname";
CREATE USER "$username" WITH PASSWORD '$password';
ALTER ROLE unipik SUPERUSER;
EOF
psql -U "$username"  -d "$dbname"  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_creation_tables.sql
