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

psql -U $username -w  -d $dbname  -h 127.0.0.1 << EOF
INSERT INTO pays(nom) VALUES ('FRANCE');
INSERT INTO region(nom, pays_id) VALUES ('NORMANDIE', '1');
INSERT INTO departement(nom, numero, region_id) VALUES ('SEINE-MARITIME', '76', '1');
INSERT INTO code_postal(code, departement_id) VALUES ('76600', '1');
INSERT INTO ville(nom) VALUES ('LE HAVRE');
INSERT INTO ville_code_postal(ville_id, code_postal_id ) VALUES ('1','1');
INSERT INTO adresse(adresse, ville_id, code_postal_id ) VALUES ('adresse', '1','1');

INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite) VALUES ('kafui', 'kafui', 'kafui@kafui.kafui', 'kafui@kafui.kafui', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'kafui','atanley','0235111111','0611111111',1, '{(plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite) VALUES ('florian', 'florian', 'florian@florian.florian', 'florian@florian.florian', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'leriche','florian',NULL,'0622222222',1 , '{(frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite) VALUES ('mathieu', 'mathieu', 'mathieu@mathieu.mathieu', 'mathieu@mathieu.mathieu', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'medici', 'mathieu','0235333333',NULL,1, '{(actions_ponctuelles)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite) VALUES ('francois', 'francois', 'francois@francois.francois', 'francois@francois.francois', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'decq','francois',NULL,NULL,1, '{(projets)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite, activites_potentielles) VALUES ('pierre', 'pierre', 'pierre@pierre.pierre', 'pierre@pierre.pierre', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'porche', 'pierre','0235444444','0644444444',1, '{(plaidoyers)}', '{(plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite, activites_potentielles) VALUES ('sergi', 'sergi', 'sergi@sergi.sergi', 'sergi@sergi.sergi', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'colomies','sergi','0235555555','0655555555',1, '{(plaidoyers)}', '{(frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('juliana', 'juliana', 'juliana@juliana.juliana', 'juliana@juliana.juliana', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'rossi','juliana',NULL,NULL,1, '{(plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('matthieu', 'matthieu', 'matthieu@matthieu.matthieu', 'matthieu@matthieu.matthieu', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'martins-baltar', 'matthieu',NULL,NULL,1, '{(frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite) VALUES ('michel', 'michel', 'michel@michel.michel', 'michel@michel.michel', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'cressant', 'michel','0235555555','0655555555',1, '{(plaidoyers), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, responsabilite_activite, activites_potentielles) VALUES ('julie', 'julie', 'julie@julie.julie', 'julie@julie.julie', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'pain','julie','0235555555','0655555555',1,'{(actions_ponctuelles), (projets)}', '{(frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id) VALUES ('melissa', 'melissa', 'melissa@melissa.melissa', 'melissa@melissa.melissa', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'bignoux','melissa','0235490983','0647282552',1 );

INSERT INTO comite (nom) VALUES ('comite1');

INSERT INTO comite_departement (comite_id, departement_id) VALUES ('1', '1');

  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('1', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('2', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('3', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('4', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('5', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('6', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('7', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('8', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('9', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('10', '1');
  INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('11', '1');

  INSERT INTO etablissement (uai, adresse_id, emails) VALUES ('123456','1', '{(etablissement@orange.fr)}');

  INSERT INTO contact (email, nom, prenom, tel_fixe, type_contact, type_activite) VALUES ('contact1@contact.fr', 'nom1', 'prenom1', '0235490983', 'enseignant', '{(plaidoyers)}');
  INSERT INTO appartient (etablissement_id, contact_id) VALUES ('1', '1');
  INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('1', '2016-12-05',  '2017-01-05', '2017-02-05');
    INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('1', '2016-12-05',  '2015-01-05', '2017-02-05');
        INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('1', '2016-12-05',  '2017-02-05', '2017-01-05');



  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '1', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '1', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '1', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '2', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '2', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '2', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '3', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '3', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '3', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
  INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '4', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');

  INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES ('1', '1', 0, '30/01/2016');
  INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES ('1', 0, '30/01/2016');

  INSERT INTO projet (chiffre_affaire, remarques, type_projet, nom) VALUES (0, 'rq', 'primaire', 'nom du projet de kafui');
  INSERT INTO projet (chiffre_affaire, remarques, type_projet, nom) VALUES (0, 'rq', 'primaire', 'nom du projet de mathieu');
  INSERT INTO projet (chiffre_affaire, remarques, type_projet, nom) VALUES (0, 'rq', 'primaire', 'nom du projet de florian');
  INSERT INTO projet (chiffre_affaire, remarques, type_projet, nom) VALUES (0, 'rq', 'primaire', 'nom du projet de francois');

  INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('1', '1');
  INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('2', '2');
  INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('3', '3');
  INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('4', '4');


EOF