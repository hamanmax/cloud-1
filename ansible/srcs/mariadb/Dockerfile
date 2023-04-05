FROM debian:buster

RUN apt-get update -qq -y && apt-get upgrade -qq -y && apt-get install -qq -y mariadb-server
COPY conf/wpdatabase.sql /
COPY conf/my.cnf /
COPY scripts/mariadb_setup.sh /
ARG MYSQLROOTPASSWORD
ARG MYSQLWPUSER
ARG MYSQLWPDATABASE
ARG MYSQLWPPASSWORD
ARG MYSQLHOSTNAME
ARG SUPERUSERPASSWORD
ARG USERPASSWORD
RUN bash mariadb_setup.sh
RUN rm mariadb_setup.sh
ENTRYPOINT [ "mysqld" ]
