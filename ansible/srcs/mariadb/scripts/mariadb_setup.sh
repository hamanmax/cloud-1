#!/bin/bash

# Installation du fichier de configuration Mariadb


/etc/init.d/mysql start
mv /my.cnf /etc/mysql/


# Creation des Bases de donnees Wordpress
mysql -u root -e "CREATE DATABASE wordpress"
mysql -u root -e "CREATE USER 'wp_user' IDENTIFIED BY 'wp_password'"
mysql -u root -e "GRANT USAGE ON wordpess.* TO 'wp_user'@'%' IDENTIFIED BY 'wp_password' WITH GRANT OPTION"
mysql -u root -e "GRANT ALL PRIVILEGES ON wordpress.* TO 'wp_user'@'%' IDENTIFIED BY 'wp_password' WITH GRANT OPTION;"

# Import d'une base de donnees pre configurer
mysql -u root wordpress < wpdatabase.sql

# Ajout des utilisateurs SuperUser(Admin),ainsi que User
mysql -u root -e "INSERT INTO wordpress.wp_users (ID, user_login, user_pass, user_nicename, user_email, user_status, display_name)  VALUES ('1', 'SuperUser', MD5('SuperUser'), 'SuperUser', 'SuperUser@SuperUser.com', '0', 'SuperUser');"
mysql -u root -e "INSERT INTO wordpress.wp_usermeta (umeta_id, user_id, meta_key, meta_value) VALUES (1,1,'nickname','SuperUSer'),(2,1,'first_name',''),(3,1,'last_name',''),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'syntax_highlighting','true'),(7,1,'comment_shortcuts','false'),(8,1,'admin_color','fresh'),(9,1,'use_ssl','0'),(10,1,'show_admin_bar_front','true'),(11,1,'locale',''),(12,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(13,1,'wp_user_level','10'),(14,1,'dismissed_wp_pointers',''),(15,1,'show_welcome_panel','1'),(16,1,'session_tokens','a:1:{s:64:\"24fbb85958f8e726722846f7cc9b9e621628b2cbe03c735b172d7a57528a6815\";a:4:{s:10:\"expiration\";i:1632099103;s:2:\"ip\";s:10:\"172.20.0.1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Safari/537.36\";s:5:\"login\";i:1631926303;}}'),(17,1,'wp_dashboard_quick_press_last_post_id','4'),(18,1,'community-events-location','a:1:{s:2:\"ip\";s:10:\"172.20.0.0\";}');"
mysql -u root -e "INSERT INTO wordpress.wp_users (ID, user_login, user_pass, user_nicename, user_email, user_status, display_name)  VALUES ('2', 'User', MD5('User'), 'User', 'User@User.com', '0', 'User');"

#Suppresion du fichier SQL
rm wpdatabase.sql
