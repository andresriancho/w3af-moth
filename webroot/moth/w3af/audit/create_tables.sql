#
# To execute this script you should perform this steps:
#    1) mysql -u root -p -h localhost
#    2) mysql> source create_tables.sql
#
drop database w3af_test;

create database w3af_test;

use w3af_test;

# This is on one line, because of recreate_tables.php
create table users( id int not null auto_increment primary key,  name VARCHAR(100),  address VARCHAR(100),  phone VARCHAR(100),  email VARCHAR(100));

insert into users (name,address,phone,email) values ('andres','chac 1981','47789900','a@b.com');
insert into users (name,address,phone,email) values ('pablo','case 2382','54110099','caa@acm.org');
insert into users (name,address,phone,email) values ('juan','foos 2331','7985776','isnot@db.org');
insert into users (name,address,phone,email) values ('carlos','bar 31','122333','andres@bonsai-sec.com');

