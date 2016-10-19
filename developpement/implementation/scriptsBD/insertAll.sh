# version 1.00, date 14/09/2016, auteur Mélissa Bignoux
# permet de creer l'admin et remplir les tables adresses, etablissement, les donnees relatives à l'unicef 76 et les donnees de test apres avoir fait ./insertionInDBDonneesFrance

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

echo "insertion adresses"
./insertionsInDBAdresse.sh $password

echo "insertion admin"
./addAdmin.sh $password

echo "insertion établissements et modification des adresses (ajout de la géolocalisation)"
./insertionsInDBEtablissement.sh $password

echo "insertions relatives à unicef 76"
./insertionsInDB76.sh $password

echo "insertions données tests"
./insertionsInDBDataTests.sh $password
