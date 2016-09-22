#!/bin/bash
#version 1.00, date 22/09/2016, auteur Pierre Porche

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
#si pas de mdp indiqué, demander
if [ "$1" = "" ]; then
    prompt_token 'password'        "Veuillez entrer le mot de passe de la base de données"
else
    password=$1
fi

export PGPASSWORD="$password"

echo "D-d-d-d-drop the base!!"
./dropDB.sh $password
echo "Create DB"
./createDB.sh $password
echo "Ajout admin"
./addAdmin.sh $password
echo "Generate Files"
./generateRequestsFile.sh $password
echo "Insert All"
./insertAll.sh $password
