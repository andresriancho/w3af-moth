#
# To execute this script you should perform this steps:
#    1) mysql -u root -p -h localhost
#    2) mysql> source create_tables.sql
#

create database w3af_test;

use w3af_test;

create table agenda(
  id int not null auto_increment primary key,
  nombre VARCHAR(100),
  direccion VARCHAR(100),
  telefono VARCHAR(100),
  email VARCHAR(100)
);

insert into agenda (nombre,direccion,telefono,email) values ('andres','chac 1981','47789900','a@b.com');
insert into agenda (nombre,direccion,telefono,email) values ('pablo','case 2382','54110099','caa@acm.org');
insert into agenda (nombre,direccion,telefono,email) values ('juan','foos 2331','7985776','isnot@db.org');
insert into agenda (nombre,direccion,telefono,email) values ('carlos','bar 31','122333','acho@cybsec.com');

