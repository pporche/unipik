# version 1.01, date 29/09/2016, auteur Mélissa Bignoux
# adaptation avec la nouvelle base

# version 1.00, date 14/09/2016, auteur Mélissa Bignoux
# remplit la table adresse

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
fichierAddAdresses="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_adresses.sql"
export PGPASSWORD="$password"

psql -U $username -w -d $dbname  -h 127.0.0.1 -c "ALTER SEQUENCE adresse_id_seq RESTART WITH 1;"

IFS="," # On définit le séparateur 
while read a b c d e 
do	
	#adresse
	python3 python/adresseDejaPresente.py "$d" "$a" > logfile.log 
	read adresseDejaPresente < logfile.log 
	if [[ $adresseDejaPresente != *"true"* ]]; 
   	then
   		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM ville WHERE nom LIKE '$a';" > logfile.log 
		  idVille=$(sed '3q;d' < logfile.log )

      python3 python/associerCodePostalVille.py $a > logfile.log #associerCodePostalVille.py va chercher le code postale de la ville en fonction de la ville dans un autre fichier csv, on met le résultat dans le fichier temporaire logfile.file
      read codePostal < logfile.log #On met le résultat contenu dans le fichier temp dans une variable codePostal

      psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM code_postal WHERE code LIKE '$codePostal';" > logfile.log 
      idCodePostal=$(sed '3q;d' < logfile.log )
	    psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO adresse (adresse, ville_id, code_postal_id) VALUES ('$d' , '$idVille', '$idCodePostal');" 
	fi
done < ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/ressourcesNettoyees/etablissement.csv
rm "${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/presents.txt"

