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

function insertionBD {
	if [[ $4 == *"Sans nom"* ]]; #si l'établissement n'a pas de nom, on ne donne de valeur à l'attribut nom dans la BD 
	   	then
			if [ -z "$7" ]; #si l'établissement n'a pas de numéro de téléphone (="") on n'entre pas de num de tel dans la BD 
			then 
	    		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO etablissement (uai, adresse_id, emails, $1) VALUES ($2,'$3', '{($5)}', '$6');" 
			else
				python python/retirerEspace.py $f > logfile.log 
				read tel < logfile.log 
	    		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO etablissement (uai, adresse_id, tel_fixe, emails, $1) VALUES ($2, '$3', '$tel', '{($5)}', '$6' );" 
			fi
	  	else 
	  		if [ -z "$f" ];
	  		then 
	  			psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO etablissement (uai, adresse_id, nom, emails, $1) VALUES ($2, '$3', '$4', '{($5)}', '$6');" 
	  		else
	  			python python/retirerEspace.py $f > logfile.log 
				read tel < logfile.log 
	  			psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO etablissement (uai, adresse_id, nom, tel_fixe, emails, $1) VALUES ($2, '$3', '$4', '$tel', '{($5)}', '$6');" 
	  		fi
		fi
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
fichierAddAdresses="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_adresses.sql"
fichierAddEtablissement="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_etablissements.sql"
export PGPASSWORD="$password"


#Supprime les fichiers contenant les requêtes SQL déjà existant

echo "remplissage des adresses dans  la DB pour pouvoir créer le fichier de requeêtes de remplissage des établissements"
psql -U $username -w  -d $dbname  -h 127.0.0.1 -f "${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_adresses.sql"

echo "Remplissage du fichier contenant les requêtes pour remplir la table établissement"
while read a b c d e f g h i 
do
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM ville WHERE ville='$a';" > idVille.txt
	idVille=$(sed '3q;d' < idVille.txt)

	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM adresse WHERE adresse = '$d' AND ville_id='$idVille';" > idAdresse.txt
	idAdresse=$(sed '3q;d' < idAdresse.txt)

	case $c in 
		"Elémentaire"|"Maternelle"|"Collège"|"Lycée"|"Supérieur" )
		if [[ $c = *"Elémentaire"* ]]; 
		then
			typeEnseignement='elementaire'
		fi

		if [[ $c = *"Maternelle"* ]]; 
	    then
	        typeEnseignement="maternelle"
	    fi

	    if [[ $c = *"Collège"* ]]; 
	    then
	        typeEnseignement="college"
	    fi 

	    if [[ $c = *"Lycée"* ]]; 
	    then
	        typeEnseignement="lycee"  
	    fi

	    if [[ $c = *"Supérieur"* ]]; 
	    then
	        typeEnseignement="superieur"  
	    fi
		case $c in
    		'Elémentaire' )
       		typeEnseignement="elementaire" ;;
    		'Maternelle' )
        	typeEnseignement="maternelle" ;;
    		'Collège' )
        	typeEnseignement="college" ;;
    		'Lycée' )
        	typeEnseignement="lycee" ;;
        	'Supérieur' )
        	typeEnseignement="superieur" ;;
		esac

    
		insertionBD "type_enseignement" "'$h'" $idAdresse $b $g $typeEnseignement $f
		;;
		"Autre" )
		insertionBD "type_autre_etablissement" "NULL" $idAdresse $b $g "autre" $f
		;;
	esac

done < ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/ressourcesNettoyees/etablissement.csv

echo "Fichier contenant les requêtes pour remplir la table établissement rempli"

while read a b c d e f g h i 
do
	if [[ $a != *"UAI"* ]];
	then
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT adresse_id FROM etablissement WHERE uai='$a';" > idAdresse.txt
		idAdresse=$(sed '3q;d' < idAdresse.txt)

		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "UPDATE adresse SET geolocalisation=ST_GeographyFromText('SRID=4326;POINT($d.$e $b.$c)') WHERE id=$idAdresse;" 
	fi



done < ${UNIPIKGENPATH}/pic_unicef/developpement/implementation/ressourcesNettoyees/etablissement.csv

echo "Fichier contenant les requêtes pour remplir la table établissement rempli"

rm idVille.txt
rm idAdresse.txt
rm logfile.log 


