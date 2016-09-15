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


#insertion d'une ligne dans la bd -> le pays
dbname="bdunicef"
username="unipik"
export PGPASSWORD="$password"

psql -U $username -w  -d $dbname  -h 127.0.0.1 -f "${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_adresses.sql"
psql -U $username -w -d $dbname -h 127.0.0.1 -f "${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_etablissements.sql"