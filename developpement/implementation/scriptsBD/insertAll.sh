# version 1.00, date 14/09/2016, auteur Mélissa Bignoux
# permet de remplir les tables adresses et établissement


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

echo "insertion adresses et établiemments"
./insertionsInDBEtablissement.sh $password

echo "insertions relatives à unicef 76"
./insertionsInDB76.sh $password

echo "insertions données tests"
./insertionsInDBDataTests.sh $password
