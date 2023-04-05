#!/bin/bash

#Installation des fichier de phpmyadmin


mkdir -p /var/www/phpmyadmin
mv phpmyadmin /var/www/


#Installation des fichiers de configuration Php
mv www.conf /etc/php/7.3/fpm/pool.d/

#Lancement du service php7.3
service php7.3-fpm start
