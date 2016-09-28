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

if [ -f $fichierAddAdresses ] ; then
    rm $fichierAddAdresses
fi

#Ajout du pays dans la BD
psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO pays (nom) VALUES ('FRANCE');
EOF

psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM pays WHERE nom LIKE 'FRANCE' ;" > logfile.log 
idPays=$(sed '3q;d' < logfile.log )

touch $fichierAddAdresses
#lecture dans un fichier csv 
IFS="," # On définit le séparateur 
while read a b c d e f g h i j k l m n  #c=nom_region, e=numero_departement, f=nom_departement, i=nom_commune, j=code_postaux
do
	
	#pour prendre en compte la première ligne
	if [[ $a != *"EU_circo"* ]];
	then
		#région
		python python/dejaPresent.py "$c" "region"> logfile.log 
		read regionPresente < logfile.log 
		if [[ $regionPresente != *"true"* ]]; 
   		then
   		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO region (nom, pays_id) VALUES ('$c' , '$idPays');"
		fi
		#département
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM region WHERE nom LIKE '$c';" > logfile.log 
		idRegion=$(sed '3q;d' < logfile.log )
		python python/dejaPresent.py "$f" "departement" > logfile.log 
		read departementPresent < logfile.log 
		if [[ $departementPresent != *"true"* ]]; 
   		then
   			psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO departement (nom, numero, region_id) VALUES ('$f' , '$e', '$idRegion');"
		fi
		#codes postaux
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM departement WHERE nom LIKE '$f';" > logfile.log 
		idDepartement=$(sed '3q;d' < logfile.log )
		python python/dejaPresent.py "$j" "code postal"  > logfile.log 
		read codePresent < logfile.log
		echo "$i" 
		if [[ $codePresent != *"true"* ]]; 
   		then
   			psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO code_postal (code, departement_id) VALUES ('$j' , '$idDepartement');"
		fi
		#ville
		python python/dejaPresent.py "$i" "ville" > logfile.log 
		read villePresente < logfile.log 
		echo "$i"
		if [[ $villePresente != *"true"* ]]; 
   		then
   			psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO ville (nom) VALUES ('$i');"
		fi
		#relation ville - code_postaux
		#récupération de l'id du code postal
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM code_postal WHERE code LIKE '$j';" > logfile.log 
		idCodePostal=$(sed '3q;d' < logfile.log )
		#récupération de l'id de la ville
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM ville WHERE nom LIKE '$i';" > logfile.log 
		idVille=$(sed '3q;d' < logfile.log )
		#ajout du tuple dans la table many-to-many
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO ville_code_postal (ville_id, code_postal_id) VALUES ('$idVille', '$idCodePostal');"
	fi
done < ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/ressourcesNettoyees/eucircos_regions_departements_circonscriptions_communes_gps.csv
rm presents.txt

