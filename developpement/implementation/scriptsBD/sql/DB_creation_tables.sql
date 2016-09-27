-- version 1.00 date 13/05/2016 auteur(s) Michel Cressannt, Julie Pain
-- Création des tables de la base de données

-- Déclaration de constantes
\set longueurChaineCourte 30
\set longueurChaineMoyenne 100
\set longueurChaineLongue 500
 
-- Définition des Domaines --
CREATE EXTENSION postgis; 

CREATE DOMAIN  domaine_semaine AS INT
CHECK (VALUE <54 AND VALUE >0);

CREATE DOMAIN  domaine_entier_nb_personne AS INT
CHECK (VALUE >0);

CREATE DOMAIN domaine_jour AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'));

CREATE DOMAIN domaine_moment_quotidien AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('matin', 'apres-midi', 'soir'));

CREATE DOMAIN domaine_type_contact AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('enseignant', 'animateur', 'eleve', 'etudiant', 'autre'));


CREATE DOMAIN domaine_activite AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('actions_ponctuelles', 'plaidoyers', 'frimousses', 'projets', 'autre'));

CREATE DOMAIN domaine_reponsabilite_activite AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('actions_ponctuelles', 'plaidoyers', 'frimousses', 'projets', 'admin_region', 'admin_comite'));


CREATE DOMAIN domaine_type_projet AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('primaire', 'college', 'lycee', 'superieur'));

CREATE DOMAIN domaine_type_enseignement AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('maternelle', 'elementaire', 'college', 'lycee', 'superieur'));

CREATE DOMAIN domaine_type_centre AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('maternelle', 'elementaire', 'adolescent', 'autre'));

CREATE DOMAIN domaine_type_autre_etablissement AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('mairie', 'maison de retraite', 'autre'));

CREATE DOMAIN domaine_materiel_plaidoyer AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('videoprojecteur', 'tableau interactif', 'enceinte', 'autre'));

CREATE DOMAIN domaine_materiel_frimousse AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('patron', 'bourre', 'decoration'));

CREATE DOMAIN domaine_niveau_scolaire_complet AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('petite section', 'petite-moyenne section', 'moyenne section', 'moyenne-grande section', 'grande section', 'petite-moyenne-grande section',
                 'CP', 'CP-CE1', 'CE1', 'CE1-CE2', 'CE2', 'CE2-CM1', 'CM1', 'CM1-CM2', 'CM2', 
                 '6eme', '5eme', '4eme', '3eme', '2nde', '1ere', 'terminale', 
                 'L1', 'L2', 'L3', 'M1', 'M2',
                 'autre'
      ));

CREATE DOMAIN domaine_niveau_scolaire_limite AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE IN ('CP', 'CP-CE1', 'CE1', 'CE1-CE2', 'CE2', 'CE2-CM1', 'CM1', 'CM1-CM2', 'CM2', 'autre'));

CREATE DOMAIN domaine_theme AS VARCHAR(:longueurChaineMoyenne)
CHECK (VALUE IN ('convention internationale des droits de l enfant', 'education', 'sante en generale', 'sante et alimentation', 'VIH et sida', 'eau', 'urgences mondiales', 'travail des enfants', 'enfants et soldats', 'harcelement', 'role de l Unicef', 'millenaire pour le developpement' ));

CREATE DOMAIN domaine_email AS VARCHAR(:longueurChaineMoyenne)
CHECK (VALUE ~ '^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$' );


CREATE DOMAIN domaine_tel_portable AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE ~ '^[0-9]{10}$');

CREATE DOMAIN domaine_tel_fixe AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE ~ '^[0-9]{10}$');

CREATE DOMAIN domaine_heure AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE ~ '^[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}');


CREATE DOMAIN domaine_code_postal AS VARCHAR(:longueurChaineCourte)
CHECK (VALUE ~ '^[0-9]{5}$');


-- il faut rajouter un domaine sur l'UAI d'un établissement (enseignement) --



-- Définition des tables correspondant à des types -- 

CREATE TABLE IF NOT EXISTS pays (
	id SERIAL PRIMARY KEY,
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL
);


CREATE TABLE IF NOT EXISTS region (
	id SERIAL PRIMARY KEY,
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL, 
	pays_id INT NOT NULL REFERENCES pays(id) ON DELETE CASCADE

);

CREATE TABLE IF NOT EXISTS ville (
	id SERIAL PRIMARY KEY, 
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL
);

CREATE TABLE IF NOT EXISTS departement (
	id SERIAL PRIMARY KEY, 
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL,
	numero VARCHAR(:longueurChaineCourte) NOT NULL,
	region_id INT NOT NULL REFERENCES region(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS code_postal (
	id SERIAL PRIMARY KEY, 
	code domaine_code_postal NOT NULL, 
	departement_id INT NOT NULL REFERENCES departement(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS adresse (
	id SERIAL PRIMARY KEY, 
	adresse VARCHAR(:longueurChaineLongue) NOT NULL, 
	complement VARCHAR(:longueurChaineMoyenne) DEFAULT NULL, 
	ville_id INT NOT NULL REFERENCES ville(id) ON DELETE CASCADE,
	geolocalisation geography(POINT,4326) DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS niveau_theme (
	id SERIAL PRIMARY KEY,
	niveau domaine_niveau_scolaire_complet,
	theme domaine_theme
);

CREATE TABLE IF NOT EXISTS moment_hebdomadaire (
	id SERIAL PRIMARY KEY,
	jour domaine_jour NOT NULL, 
	moment domaine_moment_quotidien NOT NULL
);



-- Création des types pour les attributs multivalués -- 

CREATE TYPE type_activite as (activite_potentielle domaine_activite);
CREATE TYPE type_email as (email  domaine_email);	
CREATE TYPE type_materiel_frimousse as (materiel_frimousse domaine_materiel_frimousse);
CREATE TYPE type_materiel_plaidoyer as (materiel_plaidoyer domaine_materiel_plaidoyer);	
CREATE TYPE type_semaine as (semaine domaine_semaine);	
CREATE TYPE type_responsabilite_activite as(responsabilite_activite domaine_reponsabilite_activite);

-- Création des tables --

CREATE TABLE IF NOT EXISTS benevole (
	id SERIAL PRIMARY KEY,
    	username character varying(255) NOT NULL,
    	username_canonical character varying(255) NOT NULL,
    	email character varying(255) NOT NULL,
    	email_canonical character varying(255) NOT NULL,
   	enabled boolean NOT NULL,
    	salt character varying(255) NOT NULL,
    	password character varying(255) NOT NULL,
    	last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    	locked boolean NOT NULL,
    	expired boolean NOT NULL,
    	expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    	confirmation_token character varying(255) DEFAULT NULL::character varying,
    	password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    	roles text NOT NULL,
    	credentials_expired boolean NOT NULL,
    	credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL,
	prenom VARCHAR(:longueurChaineMoyenne) DEFAULT NULL, 
	tel_fixe domaine_tel_fixe DEFAULT NULL, 
	tel_portable domaine_tel_portable DEFAULT NULL,
	adresse_id INT NOT NULL REFERENCES adresse(id) ON DELETE CASCADE, 
	activites_potentielles type_activite[] DEFAULT NULL,
	responsabilite_activite type_responsabilite_activite[] DEFAULT NULL	
);



CREATE TABLE IF NOT EXISTS contact (
	id SERIAL PRIMARY KEY,
	email domaine_email NOT NULL,
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL,
	prenom VARCHAR(:longueurChaineMoyenne) DEFAULT NULL, 
	tel_fixe domaine_tel_fixe DEFAULT NULL, 
	tel_portable domaine_tel_portable DEFAULT NULL,
	type_contact domaine_type_contact NOT NULL,
	est_tuteur BOOLEAN DEFAULT NULL,
	respo_etablissement BOOLEAN DEFAULT NULL,
	type_activite type_activite[] DEFAULT NULL
);



CREATE TABLE IF NOT EXISTS projet (
	id SERIAL PRIMARY KEY, 
	chiffre_affaire DOUBLE PRECISION NOT NULL, 
	remarques VARCHAR(:longueurChaineLongue) DEFAULT NULL, 
	type domaine_type_projet NOT NULL, 
	nom VARCHAR(:longueurChaineMoyenne) NOT NULL
);


CREATE TABLE IF NOT EXISTS comite (
	id SERIAL PRIMARY KEY
);

-- changement --
CREATE TABLE IF NOT EXISTS comite_niveau_theme (
	comite int REFERENCES comite(id) ON DELETE CASCADE,
	niveau_theme INT REFERENCES niveau_theme(id) ON DELETE CASCADE,
	PRIMARY KEY(comite, niveau_theme)
);


CREATE TABLE IF NOT EXISTS demande (
	id SERIAL PRIMARY KEY, 
	contact_id INT NOT NULL REFERENCES contact(id) ON DELETE CASCADE, 
	date_demande DATE NOT NULL,
	liste_semaine type_semaine[] NOT NULL

);

CREATE TABLE demande_moments_voulus (
	demande_moments_voulus INT REFERENCES demande(id) ON DELETE CASCADE,
	moments_voulus INT REFERENCES moment_hebdomadaire(id) ON DELETE CASCADE,
	PRIMARY KEY(demande_moments_voulus, moments_voulus)
);


CREATE TABLE demande_moments_a_eviter (
	demande_moments_a_eviter INT REFERENCES demande(id) ON DELETE CASCADE,
	moments_a_eviter INT REFERENCES moment_hebdomadaire(id) ON DELETE CASCADE,
	PRIMARY KEY(demande_moments_a_eviter, moments_a_eviter)
);



CREATE TABLE IF NOT EXISTS etablissement (
	id SERIAL PRIMARY KEY,
	uai VARCHAR(:longueurChaineMoyenne) DEFAULT NULL, 
	adresse_id INT NOT NULL REFERENCES adresse(id) ON DELETE CASCADE, 
	nom VARCHAR(:longueurChaineMoyenne) DEFAULT NULL, 
	tel_fixe domaine_tel_fixe DEFAULT NULL,
	emails type_email[] NOT NULL
);

ALTER TABLE etablissement
	add type_enseignement domaine_type_enseignement;



ALTER TABLE etablissement
	add type_centre domaine_type_centre;



ALTER TABLE etablissement 
	add type_autre_etablissement domaine_type_autre_etablissement;



CREATE TABLE IF NOT EXISTS intervention (
	id SERIAL PRIMARY KEY, 														-- commentaire pour les delete cascade
	demande_id INT NOT NULL REFERENCES demande(id),								-- si plus de demande, garder intervention pour stats -- 
	benevole_id INT REFERENCES benevole(id), 										--stats + benevole_id peut etre null quand l'intervention n'est pas encore attribuée --
	comite_id INT NOT NULL REFERENCES comite(id), 								-- histoire des stats --
	etablissement_id INT NOT NULL REFERENCES etablissement(id), 				-- histoire des stats
	date_intervention DATE DEFAULT NULL, 
	lieu VARCHAR(:longueurChaineMoyenne) DEFAULT NULL, 
	nb_personne domaine_entier_nb_personne NOT NULL, 
	remarques VARCHAR(:longueurChaineLongue) DEFAULT NULL, 
	heure domaine_heure DEFAULT NULL,
	realisee BOOLEAN NOT NULL
);

-- Attributs de plaidoyer
ALTER TABLE intervention 
	add niveau_theme_id INT REFERENCES niveau_theme; 							-- stats --

ALTER TABLE intervention
	add materiel_dispo_plaidoyer type_materiel_plaidoyer[];

-- Attributs de frimousse
ALTER TABLE intervention
	add niveau_frimousse domaine_niveau_scolaire_limite; 

ALTER TABLE intervention
	add materiaux_frimousse type_materiel_frimousse[];

-- Attributs de autreIntervention
ALTER TABLE intervention
	add description VARCHAR(:longueurChaineLongue);

----------------------



CREATE TABLE IF NOT EXISTS vente (														-- on delete cascade --
	id SERIAL PRIMARY KEY, 
	etablissement_id INT REFERENCES etablissement(id), 									-- histoire de stats --
	intervention_id INT DEFAULT NULL REFERENCES intervention(id), 						-- histoire de stats --
	chiffre_affaire DOUBLE PRECISION NOT NULL, 
	date_vente DATE NOT NULL, 
	remarques VARCHAR(:longueurChaineLongue) DEFAULT NULL 
);


-- Relations Many-To-Many --

CREATE TABLE IF NOT EXISTS benevole_comite (
	benevole_id INT REFERENCES benevole(id) ON DELETE CASCADE, 
	comite_id INT REFERENCES comite(id) ON DELETE CASCADE, 
	PRIMARY KEY(benevole_id, comite_id)
);


CREATE TABLE IF NOT EXISTS benevole_projet (
	benevole_id INT REFERENCES benevole(id) ON DELETE CASCADE, 								-- on veut garder pour les stats --
	projet_id INT REFERENCES projet(id) ON DELETE CASCADE, 
	PRIMARY KEY(benevole_id, projet_id)
);


CREATE TABLE IF NOT EXISTS appartient (
	etablissement_id INT REFERENCES etablissement(id) ON DELETE CASCADE, 
	contact_id INT REFERENCES contact(id) ON DELETE CASCADE, 
	PRIMARY KEY(etablissement_id, contact_id)
); 


CREATE TABLE IF NOT EXISTS participe (
	projet_id INT REFERENCES projet(id) ON DELETE CASCADE, 
	contact_id INT REFERENCES contact(id) ON DELETE CASCADE, 
	PRIMARY KEY(projet_id, contact_id)
);


CREATE TABLE IF NOT EXISTS ville_code_postal (
	ville_id INT REFERENCES ville(id) ON DELETE CASCADE,
	code_postal_id INT REFERENCES code_postal(id) ON DELETE CASCADE,  
	PRIMARY KEY(code_postal_id, ville_id)
);

CREATE TABLE IF NOT EXISTS comite_departement (
	comite_id INT REFERENCES comite(id) ON DELETE CASCADE, 
	departement_id INT REFERENCES departement(id) ON DELETE CASCADE, 
	PRIMARY KEY(comite_id, departement_id)
);


-- Définition des vues --

CREATE VIEW personne AS (
	SELECT email, prenom, tel_fixe, tel_portable
	FROM contact                                 
	UNION
	SELECT email, prenom, tel_fixe, tel_portable
	FROM benevole                               
);

CREATE VIEW plaidoyer AS (
	SELECT id, demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_theme_id, materiel_dispo_plaidoyer
	FROM intervention
	WHERE niveau_theme_id is not null AND materiel_dispo_plaidoyer is not null
);

CREATE VIEW frimousse AS (
	SELECT id, demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, niveau_frimousse, materiaux_frimousse
	FROM intervention
	WHERE niveau_frimousse is not null AND materiaux_frimousse is not null
);

CREATE VIEW autre_intervention AS (
	SELECT id, demande_id, benevole_id, comite_id, etablissement_id, date_intervention, lieu, nb_personne, remarques, heure, realisee, description
	FROM intervention
	WHERE description is not null
);

CREATE VIEW enseignement AS (
	SELECT id, uai, adresse_id, nom, tel_fixe, emails, type_enseignement
	FROM etablissement
	WHERE type_enseignement is not null
);
CREATE VIEW centre_loisirs AS (
	SELECT id, uai, adresse_id, nom, tel_fixe, emails, type_centre
	FROM etablissement
	WHERE type_centre is not null
);
CREATE VIEW autre_etablissement AS (
	SELECT id, uai, adresse_id, nom, tel_fixe, emails, type_autre_etablissement
	FROM etablissement
	WHERE type_autre_etablissement is not null
);

-- Définition d une adresse fictive pour gérer le cas des bénévoles fictifs
--delete from adresse where id = 1;

--insert into adresse values (
--	'1',
--	'Fictive',
--	'Fictive',
--	'00000',
--	'0',
--	null,
--	null	
--);

-- Définition des fonctions --

create function recupererProjets(integer) returns setof integer as 
	'select projet_id from benevole_projet where benevole_id = $1 ;' language 'sql';

-- Définition des Triggers --


--CREATE OR REPLACE FUNCTION supprimerBenevole()
--RETURNS trigger AS $sup$
--DECLARE
--
--BEGIN 
	
--	INSERT INTO benevole VALUES (
--		OLD.id,
--		'benevole@fictif.com',
--		'benevole fictif',
--		'benevole fictif',
--		null,
--		null,
--		'1',
--		'fictif',
--		OLD.activites_potentielles,
--		OLD.responsabilite_activite
--	);

	
--	RETURN OLD;
--END $sup$ LANGUAGE 'plpgsql';


--CREATE TRIGGER  supprimerBenevole
--AFTER DELETE ON benevole
--FOR EACH ROW EXECUTE PROCEDURE supprimerBenevole();

-- implémenter fonction/trigger permettant de garder la relation many to many intact benovle_projet

