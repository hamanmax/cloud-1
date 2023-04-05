FROM debian:buster

RUN apt-get update -qq -y && apt-get upgrade -qq -y && apt-get install php php-fpm php-cli  php7.3-mysql wget -y
RUN service php7.3-fpm start
COPY conf/www.conf /etc/php/7.3/fpm/pool.d/
RUN mkdir -p /var/www/wordpress
COPY wordpress /var/www/wordpress
ARG MYSQLWPUSER
ARG MYSQLWPDATABASE
ARG MYSQLWPPASSWORD
ARG MYSQLHOSTNAME

ENTRYPOINT ["./usr/sbin/php-fpm7.3", "-F"]
