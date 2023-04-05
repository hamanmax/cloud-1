FROM debian:buster
RUN apt-get update -qq -y && apt-get upgrade -qq -y 2> /dev/null
RUN apt-get install nginx openssl -y -qq
#RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt  -subj "/C=FR/ST=AURA/L=Lyon/O=42Lyon/CN="
#peut etre a modifier avec les vrais clef de mon serveur perso
COPY conf/phpmyadmin.hemadmax.ovh /etc/nginx/sites-available/
COPY conf/blog.hemadmax.ovh /etc/nginx/sites-available/
COPY conf/cert.pem /
COPY conf/privkey.pem /
RUN ln -s /etc/nginx/sites-available/blog.hemadmax.ovh /etc/nginx/sites-enabled/blog.hemadmax.ovh
RUN ln -s /etc/nginx/sites-available/phpmyadmin.hemadmax.ovh /etc/nginx/sites-enabled/phpmyadmin.hemadmax.ovh
RUN rm /etc/nginx/sites-available/default
RUN rm /etc/nginx/sites-enabled/default
ENTRYPOINT ["nginx", "-g", "daemon off;"]
EXPOSE 443
