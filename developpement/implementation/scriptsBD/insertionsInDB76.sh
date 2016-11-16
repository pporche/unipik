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



psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM departement WHERE nom = 'SEINE-MARITIME';" > id.txt
idSeineMaritime=$(sed '3q;d' < id.txt)
psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM departement WHERE nom = 'EURE';" > id.txt
idEure=$(sed '3q;d' < id.txt)



psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
ALTER SEQUENCE comite_id_seq RESTART WITH 1;
INSERT INTO comite (id, nom) VALUES ('1', 'Comité de Seine-Maritime');
INSERT INTO comite (id, nom) VALUES ('2', 'Comité de l''Eure');
EOF

psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO comite_departement (comite_id, departement_id) VALUES ('1', '$idSeineMaritime');
INSERT INTO comite_departement (comite_id, departement_id) VALUES ('2', '$idEure');
EOF

psql -U $username -w -d $dbname  -h 127.0.0.1 -c "ALTER SEQUENCE niveau_theme_id_seq RESTART WITH 1;"

list0=( "petite section" "petite-moyenne section" "moyenne section" "moyenne-grande section" "grande section" "petite-moyenne-grande section")
for element in "${list0[@]}"    
do   
    psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits');"  
	
done

list1=( "petite section" "petite-moyenne section" "moyenne section" "moyenne-grande section" "grande section" "petite-moyenne-grande section" "CP" "CP-CE1" "CE1" "CE1-CE2" "CE2" "CE2-CM1" "CM1" "CM1-CM2" "CM2" "6eme" "5eme" "4eme" "3eme" "2nde" "1ere" "terminale" "L1" "L2" "L3" "M1" "M2" "autre")   
for element in "${list1[@]}"    
do   
    psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits - Education');"  
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Institution - Role de l Unicef');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Sante');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Sante - Alimentation');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Sante - Eau');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits - CIDE');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits - Enfants soldats');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits - Travail des enfants');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits - Harcelement-Violence');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Droits - Discriminations');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Institution - Millenaire pour le developpement');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Sante - VIH-Sida');" 
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO niveau_theme (niveau, theme) VALUES ('$element', 'Urgences');" 
done





psql -U $username -w -d $dbname  -h 127.0.0.1 -c "SELECT id FROM niveau_theme WHERE theme = 'Droits'
																					OR theme = 'Droits - Education'
																					OR theme = 'Institution - Role de l Unicef'
																					OR theme = 'Sante'
																					OR theme = 'Sante - Alimentation'
																					OR theme = 'Sante - Eau'
																					OR theme = 'Droits - CIDE'
																					OR theme = 'Droits - Enfants soldats'
																					OR theme = 'Droits - Travail des enfants'
																					OR theme = 'Droits - Harcelement-Violence'
																					OR theme = 'Droits - Discriminations'
																					OR theme = 'Institution - Millenaire pour le developpement'
																					OR theme = 'Sante - VIH-Sida'
																					OR theme = 'Urgences';" > id.txt
continuerBoucle="true"

i=2																			
while [[ $continuerBoucle == "true" ]]
do
	let "i += 1"
	idNiveauTheme=$(sed $i'q;d' < id.txt)

	if [[ $idNiveauTheme != *"rows"* && $idNiveauTheme != *"ligne"* ]];
	then
		psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO comite_niveau_theme (comite, niveau_theme) VALUES ('1', '$idNiveauTheme');"
	else 
		continuerBoucle="false"
	fi
done

#Insertion moments hebdomadaires
psql -U $username -w -d $dbname  -h 127.0.0.1 -c "ALTER SEQUENCE moment_hebdomadaire_id_seq RESTART WITH 1;" 
listJour=( "lundi" "mardi" "mercredi" "jeudi" "vendredi" "samedi")   
for jour in "${listJour[@]}"    
do   
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO moment_hebdomadaire (jour, moment) VALUES ('$jour', 'matin');"
	psql -U $username -w -d $dbname  -h 127.0.0.1 -c "INSERT INTO moment_hebdomadaire (jour, moment) VALUES ('$jour', 'apres-midi');"
done

rm "${UNIPIKGENPATH}/pic_unicef/developpement/implementation/scriptsBD/id.txt"