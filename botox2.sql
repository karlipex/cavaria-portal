create database if not exists botox default character set utf8 collate utf8_spanish_ci;
use botox;

create table cargo
(
 idcargo int not null auto_increment,
 descripcion varchar(100)not null,
 constraint pk_cargo primary key(idcargo)
);
alter table cargo  auto_increment= 1000;

insert into cargo(descripcion) values
('Asesor Ejecutivo de Paciente'),
('Asistente Médico'),
('Cajero'),
('Doctor'),
('Encargado de Sistema'),
('Asesor Ejecutivo de Paciente'),
('Gerente General'),
('Gerente de Operaciones'),
('Recepcionista')
;
select * from cargo;

create table permisos
(
 idpermisos int not null auto_increment,
 descripcion varchar(100)not null,
 constraint pk_permisos primary key(idpermisos)
);
alter table permisos  auto_increment= 1000;

insert into permisos(descripcion) values
('Administrador'),
('CAPE'),
('Cajero');

create table empleado
(
  idempleado int not null auto_increment,
  rut varchar(12) not null,
  nombre varchar(100) not null,
  paterno varchar(100)not null,
  materno varchar(100)not null,
  nacionalidad varchar(100)not null,
  fechanacimiento timestamp not null,
  profesion varchar(100) not null,
  direccion varchar(200) not null,
  comuna varchar(100) not null,
  ciudad varchar(100)not null,
  correo varchar(100)not null,
  estado varchar(100),
  constraint pk_empleado primary key(idempleado)
);

alter table empleado auto_increment=1000;

insert into empleado(rut,nombre,paterno,materno,nacionalidad,fechanacimiento,profesion,direccion,comuna,ciudad,correo,estado) value
('16.374.667-0','Felipe','Meza','Mora','Chilena','1986-08-13 00:00:00','Analista Programador Computacional','Alcalde Pedro alarcon #887','San Miguel','Santiago','felipe.mezam13@gmail.com','Activo');

insert into empleado(rut,nombre,paterno,materno,nacionalidad,fechanacimiento,profesion,direccion,comuna,ciudad,correo,estado) value
('9.357.515-6','Jeannette','Peralta','Fuentes','Chilena','1986-08-13 00:00:00','Sin información','Calle x','Maipu','Santiago','j.peralta@gmail.com','Activo');

create table contrato
(
  idcontrato int not null auto_increment,
  empleado int not null,
  fechainicio timestamp,
  fechatermino timestamp,
  tipocontrato varchar(100)not null,
  cargo int not null,
  horario varchar(300) not null,
  estado varchar(100),
  constraint pk_contrato primary key(idcontrato),
  constraint fk_cont_emp foreign key(empleado) references empleado(idempleado),
  constraint fk_cont_car foreign key(cargo) references cargo(idcargo)
);

alter table contrato auto_increment=1000;

insert into contrato(empleado,fechainicio,fechatermino,tipocontrato,cargo,horario,estado) values
(1000,'2017-03-01 00:00:00','2017-03-31 00:00:00','Plazo Fijo',1004,'De 09:00 a 19:00 de Lunes a Viernes','Activo');

insert into contrato(empleado,fechainicio,fechatermino,tipocontrato,cargo,horario,estado) values
(1000,'2017-03-01 00:00:00','2017-03-31 00:00:00','Plazo Fijo',1000,'De 09:00 a 19:00 de Lunes a Viernes','Activo');

create table usuario
(
 idusuario int not null auto_increment,
 empleado int not null,
 permisos int not null,
 usuario varchar(100) not null,
 password varchar(200) not null,
 correo varchar(100),
 estado varchar(100),
 constraint pk_usuario primary key(idusuario),
 constraint fk_empl_usu foreign key(empleado) references empleado(idempleado),
 constraint fk_per_usu foreign key(permisos) references permisos(idpermisos)
);

alter table usuario auto_increment=1000;

insert into usuario(empleado,permisos,usuario,password,correo,estado) values
(1000,1000,'fmeza','77148f84898f3d54be71a6120e795a24049a520b','fmeza@clinicaavaria.cl','Activo');

insert into usuario(empleado,permisos,usuario,password,correo,estado) values
(1001,1001,'jperalta','77148f84898f3d54be71a6120e795a24049a520b','jperalta@clinicaavaria.cl','Activo');

select * from usuario;

create table accion
(
 idaccion int not null auto_increment,
 accion varchar(300) not null,
 codigo int,
 fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 ip varchar(100),
 usuario int not null,
 constraint pk_accion primary key(idaccion),
 constraint fk_usu_acc foreign key(usuario) references usuario(idusuario)
);
alter table accion auto_increment=1000;

select * from accion;

create table tratamiento
(
 idtratamiento int not null auto_increment,
 descripcion varchar(100) not null,
 constraint pk_tratamiento primary key(idtratamiento)
);
alter table tratamiento auto_increment=1000;

insert into tratamiento(descripcion)values
('Toxina Botulínica'),
('Relleno Zona Peribucal'),
('Rinomodelación'),
('Relleno de Ojeras Hundidas'),
('Relleno de Mentón o Pómulos'),
('Labios'),
('MesoGlow Anti-Age'),
('Afinar Contorno Facial'),
('Hilos Tracción'),
('Hilos Reparadores de Piel'),
('Combinaciones Hilos Tracción y Reparadores'),
('Tratamiento Láser'),
('Hora de Evaluación Medicina Estética y Medicina Láser');

create table contacto
(
  idcontacto int not null auto_increment,
  nombre varchar(300) not null,
  email varchar(100) not null,
  telefono varchar(12) not null,
  tratamiento int not null,
  descuento varchar(100) not null,
  campana varchar(250)not null,
  origen varchar(100)not null,
  fechaIngreso TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fechaLlamada timestamp,
  nuevaIteracion timestamp,
  dias int,
  obs varchar(200),
  estado varchar(100),
  constraint pk_contacto primary key(idcontacto),
  constraint fk_pro_cont foreign key(tratamiento) references tratamiento(idtratamiento)
);
alter table contacto auto_increment=1000;

create table llamada
(
  idllamada int not null auto_increment,
  usuario int not null,
  contacto int not null,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  tiempollamada timestamp,
  estado varchar(100),
  constraint pk_llamada primary key(idllamada),
  constraint fk_usu_llam foreign key(usuario)references usuario(idusuario),
  constraint fk_cont_llam foreign key(contacto)references contacto(idcontacto)
);
alter table llamada auto_increment=1000;

create table historialLlamada
(
  idhistorial int not null auto_increment,
  contacto int not null,
  usuario int not null,
  accion varchar(100) not null,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  constraint pk_historial primary key(idhistorial),
  constraint fk_hs_contacto foreign key(contacto) references contacto(idcontacto),
  constraint fk_hs_usuario foreign key(usuario) references usuario(idusuario)
);
alter table historialLlamada auto_increment=1000;

select * from contacto;
select * from accion;
select * from usuario;
select * from llamada;
select * from historialLlamada;
drop database botox;

delete from llamada where contacto = 1000;

SELECT u.usuario,SEC_TO_TIME(SUM(TIME_TO_SEC(ll.tiempoLlamada))) AS horas FROM llamada ll INNER JOIN usuario u on ll.usuario = u.idusuario   group by u.usuario;



