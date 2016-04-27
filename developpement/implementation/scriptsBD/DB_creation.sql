-- Définition des Domaines --

CREATE DOMAIN  semaine AS INT
CHECK (VALUE <54 AND VALUE >0);

CREATE DOMAIN jour AS VARCHAR(10)
CHECK (VALUE IN ('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'));

CREATE DOMAIN moment_quotidien AS VARCHAR(15)
CHECK (VALUE IN ('matin', 'apres-midi', 'soir'));

CREATE DOMAIN type_contact AS VARCHAR(20)
CHECK (VALUE IN ('enseignant', 'animateur', 'eleve', 'etudiant', 'autre'));

CREATE DOMAIN activite AS VARCHAR(30)
CHECK (VALUE IN ('actions ponctuelles', 'plaidoyers', 'frimousses', 'projets', 'autre'));

CREATE DOMAIN type_projet AS VARCHAR(20)
CHECK (VALUE IN ('primaire', 'college', 'lycee', 'superieur'));

CREATE DOMAIN type_enseignement AS VARCHAR(25)
CHECK (VALUE IN ('maternelle', 'elementaire', 'college', 'lycee', 'superieur'));

CREATE DOMAIN type_centre AS VARCHAR(25)
CHECK (VALUE IN ('maternelle', 'elémentaire', 'adolescent', 'autre'));

CREATE DOMAIN type_autre_etablissement AS VARCHAR(20)
CHECK (VALUE IN ('mairie', 'maison de retraite', 'autre'));

CREATE DOMAIN materiel_plaidoyer AS VARCHAR(30)
CHECK (VALUE IN ('videoprojecteur', 'tableau interactif', 'enceinte', 'autre'));

CREATE DOMAIN materiel_frimousse AS VARCHAR(20)
CHECK (VALUE IN ('patron', 'bourre', 'decoration'));

CREATE DOMAIN niveau_scolaire_complet AS VARCHAR(50)
CHECK (VALUE IN ('petite section', 'petie-moyenne section', 'moyenne section', 'moyenne-grande section', 'grande section', 'petite-moyenne-grande section',
                 'CP', 'CP-CE1', 'CE1', 'CE1-CE2', 'CE2', 'CE2-CM1', 'CM1', 'CM1-CM2', 'CM2', 
                 '6eme', '5eme', '4eme', '3eme', '2nde', '1ere', 'terminale', 
                 'L1', 'L2', 'L3', 'M1', 'M2',
                 'autre'
      ));

CREATE DOMAIN niveau_scolaire_limite AS VARCHAR(15)
CHECK (VALUE IN ('CP', 'CP-CE1', 'CE1', 'CE1-CE2', 'CE2', 'CE2-CM1', 'CM1', 'CM1-CM2', 'CM2', 'autre'));

CREATE DOMAIN theme AS VARCHAR(100)
CHECK (VALUE IN ('convention internationale des droits de l enfant', 'education', 'sante en generale', 'sante et alimentation', 'VIH et sida', 'eau', 'urgences mondiales', 'travail des enfants', 'enfants et soldats', 'harcelement', 'role de l Unicef', 'millenaire pour le developpement' ));

drop table nulll;
drop domain email;

CREATE DOMAIN email AS VARCHAR(100)
CHECK (VALUE ~ '^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$' );

create table nulll (email email);
insert into nulll values ('mich@insa-rouenfr');

-- #triche --

drop table canard;
drop domain triche_activite;

CREATE DOMAIN triche_activite AS VARCHAR(300)
CHECK (VALUE ~ '^((plaidoyers)?((frimousses)?(actions-ponctuelles)?(projets)?(autres)?))(,((plaidoyers)?((frimousses)?(actions-ponctuelles)?(projets)?(autres)?))){1,4}$');

create table canard (id SERIAL PRIMARY KEY, activiteTableau triche_activite);

insert into canard values ('1', 'plaidoyers');



drop table swag;
drop domain triche_email;

CREATE DOMAIN triche_email AS VARCHAR(200)
CHECK (VALUE ~ '^(([a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+)( , [a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+)*)?$' );

CREATE TABLE swag (lll triche_email);

INSERT INTO swag values ('mich@insa-rouen.fr , julie@jolie.fr , onch@onch.com');

-------






CREATE DOMAIN region_de_france AS VARCHAR(100)
CHECK (VALUE IN ('Nord-Pas-de-Calais Picardie', 'Normandie', 'Bretagne', 'Ile de France', 'Alsace Lorraine Champagne-Ardennes', 'Pays-de-la-Loire', 'Centre',
				 'Bourgogne Franche-Comte', 'Aquitaine Limousin Poitou-Charentes', 'Auvergne Rhone-Alpes', 'Midi-Pyrenees Languedoc-Roussillon', 'Corse', 'Provence-Alpes-Cote-D Azur'
		));

CREATE DOMAIN departement_de_france AS VARCHAR(100)
CHECK (VALUE IN ('Ain', 'Aisne', 'Allier','Alpes-de-Haute-Provence', 'Hautes-Alpes', 'Alpes-Maritimes', 'Ardeche', 'Ardennes', 'Ariege', 'Aube', 'Aude', 'Aveyron', 'Bouches-du-Rhone',
				 'Calvados', 'Cantal', 'Charente', 'Charente-Maritime', 'Cher', 'Correze', 'Corse-du-Sud', 'Haute-Corse', 'Cote-d or', 'Cotes-d Armor', 'Creuse', 'Dordogne', 'Doubs',
				 'Drome', 'Eure', 'Eure-et-Loir', 'Finistere', 'Gard', 'Haute-Garonne', 'Gers', 'Gironde', 'Herault', 'Ille-et-Vilaine', 'Indre', 'Indre-et-Loire', 'Isere', 'Jura', 'Landres',
				 'Loir-et-Cher', 'Loire', 'Haute-Loire', 'Loire-Atlantique', 'Loiret', 'Lot', 'Lot-et-Garonne', 'Lozere', 'Maine-et-Loire', 'Manche', 'Marne', 'Haute-Marne', 'Mayenne', 
				 'Meurthe-et-Moselle', 'Meuse', 'Morbihan', 'Moselle', 'Nievre', 'Nord', 'Oise', 'Orne', 'Pas-de-Calais', 'Puy-de-Dome', 'Pyrenees-Atlantiques', 'Hautes-Pyrenees',
				 'Pyrenees-Orientales', 'Bas-Rhin', 'Haut-Rhin', 'Rhone', 'Haute-Saone', 'Saone-et-Loire', 'Sarthe', 'Savoie', 'Haute-Savoie', 'Paris', 'Seine-Maritime', 'Seine-et-Marne',
				 'Yvelines', 'Deux-Sevres', 'Somme', 'Tarn', 'Tarn-et-Garonne', 'Var', 'Vaucluse', 'Vendee', 'Vienne', 'Haute-Vienne', 'Vosges', 'Yonne', 'Territoire de Belfort',
				 'Essonne', 'Hauts-de-Seine', 'Seine-Saint-Denis', 'Val-de-Marine', 'Val-d oise', 'Guadeloupe', 'Martinique', 'Guyane', 'La Reunion', 'Mayotte'
	));


CREATE DOMAIN code_postal AS VARCHAR(5)
CHECK (VALUE ~ '^[0-9]{5}$');

CREATE DOMAIN tel_portable AS VARCHAR(10)
CHECK (VALUE ~ '^[0-9]{10}$');

CREATE DOMAIN tel_fixe AS VARCHAR(10)
CHECK (VALUE ~ '^[0-9]{10}$');


-- Définition des tables correspondant à des types -- 

CREATE TABLE IF NOT EXISTS adresse (
	id SERIAL PRIMARY KEY, 
	ville VARCHAR(100) NOT NULL, 
	rue VARCHAR(500) NOT NULL, 
	code_postal code_postal NOT NULL, 
	numero_de_rue VARCHAR(15) NOT NULL, 
	complement VARCHAR(100) DEFAULT NULL, 
	geolocalisation VARCHAR(255) DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS niveau_theme (
	id SERIAL PRIMARY KEY,
	niveau niveau_scolaire_complet,
	theme theme
);


CREATE TABLE IF NOT EXISTS moment_hebdomadaire (
	id SERIAL PRIMARY KEY,
	jour jour NOT NULL, 
	moment moment_quotidien NOT NULL
);



-- Création des types pour les attributs multivalués -- 

CREATE TYPE type_activite as (activite_potentielle activite);
CREATE TYPE type_email as (email  email);
CREATE TYPE type_materiel_frimousse as (materiel_frimousse materiel_frimousse);
CREATE TYPE type_materiel_plaidoyer as (materiel_plaidoyer materiel_plaidoyer);
CREATE TYPE type_niveau_theme as (niveau_theme niveau_theme);
CREATE TYPE type_moment as (moment_hebdomadaire moment_hebdomadaire);
--CREATE TYPE type_semaine as (semaine semaine);--

-- Création des tables --

CREATE TABLE IF NOT EXISTS benevole (
	email email PRIMARY KEY,
	nom VARCHAR(100) NOT NULL,
	prenom VARCHAR(100) DEFAULT NULL, 
	tel_fixe tel_fixe DEFAULT NULL, 
	tel_portable tel_portable DEFAULT NULL,
	adresse_id INT REFERENCES adresse(id) ON DELETE CASCADE, 
	mdp VARCHAR(50) NOT NULL,
	activites_potentielles type_activite[] DEFAULT NULL
);
/* utilisation avec l'attribut multivalué : 
#insert into benevole values ('unEmail@gmail.com','unNom','unPrenom','0235363738','0607080910', 1,'blabla',  '{(frimousses),(projets)}');
*/


CREATE TABLE IF NOT EXISTS admin_activite (
	responsabilite_activite type_activite[] NOT NULL
)INHERITS(benevole);


CREATE TABLE IF NOT EXISTS admin_comite (

)INHERITS(benevole);


CREATE TABLE IF NOT EXISTS admin_region (

)INHERITS(benevole);


CREATE TABLE IF NOT EXISTS contact (
	email VARCHAR(100) PRIMARY KEY,
	nom VARCHAR(100) NOT NULL,
	prenom VARCHAR(100) DEFAULT NULL, 
	tel_fixe tel_fixe DEFAULT NULL, 
	tel_portable tel_portable DEFAULT NULL,
	type_contact type_contact NOT NULL
);



CREATE TABLE IF NOT EXISTS projet (
	id SERIAL PRIMARY KEY, 
	chiffre_affaire DOUBLE PRECISION NOT NULL, 
	remarques TEXT DEFAULT NULL, 
	type type_projet NOT NULL, 
	nom VARCHAR(1000) NOT NULL
);



CREATE TABLE IF NOT EXISTS pays (
	nom VARCHAR(100) PRIMARY KEY
);

--ici j'ai fais des changements --
--avant--
-- nom VARCHAR(100) PRIMARY KEY, --

CREATE TABLE IF NOT EXISTS region (
	nom region_de_france PRIMARY KEY, 
	pays_id VARCHAR(100) REFERENCES pays(nom) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS comite (
	id SERIAL PRIMARY KEY, 
	region_id VARCHAR(100) REFERENCES region(nom) ON DELETE CASCADE, 
	nom_departement departement_de_france NOT NULL,
	liste_niveau_theme type_niveau_theme[] NOT NULL
);


CREATE TABLE IF NOT EXISTS demande (
	id SERIAL PRIMARY KEY, 
	contact_id VARCHAR(100) REFERENCES contact(email) ON DELETE CASCADE, 
	date DATE NOT NULL,
--	liste_semaine type_semaine[] NOT NULL, 
	moments_voulus type_moment[],
	moments_a_eviter type_moment[]	
);


CREATE TABLE IF NOT EXISTS etablissement (
	id VARCHAR(100) PRIMARY KEY, 
	adresse_id INT REFERENCES adresse(id) ON DELETE CASCADE, 
	nom VARCHAR(100) DEFAULT NULL, 
	tel_fixe tel_fixe DEFAULT NULL,
	emails type_email[] NOT NULL
);


CREATE TABLE IF NOT EXISTS enseignement (
	type_enseignement type_enseignement NOT NULL
)INHERITS(etablissement);



CREATE TABLE IF NOT EXISTS centre_loisirs (
	type_centre type_centre NOT NULL
)INHERITS(etablissement);



CREATE TABLE IF NOT EXISTS autre_etablissement (
	type_autre_etablissement type_autre_etablissement NOT NULL
)INHERITS(etablissement);





CREATE TABLE IF NOT EXISTS intervention (
	id SERIAL PRIMARY KEY, 
	demande_id INT REFERENCES demande(id) ON DELETE CASCADE, 
	benevole_id VARCHAR(100) REFERENCES benevole(email) ON DELETE CASCADE, 
	comite_id INT REFERENCES comite(id) ON DELETE CASCADE, 
	etablissement_id VARCHAR(100) REFERENCES etablissement(id) ON DELETE CASCADE, 
	date DATE DEFAULT NULL, 
	lieu VARCHAR(40) DEFAULT NULL, 
	nb_personne INT NOT NULL, 
	remarques TEXT DEFAULT NULL, 
	moment moment_quotidien DEFAULT NULL, 
	type VARCHAR(255) NOT NULL
);



CREATE TABLE IF NOT EXISTS plaidoyer (
	niveau_theme_id INT NOT NULL REFERENCES niveau_theme ON DELETE CASCADE,
	materiel_dispo type_materiel_plaidoyer[]
)INHERITS(intervention); 


CREATE TABLE IF NOT EXISTS frimousse (
	niveau niveau_scolaire_limite NOT NULL,
	materiaux type_materiel_frimousse[]
)INHERITS(intervention); 


CREATE TABLE IF NOT EXISTS autre_intervention (
	description TEXT NOT NULL
)INHERITS(intervention);


CREATE TABLE IF NOT EXISTS vente (
	id SERIAL PRIMARY KEY, 
	etablissement_id VARCHAR(100) REFERENCES etablissement(id) ON DELETE CASCADE, 
	intervention_id INT DEFAULT NULL REFERENCES intervention(id) ON DELETE CASCADE, 
	chiffre_affaire DOUBLE PRECISION NOT NULL, 
	date DATE NOT NULL, 
	remarques TEXT DEFAULT NULL 
);


-- Relations Many-To-Many --

CREATE TABLE IF NOT EXISTS benevole_comite (
	benevole_id VARCHAR(100) REFERENCES benevole(email) ON DELETE CASCADE, 
	projet_id INT REFERENCES projet(id) ON DELETE CASCADE, 
	PRIMARY KEY(benevole_id, projet_id)
);


CREATE TABLE IF NOT EXISTS benevole_projet (
	benevole_id VARCHAR(100) REFERENCES benevole(email) ON DELETE CASCADE, 
	comite_id INT REFERENCES comite(id) ON DELETE CASCADE, 
	PRIMARY KEY(benevole_id, comite_id)
);


CREATE TABLE IF NOT EXISTS appartient (
	etablissement_id VARCHAR(100) REFERENCES etablissement(id) ON DELETE CASCADE, 
	contact_id VARCHAR(100) REFERENCES contact(email) ON DELETE CASCADE, 
	respo_etablissement BOOLEAN NOT NULL,
	type_activite type_activite[],
	PRIMARY KEY(etablissement_id, contact_id)
); 


CREATE TABLE participe (
	projet_id INT REFERENCES projet(id) ON DELETE CASCADE, 
	contact_id VARCHAR(100) REFERENCES contact(email) ON DELETE CASCADE, 
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



-- Définition des Triggers --




