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
fichierAddNiveauTheme="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_add_niveau_theme.sql"
fichierAddComiteNiveauTheme="${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/sql/DB_add_comite_niveau_theme.sql"

if [ -f $fichierAddNiveauTheme ] ; then
    rm $fichierAddNiveauTheme
fi

if [ -f $fichierAddComiteNiveauTheme ] ; then
    rm $fichierAddComiteNiveauTheme
fi

psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM pays WHERE nom = 'FRANCE';" > id.txt
idAdresse=$(sed '3q;d' < id.txt)

psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO region (nom, pays_id) VALUES ('Normandie', '$idAdresse');
EOF

psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM region WHERE nom = 'Normandie';" > id.txt
idRegion=$(sed '3q;d' < id.txt)

psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO comite (region_id, nom_departement) VALUES ('$idRegion', 'Seine-Maritime');
INSERT INTO comite (region_id, nom_departement) VALUES ('$idRegion', 'Eure');
INSERT INTO comite (region_id, nom_departement) VALUES ('$idRegion', 'Calvados');
INSERT INTO comite (region_id, nom_departement) VALUES ('$idRegion', 'Manche');
INSERT INTO comite (region_id, nom_departement) VALUES ('$idRegion', 'Orne');
EOF

touch $fichierAddNiveauTheme

list1=( "petite section" "petite-moyenne section" "moyenne section" "moyenne-grande section" "grande section" "petite-moyenne-grande section" "CP" "CP-CE1" "CE1" "CE1-CE2" "CE2" "CE2-CM1" "CM1" "CM1-CM2" "CM2" "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list1[@]}"    
do   
    echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'convention internationale des droits de l enfant');" >> $fichierAddNiveauTheme 
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'education');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'sante et alimentation');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'eau');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'harcelement');" >> $fichierAddNiveauTheme
done

list2=( "CP" "CP-CE1" "CE1" "CE1-CE2" "CE2" "CE2-CM1" "CM1" "CM1-CM2" "CM2" "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list2[@]}"    
do   
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'sante en generale');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'travail des enfants');" >> $fichierAddNiveauTheme
done

list3=( "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list3[@]}"    
do   
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'urgences mondiales');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'enfants et soldats');" >> $fichierAddNiveauTheme
done

list4=( "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list4[@]}"    
do   
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'VIH et sida');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'role de l Unicef');" >> $fichierAddNiveauTheme
	echo "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'millenaire pour le developpement');" >> $fichierAddNiveauTheme
done

psql -U $username -w  -d $dbname  -h 127.0.0.1 -f $fichierAddNiveauTheme

psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM comite WHERE nom_departement = 'Seine-Maritime';" > id.txt
idComite=$(sed '3q;d' < id.txt)

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
		echo "$idNiveauTheme coucou" >> test.txt
		echo "INSERT INTO comite_niveau_theme (comite, niveau_theme) VALUES ('$idComite', '$idNiveauTheme');" >> $fichierAddComiteNiveauTheme
	else 
		continuerBoucle="false"
	fi
done


psql -U $username -w  -d $dbname  -h 127.0.0.1 -f $fichierAddComiteNiveauTheme

rm id.txt