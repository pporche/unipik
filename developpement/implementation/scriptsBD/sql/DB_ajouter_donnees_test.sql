-- version 1.00, date 14/09/2016, auteur Mélissa Bignoux
-- permet d'ajouter des bénévoles et des interventions pour les tests

-- benevoles
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id) VALUES ('kafui', 'kafui', 'kafui@kafui.kafui', 'kafui@kafui.kafui', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'kafui','atanley','0235111111','0611111111',1);
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id,responsabilite_activite) VALUES ('florian', 'florian', 'florian@florian.florian', 'florian@florian.florian', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'leriche','florian',NULL,'0622222222',2, '{(admin_region)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('mathieu', 'mathieu', 'mathieu@mathieu.mathieu', 'mathieu@mathieu.mathieu', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'medici', 'mathieu','0235333333',NULL,6, '{(actions_ponctuelles)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('francois', 'francois', 'francois@francois.francois', 'francois@francois.francois', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'decq','francois',NULL,NULL,20, '{(actions_ponctuelles), (plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('pierre', 'pierre', 'pierre@pierre.pierre', 'pierre@pierre.pierre', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'porche', 'pierre','0235444444','0644444444',56, '{(actions_ponctuelles), (plaidoyers), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('sergi', 'sergi', 'sergi@sergi.sergi', 'sergi@sergi.sergi', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'colomies','sergi','0235555555','0655555555',106, '{(autre), (plaidoyers), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('juliana', 'juliana', 'juliana@juliana.juliana', 'juliana@juliana.juliana', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'rossi','juliana',NULL,NULL,109, '{(actions_ponctuelles), (projets), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('matthieu', 'matthieu', 'matthieu@matthieu.matthieu', 'matthieu@matthieu.matthieu', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'martins-baltar', 'matthieu',NULL,NULL,203, '{(actions_ponctuelles), (projets), (frimousses), (plaidoyers), (autre)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles,responsabilite_activite) VALUES ('michel', 'michel', 'michel@michel.michel', 'michel@michel.michel', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, 'cressant', 'michel','0235555555','0655555555',500, '{(actions_ponctuelles), (projets), (frimousses)}', '{(plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles,responsabilite_activite) VALUES ('julie', 'julie', 'julie@julie.julie', 'julie@julie.julie', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'pain','julie','0235555555','0655555555',700, '{(actions_ponctuelles), (projets), (frimousses)}', '{(actions_ponctuelles)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles,responsabilite_activite) VALUES ('melissa', 'melissa', 'melissa@melissa.melissa', 'melissa@melissa.melissa', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'bignoux','melissa','0235490983','0647282552',900, '{(actions_ponctuelles), (projets), (frimousses)}', '{(admin_comite)}');


--contacts

INSERT INTO contact (id, email, nom, prenom, tel_fixe, type_contact, type_activite) VALUES (1, 'contact1@contact.fr', 'nom1', 'prenom1', '0235490983', 'enseignant', '{(plaidoyers)}');
INSERT INTO contact (id, email, nom, tel_fixe, type_contact, est_tuteur) VALUES (2, 'contact2@contact.fr', 'nom2', '0235490983', 'animateur', false);
INSERT INTO contact (id, email, nom, prenom, tel_portable, type_contact, respo_etablissement, type_activite) VALUES (3, 'contact3@contact.fr', 'nom3', 'prenom3', '0247282552', 'eleve', false, '{(plaidoyers), (actions_ponctuelles)}');
INSERT INTO contact (id, email, nom, prenom, type_contact, est_tuteur) VALUES (4, 'contact4@contact.fr', 'nom4', 'prenom4', 'etudiant', true);
INSERT INTO contact (id, email, nom, prenom, type_contact, respo_etablissement, type_activite) VALUES (5, 'contact5@contact.fr', 'nom5', 'prenom5', 'autre', true, '{(frimousses), (projets), (autre)}');

-- demandes

INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('1', '2016-12-05', '{(40), (42)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('2', '2016-11-05', '{(3), (7), (42), (51)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('3', '2016-10-05', '{(1), (12)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('4', '2016-09-30', '{(24), (25), (34), (37), (1), (12)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('5', '2016-12-15', '{(34), (37)}');

-- interventions

INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date,  nb_personne, remarques, heure, realisee, description) VALUES ('1', '1', '1', '1', '2016-01-02', '21', 'la remarque',  '14:00', true, 'description d''une action autre');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, nb_personne, remarques, heure, realisee, description) VALUES ('1', '1', '1', '2', '2016-01-20', '30', 'la remarque',  '14:00', false, 'description d''une action autre');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee, description) VALUES ('1', '2', '1', '3', '2016-02-03', 'le lieu', '21', 'la remarque', true , 'description d''une action autre');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee, description) VALUES ('1', '2', '1', '4', '2016-03-06', 'le lieu', '21', 'la remarque', true, 'description d''une action autre');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee, description) VALUES ('2', '3', '1', '5', '2016-05-21', 'le lieu', '21', 'la remarque', true, 'description d''une action autre');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee, description) VALUES ('2', '3', '1', '6', '2016-05-15', 'le lieu', '21', 'la remarque', true, 'description d''une action autre');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('2', '4', '1', '7', '2016-06-15', 'le lieu', '21', true, '1', '{(videoprojecteur), (autre)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('2', '4', '1', '8', '2016-06-20', 'le lieu', '21', true, '7', '{(videoprojecteur), (autre)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('1', '5', '1', '1', '2016-07-28', 'le lieu', '21', 'la remarque',  true, '7', '{(videoprojecteur), (autre)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('3', '5', '1', '9', '2016-07-30', 'le lieu', '21', 'la remarque',  '14:00', false, '20', '{(videoprojecteur), (autre)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('3', '6', '1', '10', '2016-08-02', 'le lieu', '21', 'la remarque',  '14:00', false, '4', '{(tableau interactif), (enceinte)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('3', '6', '1', '11', '2016-08-21',  'le lieu', '21','la remarque', '14:00', false, '41', '{(tableau interactif), (enceinte)}' );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer) VALUES ('3', '7', '1', '12', '2016-08-30', 'le lieu', '21', 'la remarque',  '14:00', false,  '16', '{(tableau interactif), (enceinte)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('3', '7', '1', '13', '2016-09-22', 'le lieu', '21', 'la remarque', '15:00', false, 'CM2', '{(bourre)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '8', '1', '14', '2016-09-30', 'le lieu', '21', 'la remarque',  '14:00', false, 'CE1-CE2', '{(decoration)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '8', '1', '15', '2016-10-01', 'le lieu', '21', 'la remarque',  '14:00', false, 'CE2-CM1','{(decoration), (bourre), (patron)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '9', '1', '16', '2016-10-02', 'le lieu', '21', 'la remarque',  '14:00', false, 'CM1','{(decoration), (bourre), (patron)}' );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '9', '1', '17', '2016-10-15', 'le lieu', '21', 'la remarque',  '14:00', false, 'CM2','{(decoration), (patron)}' );
INSERT INTO intervention (demande_id,  comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '1', '18', '2016-11-13', 'le lieu', '21', 'la remarque',  '14:00', false , 'autre','{(decoration), (bourre)}');
INSERT INTO intervention (demande_id,  comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '1', '19', '2016-11-16', 'le lieu', '21', 'la remarque',  '14:00', false, 'autre','{(bourre), (patron)}');

INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('1', '1');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('1', '2');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('2', '2');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('3', '3');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('4', '4');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('5', '5');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('6', '1');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('6', '2');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('7', '1');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('7', '3');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('8', '1');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('9', '1');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('10', '3');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('11', '1');
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('11', '4');

INSERT INTO projet (chiffre_affaire, type, nom) VALUES ('456.23', 'superieur', 'projet superieur');
INSERT INTO projet (chiffre_affaire, type, nom) VALUES ('12.56', 'lycee', 'projet lycee');
INSERT INTO projet (chiffre_affaire, type, nom) VALUES ('0', 'college', 'projet college');
INSERT INTO projet (chiffre_affaire, type, nom) VALUES ('0', 'primaire', 'projet pour les primaires');

INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('1', '2');
INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('2', '2');
INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('3', '2');
INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('4', '1');
INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('5', '3');
INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('6', '4');
INSERT INTO benevole_projet (benevole_id, projet_id) VALUES ('7', '4');



