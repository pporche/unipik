-- version 1.02, date 29/09/2016, auteur Melissa
-- mise à jour par rapport a la nouvelle bd
-- version 1.01, date 12/09/2016, auteur Julie Pain
-- permet d'ajouter un benevole avec l'user name admin



ALTER SEQUENCE benevole_id_seq RESTART WITH 1;
INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id) VALUES ('admin', 'admin', 'admin@admin.admin', 'admin@admin.admin', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', false, NULL,'admin','admin',NULL,NULL,1);
