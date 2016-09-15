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

#si pas de chemin, on en demande un
if [ "$1" = "" ]; then
    prompt_token 'password'        "Veuillez entrer le mot de passe de la base de données"
else
    password=$1
fi



dbname="bdunicef"
username="unipik"
sudo -i -u postgres psql -U postgres << EOF
CREATE DATABASE bdunicef;
CREATE USER unipik WITH PASSWORD '$password';
EOF
psql -U $username -W  -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_creation_tables.sql
