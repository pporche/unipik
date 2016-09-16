-- version 1.00, date 14/09/2016, auteur Mélissa Bignoux
-- permet d'ajouter des bénévoles et des interventions pour les tests

-- benevoles
INSERT INTO adresse (ville,adresse,code_postal,complement,geolocalisation) VALUES ('blabla','blabla','00000',NULL,NULL);
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id) VALUES ('kafui', 'kafui', 'kafui@kafui.kafui', 'kafui@kafui.kafui', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'kafui','atanley',NULL,NULL,1);
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id,responsabilite_activite) VALUES ('florian', 'florian', 'florian@florian.florian', 'florian@florian.florian', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'florian','leriche',NULL,NULL,1, '{(admin_region)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('mathieu', 'mathieu', 'mathieu@mathieu.mathieu', 'mathieu@mathieu.mathieu', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'mathieu','medici',NULL,NULL,1, '{(actions ponctuelles)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('francois', 'francois', 'francois@francois.francois', 'francois@francois.francois', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'francois','decq',NULL,NULL,1, '{(actions ponctuelles), (plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('pierre', 'pierre', 'pierre@pierre.pierre', 'pierre@pierre.pierre', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'pierre','porche',NULL,NULL,1, '{(actions ponctuelles), (plaidoyers), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('sergi', 'sergi', 'sergi@sergi.sergi', 'sergi@sergi.sergi', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'sergi','colomies',NULL,NULL,1, '{(autre), (plaidoyers), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('juliana', 'juliana', 'juliana@juliana.juliana', 'juliana@juliana.juliana', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'juliana','ppppp',NULL,NULL,1, '{(actions ponctuelles), (projets), (frimousses)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles) VALUES ('matthieu', 'matthieu', 'matthieu@matthieu.matthieu', 'matthieu@matthieu.matthieu', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'matthieu','martins-baltar',NULL,NULL,1, '{(actions ponctuelles), (projets), (frimousses), (plaidoyers), (autre)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles,responsabilite_activite) VALUES ('michel', 'michel', 'michel@michel.michel', 'michel@michel.michel', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'michel','cressant',NULL,NULL,1, '{(actions ponctuelles), (projets), (frimousses)}', '{(plaidoyers)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles,responsabilite_activite) VALUES ('julie', 'julie', 'julie@julie.julie', 'julie@julie.julie', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'julie','pain',NULL,NULL,1, '{(actions ponctuelles), (projets), (frimousses)}', '{(actions ponctuelles)}');
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id, activites_potentielles,responsabilite_activite) VALUES ('melissa', 'melissa', 'melissa@melissa.melissa', 'melissa@melissa.melissa', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL,'melissa','bignoux',NULL,NULL,1, '{(actions ponctuelles), (projets), (frimousses)}', '{(admin_comite)}');


--contacts

INSERT INTO contact (id, email, nom, prenom, tel_fixe, type_contact, type_activite) VALUES (1, 'contact1@contact.fr', 'nom1', 'prenom1', '0235490983', 'enseignant', '{(plaidoyers)}');
INSERT INTO contact (id, email, nom, tel_fixe, type_contact, est_tuteur) VALUES (2, 'contact2@contact.fr', 'nom2', '0235490983', 'animateur', false);
INSERT INTO contact (id, email, nom, prenom, tel_portable, type_contact, respo_etablissement, type_activite) VALUES (3, 'contact3@contact.fr', 'nom3', 'prenom3', '0247282552', 'eleve', false, '{(plaidoyers), (actions ponctuelles)}');
INSERT INTO contact (id, email, nom, prenom, type_contact, est_tuteur) VALUES (4, 'contact4@contact.fr', 'nom4', 'prenom4', 'etudiant', true);
INSERT INTO contact (id, email, nom, prenom, type_contact, respo_etablissement, type_activite) VALUES (5, 'contact5@contact.fr', 'nom5', 'prenom5', 'autre', true, '{(frimousses), (projets), (autre)}');

-- demandes

INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('1', '2016-12-05', '{(40), (42)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('2', '2016-11-05', '{(3), (7), (42), (51)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('3', '2016-10-05', '{(1), (12)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('4', '2016-09-30', '{(24), (25), (34), (37), (1), (12)}');
INSERT INTO demande (contact_id, date, liste_semaine) VALUES ('5', '2016-12-15', '{(34), (37)}');

-- interventions

INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date,  nb_personne, remarques, heure, realisee) VALUES ('1', '1', '1', '1', '2016-11-21', '21', 'la remarque',  '14:00', true);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, nb_personne, remarques, heure, realisee) VALUES ('1', '1', '1', '2', '2016-11-21', '30', 'la remarque',  '14:00', false);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee) VALUES ('1', '2', '1', '3', '2016-11-21', 'le lieu', '21', 'la remarque', true  );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee) VALUES ('1', '2', '1', '4', '2016-11-21', 'le lieu', '21', 'la remarque', true);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee) VALUES ('2', '3', '1', '5', '2016-11-21', 'le lieu', '21', 'la remarque', true);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee) VALUES ('2', '3', '1', '6', '2016-11-21', 'le lieu', '21', 'la remarque', true);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, realisee) VALUES ('2', '4', '1', '7', '2016-11-21', 'le lieu', '21', true);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, realisee) VALUES ('2', '4', '1', '8', '2016-11-21', 'le lieu', '21', true);
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, realisee) VALUES ('1', '5', '1', '1', '2016-11-21', 'le lieu', '21', 'la remarque',  true );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id) VALUES ('3', '5', '1', '9', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false, '1');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer, niveau_frimousse, materiaux_frimousse) VALUES ('3', '6', '1', '10', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false, '1', '{(tableau interactif), (enceinte)}', 'CP-CE1', '{(patron), (bourre)}' );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, niveau_frimousse, materiaux_frimousse) VALUES ('3', '6', '1', '11', '2016-11-21',  'le lieu', '21','la remarque', '14:00', false, '3', 'CM2', '{(bourre)}' );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, materiel_dispo_plaidoyer, materiaux_frimousse) VALUES ('3', '7', '1', '12', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false, '{(videoprojecteur), (autre)}', '{(patron)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, materiel_dispo_plaidoyer, materiaux_frimousse) VALUES ('3', '7', '1', '13', '2016-11-21', 'le lieu', '21', 'la remarque', '15:00', false, '{(videoprojecteur), (autre)}', '{(patron)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse) VALUES ('4', '8', '1', '14', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false, 'CM2', '{(decoration)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee, materiaux_frimousse) VALUES ('4', '8', '1', '15', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false, '{(decoration), (bourre), (patron)}');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee) VALUES ('4', '9', '1', '16', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee) VALUES ('4', '9', '1', '17', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false );
INSERT INTO intervention (demande_id,  comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee) VALUES ('4', '1', '18', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false );
INSERT INTO intervention (demande_id,  comite_id, etablissement_id, date, lieu, nb_personne, remarques, heure, realisee) VALUES ('4', '1', '19', '2016-11-21', 'le lieu', '21', 'la remarque',  '14:00', false);