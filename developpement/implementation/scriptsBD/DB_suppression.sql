-- Suppression des vues --
DROP VIEW IF EXISTS personne;

-- Suppression des tables --
DROP TABLE IF EXISTS participe;
DROP TABLE IF EXISTS appartient;
DROP TABLE IF EXISTS benevole_projet;
DROP TABLE IF EXISTS benevole_comite;
DROP TABLE IF EXISTS vente;
DROP TABLE IF EXISTS autre_intervention;
DROP TABLE IF EXISTS frimousse;
DROP TABLE IF EXISTS plaidoyer;
DROP TABLE IF EXISTS intervention;
DROP TABLE IF EXISTS autre_etablissement;
DROP TABLE IF EXISTS centre_loisirs;
DROP TABLE IF EXISTS enseignement;
DROP TABLE IF EXISTS etablissement;
DROP TABLE IF EXISTS demande;
DROP TABLE IF EXISTS comite;
DROP TABLE IF EXISTS region;
DROP TABLE IF EXISTS pays;
DROP TABLE IF EXISTS projet;
DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS admin_region;
DROP TABLE IF EXISTS admin_comite;
DROP TABLE IF EXISTS admin_activite;
DROP TABLE IF EXISTS benevole;

-- Suppression des types -- 
DROP TYPE type_semaine;
DROP TYPE type_moment;
DROP TYPE type_niveau_theme;
DROP TYPE type_materiel_plaidoyer;
DROP TYPE type_materiel_frimousse;
DROP TYPE type_email;
DROP TYPE type_activite;

-- Suppression des tables correspondants à des types --
DROP TABLE IF EXISTS moment_hebdomadaire;
DROP TABLE IF EXISTS niveau_theme;
DROP TABLE IF EXISTS adresse;

-- Suppression des domaines --
DROP DOMAIN IF EXISTS email;
DROP DOMAIN IF EXISTS theme;
DROP DOMAIN IF EXISTS niveau_scolaire_limite;
DROP DOMAIN IF EXISTS niveau_scolaire_complet;
DROP DOMAIN IF EXISTS materiel_frimousse;
DROP DOMAIN IF EXISTS materiel_plaidoyer;
DROP DOMAIN IF EXISTS type_autre_etablissement;
DROP DOMAIN IF EXISTS type_centre;
DROP DOMAIN IF EXISTS type_enseignement;
DROP DOMAIN IF EXISTS type_projet;
DROP DOMAIN IF EXISTS activite;
DROP DOMAIN IF EXISTS type_contact;
DROP DOMAIN IF EXISTS moment_quotidien;
DROP DOMAIN IF EXISTS jour;
DROP DOMAIN IF EXISTS semaine;
DROP DOMAIN IF EXISTS region_de_france;
DROP DOMAIN IF EXISTS departement_de_france;
DROP DOMAIN IF EXISTS code_postal;
DROP DOMAIN IF EXISTS tel_portable;
DROP DOMAIN IF EXISTS tel_fixe;

