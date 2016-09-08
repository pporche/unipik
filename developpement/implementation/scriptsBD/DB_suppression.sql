-- version 1.00 date 13/05/2016 auteur(s) Michel Cressannt, Julie Pain

-- suppression des triggers --
-- DROP TRIGGER supprimerBenevole ON benevole;

-- suppression des fonctions --
-- DROP FUNCTION supprimerBenevole();
DROP FUNCTION recupererprojets(integer);


-- delete from adresse where id = 1;

-- Suppression des vues --
DROP VIEW IF EXISTS personne;
DROP VIEW IF EXISTS plaidoyer;
DROP VIEW IF EXISTS frimousse;
DROP VIEW IF EXISTS autre_intervention;
DROP VIEW IF EXISTS enseignement;
DROP VIEW IF EXISTS centre_loisirs;
DROP VIEW IF EXISTS autre_etablissement;

-- Suppression des tables --
DROP TABLE IF EXISTS participe;
DROP TABLE IF EXISTS appartient;
DROP TABLE IF EXISTS benevole_projet;
DROP TABLE IF EXISTS benevole_comite;
DROP TABLE IF EXISTS vente;
DROP TABLE IF EXISTS intervention;
DROP TABLE IF EXISTS etablissement;
DROP TABLE IF EXISTS demande_moments_a_eviter;
DROP TABLE IF EXISTS demande_moments_voulus;
DROP TABLE IF EXISTS demande;
DROP TABLE IF EXISTS comite_niveau_theme;
DROP TABLE IF EXISTS comite;
DROP TABLE IF EXISTS region;
DROP TABLE IF EXISTS pays;
DROP TABLE IF EXISTS projet;
DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS benevole;

-- Suppression des types -- 
DROP TYPE type_semaine;
-- DROP TYPE type_moment;
-- DROP TYPE type_niveau_theme;
DROP TYPE type_materiel_plaidoyer;
DROP TYPE type_materiel_frimousse;
DROP TYPE type_email;
DROP TYPE type_activite;
DROP TYPE type_responsabilite_activite;

-- Suppression des tables correspondants à des types --
DROP TABLE IF EXISTS moment_hebdomadaire;
DROP TABLE IF EXISTS niveau_theme;
DROP TABLE IF EXISTS adresse;

-- Suppression des domaines --
DROP DOMAIN IF EXISTS domaine_email;
DROP DOMAIN IF EXISTS domaine_theme;
DROP DOMAIN IF EXISTS domaine_niveau_scolaire_limite;
DROP DOMAIN IF EXISTS domaine_niveau_scolaire_complet;
DROP DOMAIN IF EXISTS domaine_materiel_frimousse;
DROP DOMAIN IF EXISTS domaine_materiel_plaidoyer;
DROP DOMAIN IF EXISTS domaine_type_autre_etablissement;
DROP DOMAIN IF EXISTS domaine_type_centre;
DROP DOMAIN IF EXISTS domaine_type_enseignement;
DROP DOMAIN IF EXISTS domaine_type_projet;
DROP DOMAIN IF EXISTS domaine_reponsabilite_activite;
DROP DOMAIN IF EXISTS domaine_activite;
DROP DOMAIN IF EXISTS domaine_type_contact;
DROP DOMAIN IF EXISTS domaine_moment_quotidien;
DROP DOMAIN IF EXISTS domaine_jour;
DROP DOMAIN IF EXISTS domaine_semaine;
DROP DOMAIN IF EXISTS domaine_region_de_france;
DROP DOMAIN IF EXISTS domaine_departement_de_france;
DROP DOMAIN IF EXISTS domaine_code_postal;
DROP DOMAIN IF EXISTS domaine_tel_portable;
DROP DOMAIN IF EXISTS domaine_tel_fixe;



