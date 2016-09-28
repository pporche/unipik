-- version 1.01, date 12/09/2016, auteur Julie Pain
-- permet d'ajouter un benevole avec l'user name admin

INSERT INTO pays (id,nom) VALUES (1,'France');
INSERT INTO region (id,nom,pays_id) VALUES (1,'Normandie',1);
INSERT INTO departement (id,nom,numero,region_id) VALUES (1,'Seine-Maritime',76,1);
INSERT INTO code_postal (id,code,departement_id) VALUES (1,'76000',1);
INSERT INTO ville (id,nom) VALUES (1,'Rouen');
INSERT INTO ville_code_postal (ville_id,code_postal_id) VALUES (1,1);
INSERT INTO adresse (id, adresse,complement,ville_id,geolocalisation) VALUES (1,'blabla','blabla',1,ST_GeographyFromText('SRID=4326;POINT(-110.256 30.5454)'));
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id) VALUES ('admin', 'admin', 'admin@admin.admin', 'admin@admin.admin', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', false, NULL,'admin','admin',NULL,NULL,1);
