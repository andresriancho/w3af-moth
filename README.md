## w3af's moth

A set of vulnerable PHP scripts used to test w3af's vulnerability detection features.

The main repository for the [w3af project](https://github.com/andresriancho/w3af/) can be found [here](https://github.com/andresriancho/w3af/).

## History

`Moth` was born as a test environment for the [w3af project](https://github.com/andresriancho/w3af/) can be found [here](https://github.com/andresriancho/w3af/). The code that lives in this repository was usually bundled in a Virtual Machine and used from there.

After years of development I decided to move most of the features provided by this code to two different repositories:
 * https://github.com/andresriancho/django-moth
 * https://github.com/andresriancho/php-moth

The decision was made while writing unittests for `w3af`, which needed to run easily on our CI system, and `w3af-moth` wasn't designed to be used in that way (too many custom Apache configs, ugly PHP configs, etc).

Django-moth, received most of the attention and code. This is the repository which holds most of the test cases for the `w3af` framework.

PHP-moth is a much smaller test suite which only contains test scripts for PHP-specific vulnerabilities.

## Installation

```
sudo -s -H
apt-get update
apt-get dist-upgrade

# Enter "moth" as root password for mysql
apt-get install lamp-server^
echo "ServerName localhost" | sudo tee /etc/apache2/conf-available/fqdn.conf && sudo a2enconf fqdn

# Get moth's source code
apt-get install git
cd /var/www/
git clone https://github.com/andresriancho/w3af-moth.git

# Set short tags in php.ini
# short_open_tag=On

# Setup mysql database
mysql -uroot -pmoth
create database w3af_test;
exit
mysql -uroot -pmoth -hlocalhost w3af_test < w3af_test.sql
```

## Deprecation warning

While you can still use this repository for testing your scanner, education or any other purpose, I don't guarantee that I'll fix bugs, issues, or improve it in any way.
