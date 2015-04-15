FROM ubuntu:10.04
MAINTAINER Andres Riancho <andres.riancho@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install -y openssh-server supervisor
RUN mkdir -p /var/run/sshd
RUN mkdir -p /var/log/supervisor

RUN apt-get install -y lamp-server^ mysql-client joe

RUN useradd ubuntu -d /home/ubuntu
RUN mkdir -p /home/ubuntu/.ssh
RUN chmod 700 /home/ubuntu/.ssh
RUN chown ubuntu:ubuntu /home/ubuntu/.ssh

# Apache configuration from moth
RUN rm -rf /etc/apache2/
ADD apache2config/ /etc/apache2/

# Some modules are not enabled yet
RUN rm -rf /etc/apache2/mods-enabled/jk.*
RUN rm -rf /etc/apache2/mods-enabled/mod-security.*
RUN rm -rf /etc/apache2/mods-enabled/python.*
RUN rm -rf /etc/apache2/mods-enabled/ssl.*

#
# MySQL configuration
#

# Remove syslog configuration
RUN rm /etc/mysql/conf.d/mysqld_safe_syslog.cnf

# Add MySQL configuration
ADD docker/my.cnf /etc/mysql/conf.d/my.cnf
ADD docker/mysqld_charset.cnf /etc/mysql/conf.d/mysqld_charset.cnf

#
# PHP configuration
#
RUN sed -ri 's/^display_errors\s*=\s*Off/display_errors = On/g' /etc/php5/apache2/php.ini
RUN sed -ri 's/^error_reporting\s*=.*$/error_reporting = E_ALL \& ~E_DEPRECATED \& ~E_NOTICE/g' /etc/php5/apache2/php.ini
RUN sed -ri 's/^short_open_tag\s*=\s*Off/short_open_tag = On/g' /etc/php5/apache2/php.ini

# Allow root to login
RUN sed -ri 's/^PermitRootLogin.*$/PermitRootLogin yes/g' /etc/ssh/sshd_config

# Webroot for moth
RUN rm -rf /var/www/
ADD webroot/ /var/www
RUN chown -R root:root /var/www

# And some specific configurations to make the app more vulnerable
RUN rm -rf /var/www/moth/w3af/audit/xss/stored/data.txt
RUN touch /var/www/moth/w3af/audit/xss/stored/data.txt
RUN chown www-data: /var/www/moth/w3af/audit/xss/stored/data.txt

ADD docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD docker/run /usr/local/bin/
RUN chmod +x /usr/local/bin/run

RUN rm -rf /var/lib/apt/lists/*

EXPOSE 22 80 3306
CMD ["/usr/local/bin/run"]
