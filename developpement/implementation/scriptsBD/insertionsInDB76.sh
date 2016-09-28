# version 1.00, date 14/09/2016, auteur Mélissa Bignoux
# permet de remplir les tables relatives à la region Seine-Maritime (rregion, comite, niveau_theme, comite_niveau_theme)

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

#insertion d'une ligne dans la bd -> le pays
dbname="bdunicef"
username="unipik"
export PGPASSWORD="$password"
fichierAddNiveauTheme="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_niveau_theme.sql"
fichierAddComiteNiveauTheme="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_ajouter_comite_niveau_theme.sql"


psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM departement WHERE nom = 'SEINE-MARITIME';" > id.txt
idSeineMaritime=$(sed '3q;d' < id.txt)
psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM departement WHERE nom = 'EURE';" > id.txt
idEure=$(sed '3q;d' < id.txt)



psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO comite (id) VALUES ('1');
INSERT INTO comite (id) VALUES ('2');
EOF

psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO comite_departement (comite_id, departement_id) VALUES ('1', '$idSeineMaritime');
INSERT INTO comite_departement (comite_id, departement_id) VALUES ('2', '$idEure');
EOF

touch $fichierAddNiveauTheme

list1=( "petite section" "petite-moyenne section" "moyenne section" "moyenne-grande section" "grande section" "petite-moyenne-grande section" "CP" "CP-CE1" "CE1" "CE1-CE2" "CE2" "CE2-CM1" "CM1" "CM1-CM2" "CM2" "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list1[@]}"    
do   
    psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'convention internationale des droits de l enfant');"  
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'education');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'sante et alimentation');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'eau');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'harcelement');" 
done

list2=( "CP" "CP-CE1" "CE1" "CE1-CE2" "CE2" "CE2-CM1" "CM1" "CM1-CM2" "CM2" "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list2[@]}"    
do   
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'sante en generale');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'travail des enfants');" 
done

list3=( "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list3[@]}"    
do   
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'urgences mondiales');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'enfants et soldats');" 
done

list4=( "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list4[@]}"    
do   
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'VIH et sida');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'role de l Unicef');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'millenaire pour le developpement');" 
done

psql -U $username -w  -d $dbname  -h 127.0.0.1 -f $fichierAddNiveauTheme


touch $fichierAddComiteNiveauTheme



psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM niveau_theme WHERE theme = 'convention internationale des droits de l enfant'
																					OR theme = 'education'
																					OR theme = 'sante en generale'
																					OR theme = 'sante et alimentation'
																					OR theme = 'VIH et sida'
																					OR theme = 'urgences mondiales'
																					OR theme = 'travail des enfants'
																					OR theme = 'enfants et soldats'
																					OR theme = 'harcelement'
																					OR theme = 'role de l Unicef'
																					OR theme = 'millenaire pour le developpement'
																					OR theme = 'eau';" > id.txt
continuerBoucle="true"

i=2																			
while [[ $continuerBoucle == "true" ]]
do
	let "i += 1"
	idNiveauTheme=$(sed $i'q;d' < id.txt)

	if [[ $idNiveauTheme != *"rows"* ]];
	then
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO comite_niveau_theme (comite, niveau_theme) VALUES ('1', '$idNiveauTheme');"
	else 
		continuerBoucle="false"
	fi
done

rm "${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/id.txt"