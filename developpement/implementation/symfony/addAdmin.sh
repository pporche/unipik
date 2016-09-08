#version 1.01, date 11/05/2016, auteur Matthieu Martins-Baltar
#script pour ajouter un administrateur dans la base de donnée
#(la page pour ajouter un utilisateur nécessitant d'être déjà connecté en admin)

#Le script n'est actuellement pas exécutable, il faut le copier coller dans un terminal
sudo -i -u postgres
psql -d bdunicef -c "INSERT INTO adresse (ville,rue,code_postal,numero_de_rue,complement,geolocalisation) VALUES ('blabla','blabla','00000','blabla',NULL,NULL)"
psql -d bdunicef -c "INSERT INTO benevole (username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, nom, prenom, tel_fixe, tel_portable,adresse_id) VALUES ('admin', 'admin', 'admin@admin.admin', 'admin@admin.admin', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', false, NULL,'admin','admin',NULL,NULL,4);"
exit
php bin/console fos:user:change-password admin admin
