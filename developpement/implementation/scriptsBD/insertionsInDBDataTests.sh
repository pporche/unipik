#version 1.00, date 14/09/2016, auteur Melissa Bignoux
#script pour ajouter les donnees tests dans la base (benevole)

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

if [ "$1" = "" ]; then
    prompt_token 'password'        "Veuillez entrer le mot de passe de la base de données"
else
    password=$1
fi
export PGPASSWORD="$password"
dbname="bdunicef"
username="unipik"
psql -U $username -w -d $dbname  -h 127.0.0.1 -f ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_donnees_test.sql
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
php bin/console fos:user:change-password melissa coucou
