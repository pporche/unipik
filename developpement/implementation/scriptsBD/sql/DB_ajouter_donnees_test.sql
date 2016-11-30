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


-- benevole_comite 
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
INSERT INTO benevole_comite (benevole_id, comite_id) VALUES ('12', '1');

--contacts
ALTER SEQUENCE contact_id_seq RESTART WITH 1;
INSERT INTO contact (email, nom, prenom, tel_fixe, type_contact, type_activite) VALUES ('contact1@contact.fr', 'nom1', 'prenom1', '0235490983', 'enseignant', '{(plaidoyers)}');
INSERT INTO contact (email, nom, tel_fixe, type_contact, est_tuteur) VALUES ('contact2@contact.fr', 'nom2', '0235490983', 'animateur', false);
INSERT INTO contact (email, nom, prenom, tel_portable, type_contact, respo_etablissement, type_activite) VALUES ('contact3@contact.fr', 'nom3', 'prenom3', '0247282552', 'eleve', false, '{(plaidoyers), (actions_ponctuelles)}');
INSERT INTO contact (email, nom, prenom, type_contact, est_tuteur) VALUES ('contact4@contact.fr', 'nom4', 'prenom4', 'etudiant', true);
INSERT INTO contact (email, nom, prenom, type_contact, respo_etablissement, type_activite) VALUES ('contact5@contact.fr', 'nom5', 'prenom5', 'autre', true, '{(frimousses), (projets), (autre)}');

-- benevole_contact 
INSERT INTO appartient (etablissement_id, contact_id) VALUES ('1', '1');
INSERT INTO appartient (etablissement_id, contact_id) VALUES ('2', '2');
INSERT INTO appartient (etablissement_id, contact_id) VALUES ('3', '3');
INSERT INTO appartient (etablissement_id, contact_id) VALUES ('4', '4');
INSERT INTO appartient (etablissement_id, contact_id) VALUES ('5', '5');

-- demande
ALTER SEQUENCE demande_id_seq RESTART WITH 1;
INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('1', '2016-12-05', '2017-01-02', '2017-02-02');
INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('2', '2016-11-05', '2017-02-02', '2017-03-02');
INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('3', '2016-10-05', '2016-10-15', '2016-12-02');
INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('4', '2016-09-30', '2016-10-02', '2016-12-16');
INSERT INTO demande (contact_id, date_demande, date_debut_disponibilite, date_fin_disponibilite) VALUES ('5', '2016-12-15', '2017-01-02', '2017-03-02');

--demande_moment_voulus
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('1', '1');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('1', '2');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('1', '3');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('1', '4');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('2', '5');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '6');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '7');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '8');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '9');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '10');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '11');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('3', '12');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('4', '1');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('4', '2');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('4', '3');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('4', '4');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('4', '5');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('4', '6');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('5', '8');
INSERT INTO demande_moments_voulus (demande_moments_voulus, moments_voulus) VALUES ('5', '9');

--demande_moments_a_eviter
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '5');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '6');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '7');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '8');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '9');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '10');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '11');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('1', '12');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '1');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '2');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '3');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '4');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '6');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '7');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '8');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '9');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '10');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '11');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('2', '12');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('3', '1');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('3', '2');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('3', '3');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('3', '4');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('3', '5');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter , moments_a_eviter) VALUES ('4', '7');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter , moments_a_eviter) VALUES ('4', '8');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter , moments_a_eviter) VALUES ('4', '9');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter , moments_a_eviter) VALUES ('4', '10');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter , moments_a_eviter) VALUES ('4', '11');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter , moments_a_eviter) VALUES ('4', '12');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '1');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '2');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '3');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '4');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '5');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '6');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '7');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '10');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '11');
INSERT INTO demande_moments_a_eviter (demande_moments_a_eviter, moments_a_eviter) VALUES ('5', '12');


-- interventions
ALTER SEQUENCE intervention_id_seq RESTART WITH 1;
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention,  nb_personne, remarques, heure, realisee, description, type_intervention) VALUES ('1', '5', '1', '1', '2017-01-05', '21', 'la remarque',  '14:00', true, 'description d''une action autre', 'autre_intervention');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, nb_personne, remarques, heure, realisee, description, type_intervention) VALUES ('1', '5', '1', '2', '2017-01-20', '30', 'la remarque',  '14:00', false, 'description d''une action autre', 'autre_intervention');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, realisee, description, type_intervention) VALUES ('1', '2', '1', '3', '2017-02-01', 'le lieu', '21', 'la remarque', true , 'description d''une action autre', 'autre_intervention');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, realisee, description, type_intervention) VALUES ('1', '2', '1', '4', '2017-01-05', 'le lieu', '21', 'la remarque', true, 'description d''une action autre', 'autre_intervention');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, realisee, description, type_intervention) VALUES ('2', '3', '1', '5', '2017-02-01', 'le lieu', '21', 'la remarque', true, 'description d''une action autre', 'autre_intervention');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, realisee, description, type_intervention) VALUES ('2', '3', '1', '6', '2017-02-21', 'le lieu', '21', 'la remarque', true, 'description d''une action autre', 'autre_intervention');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('2', '4', '1', '7', '2017-02-15', 'le lieu', '21', true, '1', '{(videoprojecteur), (autre)}', 'plaidoyer');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('2', '4', '1', '8', '2017-02-20', 'le lieu', '21', true, '7', '{(videoprojecteur), (autre)}', 'plaidoyer');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('1', '5', '1', '1', '2017-02-27', 'le lieu', '21', 'la remarque',  true, '7', '{(videoprojecteur), (autre)}', 'plaidoyer');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('3', '5', '1', '9', '2016-10-06', 'le lieu', '21', 'la remarque',  '14:00', false, '20', '{(videoprojecteur), (autre)}', 'plaidoyer');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('3', '6', '1', '10', '2016-10-07', 'le lieu', '21', 'la remarque',  '14:00', false, '4', '{(tableau interactif), (enceinte)}', 'plaidoyer');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('3', '6', '1', '11', '2016-10-08',  'le lieu', '21','la remarque', '14:00', false, '41', '{(tableau interactif), (enceinte)}', 'plaidoyer' );
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer, type_intervention) VALUES ('3', '7', '1', '12', '2016-10-09', 'le lieu', '21', 'la remarque',  '14:00', false,  '16', '{(tableau interactif), (enceinte)}', 'plaidoyer');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('3', '7', '1', '13', '2016-10-10', 'le lieu', '21', 'la remarque', '15:00', false, 'CM2', '{(bourre)}', 'frimousse');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('4', '8', '1', '14', '2016-09-30', 'le lieu', '21', 'la remarque',  '14:00', false, 'CE1-CE2', '{(decoration)}', 'frimousse');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('4', '8', '1', '15', '2016-09-30', 'le lieu', '21', 'la remarque',  '14:00', false, 'CE2-CM1','{(decoration), (bourre), (patron)}', 'frimousse');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('4', '9', '1', '16', '2016-09-30', 'le lieu', '21', 'la remarque',  '14:00', false, 'CM1','{(decoration), (bourre), (patron)}' , 'frimousse');
INSERT INTO intervention (demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('4', '9', '1', '17', '2016-09-30', 'le lieu', '21', 'la remarque',  '14:00', false, 'CM2','{(decoration), (patron)}', 'frimousse' );
INSERT INTO intervention (demande_id,  comite_id, etablissement_id, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('4', '1', '18', 'le lieu', '21', 'la remarque',  '14:00', false , 'autre','{(decoration), (bourre)}', 'frimousse');
INSERT INTO intervention (demande_id,  comite_id, etablissement_id, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse, type_intervention) VALUES ('4', '1', '19', 'le lieu', '21', 'la remarque',  '14:00', false, 'autre','{(bourre), (patron)}', 'frimousse');

ALTER SEQUENCE vente_id_seq RESTART WITH 1;
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1010,  60, '20-11-2016');
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1011,  70, '21-12-2016');
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1012,  80, '22-01-2017');
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1013,  90, '23-01-2017');
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1014,  100, '24-01-2017');
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1015,  110, '25-02-2017');
INSERT INTO vente (etablissement_id, chiffre_affaire, date_vente) VALUES (1016,  30, '26-02-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (13, 14,  100, '21-12-2016');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (13, 14,  50, '27-12-2016');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (13, 14,  55, '29-12-2016');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (13, 14,  58, '26-12-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (13, 14,  63, '30-03-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (14, 15,  89, '15-01-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (14, 15,  51, '16-01-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (14, 15,  89, '12-02-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (14, 15,  32, '15-02-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (16, 17,  78, '17-02-2017');
INSERT INTO vente (etablissement_id, intervention_id, chiffre_affaire, date_vente) VALUES (16, 17,  54, '19-02-2017');