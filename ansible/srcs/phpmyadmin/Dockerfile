FROM debian:buster

RUN apt-get update -qq -y && apt-get upgrade -qq -y && apt-get install php php-fpm php-cli  php7.3-mysql wget -y
COPY conf/www.conf /
COPY scripts/phpmyadmin_setup.sh /
COPY phpmyadmin/ /phpmyadmin
RUN bash phpmyadmin_setup.sh
RUN rm phpmyadmin_setup.sh
ENTRYPOINT ["./usr/sbin/php-fpm7.3", "-F"]
