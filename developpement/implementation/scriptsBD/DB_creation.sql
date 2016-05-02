-- Définition des Domaines --

CREATE DOMAIN  domaine_semaine AS INT
CHECK (VALUE <54 AND VALUE >0);

CREATE DOMAIN domaine_jour AS VARCHAR(10)
CHECK (VALUE IN ('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'));

CREATE DOMAIN domaine_moment_quotidien AS VARCHAR(15)
CHECK (VALUE IN ('matin', 'apres-midi', 'soir'));

CREATE DOMAIN domaine_type_contact AS VARCHAR(20)
CHECK (VALUE IN ('enseignant', 'animateur', 'eleve', 'etudiant', 'autre'));

CREATE DOMAIN domaine_activite AS VARCHAR(30)
CHECK (VALUE IN ('actions ponctuelles', 'plaidoyers', 'frimousses', 'projets', 'autre'));

CREATE DOMAIN domaine_type_projet AS VARCHAR(20)
CHECK (VALUE IN ('primaire', 'college', 'lycee', 'superieur'));

CREATE DOMAIN domaine_type_enseignement AS VARCHAR(25)
CHECK (VALUE IN ('maternelle', 'elementaire', 'college', 'lycee', 'superieur'));

CREATE DOMAIN domaine_type_centre AS VARCHAR(25)
CHECK (VALUE IN ('maternelle', 'elémentaire', 'adolescent', 'autre'));

CREATE DOMAIN domaine_type_autre_etablissement AS VARCHAR(20)
CHECK (VALUE IN ('mairie', 'maison de retraite', 'autre'));

CREATE DOMAIN domaine_materiel_plaidoyer AS VARCHAR(30)
CHECK (VALUE IN ('videoprojecteur', 'tableau interactif', 'enceinte', 'autre'));

CREATE DOMAIN domaine_materiel_frimousse AS VARCHAR(20)
CHECK (VALUE IN ('patron', 'bourre', 'decoration'));

CREATE DOMAIN domaine_niveau_scolaire_complet AS VARCHAR(50)
CHECK (VALUE IN ('petite section', 'petie-moyenne section', 'moyenne section', 'moyenne-grande section', 'grande section', 'petite-moyenne-grande section',
                 'CP', 'CP-CE1', 'CE1', 'CE1-CE2', 'CE2', 'CE2-CM1', 'CM1', 'CM1-CM2', 'CM2', 
                 '6eme', '5eme', '4eme', '3eme', '2nde', '1ere', 'terminale', 
                 'L1', 'L2', 'L3', 'M1', 'M2',
                 'autre'
      ));

CREATE DOMAIN domaine_niveau_scolaire_limite AS VARCHAR(15)
CHECK (VALUE IN ('CP', 'CP-CE1', 'CE1', 'CE1-CE2', 'CE2', 'CE2-CM1', 'CM1', 'CM1-CM2', 'CM2', 'autre'));

CREATE DOMAIN domaine_theme AS VARCHAR(100)
CHECK (VALUE IN ('convention internationale des droits de l enfant', 'education', 'sante en generale', 'sante et alimentation', 'VIH et sida', 'eau', 'urgences mondiales', 'travail des enfants', 'enfants et soldats', 'harcelement', 'role de l Unicef', 'millenaire pour le developpement' ));

CREATE DOMAIN domaine_email AS VARCHAR(100)
CHECK (VALUE ~ '^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$' );

CREATE DOMAIN domaine_region_de_france AS VARCHAR(100)
CHECK (VALUE IN ('Nord-Pas-de-Calais Picardie', 'Normandie', 'Bretagne', 'Ile de France', 'Alsace Lorraine Champagne-Ardennes', 'Pays-de-la-Loire', 'Centre',
				 'Bourgogne Franche-Comte', 'Aquitaine Limousin Poitou-Charentes', 'Auvergne Rhone-Alpes', 'Midi-Pyrenees Languedoc-Roussillon', 'Corse', 'Provence-Alpes-Cote-D Azur'
		));

CREATE DOMAIN domaine_departement_de_france AS VARCHAR(100)
CHECK (VALUE IN ('Ain', 'Aisne', 'Allier','Alpes-de-Haute-Provence', 'Hautes-Alpes', 'Alpes-Maritimes', 'Ardeche', 'Ardennes', 'Ariege', 'Aube', 'Aude', 'Aveyron', 'Bouches-du-Rhone',
				 'Calvados', 'Cantal', 'Charente', 'Charente-Maritime', 'Cher', 'Correze', 'Corse-du-Sud', 'Haute-Corse', 'Cote-d or', 'Cotes-d Armor', 'Creuse', 'Dordogne', 'Doubs',
				 'Drome', 'Eure', 'Eure-et-Loir', 'Finistere', 'Gard', 'Haute-Garonne', 'Gers', 'Gironde', 'Herault', 'Ille-et-Vilaine', 'Indre', 'Indre-et-Loire', 'Isere', 'Jura', 'Landres',
				 'Loir-et-Cher', 'Loire', 'Haute-Loire', 'Loire-Atlantique', 'Loiret', 'Lot', 'Lot-et-Garonne', 'Lozere', 'Maine-et-Loire', 'Manche', 'Marne', 'Haute-Marne', 'Mayenne', 
				 'Meurthe-et-Moselle', 'Meuse', 'Morbihan', 'Moselle', 'Nievre', 'Nord', 'Oise', 'Orne', 'Pas-de-Calais', 'Puy-de-Dome', 'Pyrenees-Atlantiques', 'Hautes-Pyrenees',
				 'Pyrenees-Orientales', 'Bas-Rhin', 'Haut-Rhin', 'Rhone', 'Haute-Saone', 'Saone-et-Loire', 'Sarthe', 'Savoie', 'Haute-Savoie', 'Paris', 'Seine-Maritime', 'Seine-et-Marne',
				 'Yvelines', 'Deux-Sevres', 'Somme', 'Tarn', 'Tarn-et-Garonne', 'Var', 'Vaucluse', 'Vendee', 'Vienne', 'Haute-Vienne', 'Vosges', 'Yonne', 'Territoire de Belfort',
				 'Essonne', 'Hauts-de-Seine', 'Seine-Saint-Denis', 'Val-de-Marine', 'Val-d oise', 'Guadeloupe', 'Martinique', 'Guyane', 'La Reunion', 'Mayotte'
	));


CREATE DOMAIN domaine_code_postal AS VARCHAR(5)
CHECK (VALUE ~ '^[0-9]{5}$');

CREATE DOMAIN domaine_tel_portable AS VARCHAR(10)
CHECK (VALUE ~ '^[0-9]{10}$');

CREATE DOMAIN domaine_tel_fixe AS VARCHAR(10)
CHECK (VALUE ~ '^[0-9]{10}$');




CREATE DOMAIN domaine_type_activite AS VARCHAR(300)
CHECK (VALUE ~ '^((plaidoyers)|((frimousses)|(actions-ponctuelles)|(projets)|(autres)))(,((plaidoyers)|((frimousses)|(actions-ponctuelles)|(projets)|(autres)))){0,4}$');

CREATE DOMAIN domaine_type_email AS VARCHAR(200)
CHECK (VALUE ~ '^(([a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+)( , [a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+)*)?$' );

CREATE DOMAIN domaine_type_materiel_frimousse AS VARCHAR(24)
CHECK (VALUE ~ '^((patron)|((bourre)|(decoration)))(,((patron)|((bourre)|(decoration)))){0,2}$');

CREATE DOMAIN domaine_type_materiel_plaidoyer AS VARCHAR(49)
CHECK (VALUE ~ '^((videoprojecteur)|((tableau-interactif)|(enceinte)|(autre)))(,((videoprojecteur)|((tableau-interactif)|(enceinte)|(autre)))){0,3}$');

CREATE DOMAIN domaine_type_semaine AS VARCHAR(100)
CHECK (VALUE ~ '^((([1-4][0-9]?)|(5[0-3]?)|([6-9]))(\,(([1-4][0-9]?)|(5[0-3]?)|([6-9]))){0,52})$');


-- Définition des tables correspondant à des types -- 

CREATE TABLE IF NOT EXISTS adresse (
	id SERIAL PRIMARY KEY, 
	ville VARCHAR(100) NOT NULL, 
	rue VARCHAR(500) NOT NULL, 
	code_postal domaine_code_postal NOT NULL, 
	numero_de_rue VARCHAR(15) NOT NULL, 
	complement VARCHAR(100) DEFAULT NULL, 
	geolocalisation VARCHAR(255) DEFAULT NULL
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

--CREATE TYPE type_activite as (activite_potentielle activite);  						-- done
--CREATE TYPE type_email as (email  email);												-- done
--CREATE TYPE type_materiel_frimousse as (materiel_frimousse materiel_frimousse);		-- done
--CREATE TYPE type_materiel_plaidoyer as (materiel_plaidoyer materiel_plaidoyer);		-- done
--CREATE TYPE type_niveau_theme as (niveau_theme niveau_theme);							-- done avec table intermediaire
--CREATE TYPE type_moment as (moment_hebdomadaire moment_hebdomadaire);					-- done avec table intermediaire
--CREATE TYPE type_semaine as (semaine semaine);										-- done

-- Création des tables --

CREATE TABLE IF NOT EXISTS benevole (
	id SERIAL PRIMARY KEY,
	email domaine_email,
	nom VARCHAR(100) NOT NULL,
	prenom VARCHAR(100) DEFAULT NULL, 
	tel_fixe domaine_tel_fixe DEFAULT NULL, 
	tel_portable domaine_tel_portable DEFAULT NULL,
	adresse_id INT REFERENCES adresse(id) ON DELETE CASCADE, 
	mdp VARCHAR(50) NOT NULL,
	activites_potentielles domaine_type_activite DEFAULT NULL
);

--------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admin_activite (
	responsabilite_activite domaine_type_activite NOT NULL
)INHERITS(benevole);

ALTER TABLE admin_activite
	add CONSTRAINT id_admin_activite
 	PRIMARY KEY (id);

CREATE SEQUENCE admin_activite_id_seq;

--------------------------------------------------------------

CREATE TABLE IF NOT EXISTS admin_comite (

)INHERITS(benevole);

ALTER TABLE admin_comite
	add CONSTRAINT id_admin_comite
	PRIMARY KEY (id);

CREATE SEQUENCE admin_comite_id_seq;

--------------------------------------------------------------

CREATE TABLE IF NOT EXISTS admin_region (

)INHERITS(benevole);

ALTER TABLE admin_region
	add CONSTRAINT id_admin_region
	PRIMARY KEY(id);

CREATE SEQUENCE admin_region_id_seq;


CREATE TABLE IF NOT EXISTS contact (
	id SERIAL PRIMARY KEY,
	email domaine_email,
	nom VARCHAR(100) NOT NULL,
	prenom VARCHAR(100) DEFAULT NULL, 
	tel_fixe domaine_tel_fixe DEFAULT NULL, 
	tel_portable domaine_tel_portable DEFAULT NULL,
	type_contact domaine_type_contact NOT NULL
);



CREATE TABLE IF NOT EXISTS projet (
	id SERIAL PRIMARY KEY, 
	chiffre_affaire DOUBLE PRECISION NOT NULL, 
	remarques TEXT DEFAULT NULL, 
	type domaine_type_projet NOT NULL, 
	nom VARCHAR(1000) NOT NULL
);



CREATE TABLE IF NOT EXISTS pays (
	id SERIAL PRIMARY KEY,
	nom VARCHAR(100)
);


CREATE TABLE IF NOT EXISTS region (
	id SERIAL PRIMARY KEY,
	nom domaine_region_de_france, 
	pays_id INT REFERENCES pays(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS comite (
	id SERIAL PRIMARY KEY, 
	region_id INT REFERENCES region(id) ON DELETE CASCADE, 
	nom_departement domaine_departement_de_france NOT NULL
);

-- yaura du trigger ici --

CREATE TABLE IF NOT EXISTS comite_niveau_theme (
	id_comite INT REFERENCES comite(id) ON DELETE CASCADE,
	id_niveau_theme INT REFERENCES niveau_theme(id) ON DELETE CASCADE,
	PRIMARY KEY (id_comite, id_niveau_theme)
);


CREATE TABLE IF NOT EXISTS demande (
	id SERIAL PRIMARY KEY, 
	contact_id INT REFERENCES contact(id) ON DELETE CASCADE, 
	date DATE NOT NULL,
	liste_semaine domaine_type_semaine NOT NULL
);

-- yaura du trigger ici --

CREATE TABLE IF NOT EXISTS demande_moments_voulus (
	id_demande INT REFERENCES demande(id) ON DELETE CASCADE,
	id_moment_hebdomadaire INT REFERENCES moment_hebdomadaire(id) ON DELETE CASCADE,
	PRIMARY KEY (id_demande, id_moment_hebdomadaire)
);

CREATE TABLE IF NOT EXISTS demande_moments_voulus (
	id_demande INT REFERENCES demande(id) ON DELETE CASCADE,
	id_moment_hebdomadaire INT REFERENCES moment_hebdomadaire(id) ON DELETE CASCADE,
	PRIMARY KEY (id_demande, id_moment_hebdomadaire)
);


CREATE TABLE IF NOT EXISTS etablissement (
	id SERIAL PRIMARY KEY,
	uai VARCHAR(100), 
	adresse_id INT REFERENCES adresse(id) ON DELETE CASCADE, 
	nom VARCHAR(100) DEFAULT NULL, 
	tel_fixe domaine_tel_fixe DEFAULT NULL,
	emails domaine_type_email NOT NULL
);

ALTER TABLE etablissement
	add type_enseignement domaine_type_enseignement;

CREATE VIEW enseignement AS (
	SELECT id, uai, adresse_id, nom, tel_fixe, emails, type_enseignement
	FROM etablissement
	WHERE type_enseignement is not null
);

ALTER TABLE etablissement
	add type_centre domaine_type_centre;

CREATE VIEW centre_loisirs AS (
	SELECT id, uai, adresse_id, nom, tel_fixe, emails, type_centre
	FROM etablissement
	WHERE type_centre is not null
);

ALTER TABLE etablissement 
	add type_autre_etablissement domaine_type_autre_etablissement;

CREATE VIEW autre_etablissement AS (
	SELECT id, uai, adresse_id, nom, tel_fixe, emails, type_autre_etablissement
	FROM etablissement
	WHERE type_autre_etablissement is not null
);



CREATE TABLE IF NOT EXISTS intervention (
	id SERIAL PRIMARY KEY, 
	demande_id INT REFERENCES demande(id) ON DELETE CASCADE, 
	benevole_id INT REFERENCES benevole(id) ON DELETE CASCADE, 
	comite_id INT REFERENCES comite(id) ON DELETE CASCADE, 
	etablissement_id INT REFERENCES etablissement(id) ON DELETE CASCADE, 
	date DATE DEFAULT NULL, 
	lieu VARCHAR(40) DEFAULT NULL, 
	nb_personne INT NOT NULL, 
	remarques TEXT DEFAULT NULL, 
	moment domaine_moment_quotidien DEFAULT NULL, 
	type VARCHAR(255) NOT NULL
);

-- Attributs de plaidoyer
ALTER TABLE intervention 
	add niveau_theme_id INT REFERENCES niveau_theme ON DELETE CASCADE; --  NOT NULL

ALTER TABLE intervention
	add materiel_dispo_plaidoyer domaine_type_materiel_plaidoyer;

-- Atributs de frimousse
ALTER TABLE intervention
	add niveau_frimousse domaine_niveau_scolaire_limite; --not null

ALTER TABLE intervention
	add materiaux_frimousse domaine_type_materiel_frimousse;

-- Attributs de autreIntervention
ALTER TABLE intervention
	add description VARCHAR(250);

----------------------



CREATE TABLE IF NOT EXISTS vente (
	id SERIAL PRIMARY KEY, 
	etablissement_id INT REFERENCES etablissement(id) ON DELETE CASCADE, 
	intervention_id INT DEFAULT NULL REFERENCES intervention(id) ON DELETE CASCADE, 
	chiffre_affaire DOUBLE PRECISION NOT NULL, 
	date DATE NOT NULL, 
	remarques TEXT DEFAULT NULL 
);


-- Relations Many-To-Many --

CREATE TABLE IF NOT EXISTS benevole_comite (
	benevole_id INT REFERENCES benevole(id) ON DELETE CASCADE, 
	projet_id INT REFERENCES projet(id) ON DELETE CASCADE, 
	PRIMARY KEY(benevole_id, projet_id)
);


CREATE TABLE IF NOT EXISTS benevole_projet (
	benevole_id INT REFERENCES benevole(id) ON DELETE CASCADE, 
	comite_id INT REFERENCES comite(id) ON DELETE CASCADE, 
	PRIMARY KEY(benevole_id, comite_id)
);


CREATE TABLE IF NOT EXISTS appartient (
	etablissement_id INT REFERENCES etablissement(id) ON DELETE CASCADE, 
	contact_id INT REFERENCES contact(id) ON DELETE CASCADE, 
	respo_etablissement BOOLEAN NOT NULL,
	type_activite domaine_type_activite,
	PRIMARY KEY(etablissement_id, contact_id)
); 


CREATE TABLE IF NOT EXISTS participe (
	projet_id INT REFERENCES projet(id) ON DELETE CASCADE, 
	contact_id INT REFERENCES contact(id) ON DELETE CASCADE, 
	est_tuteur BOOLEAN NOT NULL, 
	PRIMARY KEY(projet_id, contact_id)
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
	SELECT id, demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, moment, type, niveau_theme_id, materiel_dispo_plaidoyer
	FROM intervention
	WHERE niveau_theme_id is not null AND materiel_dispo_plaidoyer is not null
);

CREATE VIEW frimousse AS (
	SELECT id, demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, moment, type, niveau_frimousse, materiaux_frimousse
	FROM intervention
	WHERE niveau_frimousse is not null AND materiaux_frimousse is not null
);

CREATE VIEW autre_intervention AS (
	SELECT id, demande_id, benevole_id, comite_id, etablissement_id, date, lieu, nb_personne, remarques, moment, type, description
	FROM intervention
	WHERE description is not null
);




-- Définition des Triggers --




