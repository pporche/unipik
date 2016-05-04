
#a copier coller
sudo -i -u postgres
psql -d bdunicef -c "INSERT INTO my_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, mail, nom, prenom, telFixe, telPortable) VALUES ('174', 'admin', 'admin', 'admin@admin.admin', 'admin@admin.admin', true, '3ar576dvu76soswskk8gwsks8cgkg44', '$2y$13$iUW6/KVzaux5HD0rVkpAq.MJyyKEo8XdKBdFe/DRJKobRauMal3Um', NULL, false, false, NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', false, NULL, 'l', 'l', 'l', 'l', 'l');"
exit
