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

/*
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
*/
create table contacto
(
  idcontacto int not null auto_increment,
  nombre varchar(300) not null,
  email varchar(100) not null,
  telefono varchar(12) not null,
  tratamiento varchar(300) not null,
  descuento varchar(100) not null,
  campana varchar(250)not null,
  origen varchar(100)not null,
  fechaIngreso TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fechaLlamada timestamp,
  nuevaIteracion timestamp,
  orden int not null default '0',
  prioridad int not null,
  dias int,
  obs varchar(200),
  estado varchar(100),
  ocupado char(1)not null,
  cita int not null,
  usuario int not null default '0',
  constraint pk_contacto primary key(idcontacto),
  constraint fk_cont_usu foreign key(usuario) references usuario(idUsuario)
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

/*
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
*/

create table region 
(
 id int(2) not null default '0',
 nombre varchar(50) default null,
 iso_3166_2_cl varchar(5) default null,
 constraint pk_region primary key(id)
);

INSERT INTO region (id,nombre,iso_3166_2_cl) VALUES
(1, 'Tarapacá', 'CL-TA'),
(2, 'Antofagasta', 'CL-AN'),
(3, 'Atacama', 'CL-AT'),
(4, 'Coquimbo', 'CL-CO'),
(5, 'Valparaíso', 'CL-VS'),
(6, 'Región del Libertador Gral. Bernardo O’Higgins', 'CL-LI'),
(7, 'Región del Maule', 'CL-ML'),
(8, 'Región del Biobío', 'CL-BI'),
(9, 'Región de la Araucanía', 'CL-AR'),
(10, 'Región de Los Lagos', 'CL-LL'),
(11, 'Región Aisén del Gral. Carlos Ibáñez del Campo', 'CL-AI'),
(12, 'Región de Magallanes y de la Antártica Chilena', 'CL-MA'),
(13, 'Región Metropolitana de Santiago', 'CL-RM'),
(14, 'Región de Los Ríos', 'CL-LR'),
(15, 'Arica y Parinacota', 'CL-AP');

create table provincia
(
  id int(3) not null default '0',
  nombre varchar(23) default null,
  idregion int(2) default null,
  constraint pk_provicia primary key(id),
  constraint fk_pro_reg foreign key(idregion) references region(id)
);

INSERT INTO provincia (id,nombre,idRegion) VALUES
(1, 'Arica', 15),
(2, 'Parinacota', 15),
(3, 'Iquique', 1),
(4, 'Tamarugal', 1),
(5, 'Antofagasta', 2),
(6, 'El Loa', 2),
(7, 'Tocopilla', 2),
(8, 'Copiapó', 3),
(9, 'Chañaral', 3),
(10, 'Huasco', 3),
(11, 'Elqui', 4),
(12, 'Choapa', 4),
(13, 'Limarí', 4),
(14, 'Valparaíso', 5),
(15, 'Isla de Pascua', 5),
(16, 'Los Andes', 5),
(17, 'Petorca', 5),
(18, 'Quillota', 5),
(19, 'San Antonio', 5),
(20, 'San Felipe de Aconcagua', 5),
(21, 'Marga Marga', 5),
(22, 'Cachapoal', 6),
(23, 'Cardenal Caro', 6),
(24, 'Colchagua', 6),
(25, 'Talca', 7),
(26, 'Cauquenes', 7),
(27, 'Curicó', 7),
(28, 'Linares', 7),
(29, 'Concepción', 8),
(30, 'Arauco', 8),
(31, 'Biobío', 8),
(32, 'Ñuble', 8),
(33, 'Cautín', 9),
(34, 'Malleco', 9),
(35, 'Valdivia', 14),
(36, 'Ranco', 14),
(37, 'Llanquihue', 10),
(38, 'Chiloé', 10),
(39, 'Osorno', 10),
(40, 'Palena', 10),
(41, 'Coihaique', 11),
(42, 'Aisén', 11),
(43, 'Capitán Prat', 11),
(44, 'General Carrera', 11),
(45, 'Magallanes', 12),
(46, 'Antártica Chilena', 12),
(47, 'Tierra del Fuego', 12),
(48, 'Última Esperanza', 12),
(49, 'Santiago', 13),
(50, 'Cordillera', 13),
(51, 'Chacabuco', 13),
(52, 'Maipo', 13),
(53, 'Melipilla', 13),
(54, 'Talagante', 13);

create table comuna
(
 id int(11) not null auto_increment,
 nombre varchar(20) default null,
 idprovincia int(3) default null,
 constraint pk_comuna primary key(id),
 constraint fk_com_prov foreign key(idprovincia) references provincia(id)
);

INSERT INTO comuna (id,nombre,idProvincia) VALUES
(1, 'Iquique', 3),
(2, 'Alto Hospicio', 3),
(3, 'Pozo Almonte', 4),
(4, 'Camiña', 4),
(5, 'Colchane', 4),
(6, 'Huara', 4),
(7, 'Pica', 4),
(8, 'Antofagasta', 5),
(9, 'Mejillones', 5),
(10, 'Sierra Gorda', 5),
(11, 'Taltal', 5),
(12, 'Calama', 6),
(13, 'Ollagüe', 6),
(14, 'San Pedro de Atacama', 6),
(15, 'Tocopilla', 7),
(16, 'María Elena', 7),
(17, 'Copiapó', 8),
(18, 'Caldera', 8),
(19, 'Tierra Amarilla', 8),
(20, 'Chañaral', 9),
(21, 'Diego de Almagro', 9),
(22, 'Vallenar', 10),
(23, 'Alto del Carmen', 10),
(24, 'Freirina', 10),
(25, 'Huasco', 10),
(26, 'La Serena', 11),
(27, 'Coquimbo', 11),
(28, 'Andacollo', 11),
(29, 'La Higuera', 11),
(30, 'Paihuano', 11),
(31, 'Vicuña', 11),
(32, 'Illapel', 12),
(33, 'Canela', 12),
(34, 'Los Vilos', 12),
(35, 'Salamanca', 12),
(36, 'Ovalle', 13),
(37, 'Combarbalá', 13),
(38, 'Monte Patria', 13),
(39, 'Punitaqui', 13),
(40, 'Río Hurtado', 13),
(41, 'Valparaíso', 14),
(42, 'Casablanca', 14),
(43, 'Concón', 14),
(44, 'Juan Fernández', 14),
(45, 'Puchuncaví', 14),
(46, 'Quintero', 14),
(47, 'Viña del Mar', 14),
(48, 'Isla de Pascua', 15),
(49, 'Los Andes', 16),
(50, 'Calle Larga', 16),
(51, 'Rinconada', 16),
(52, 'San Esteban', 16),
(53, 'La Ligua', 17),
(54, 'Cabildo', 17),
(55, 'Papudo', 17),
(56, 'Petorca', 17),
(57, 'Zapallar', 17),
(58, 'Quillota', 18),
(59, 'La Calera', 18),
(60, 'Hijuelas', 18),
(61, 'La Cruz', 18),
(62, 'Nogales', 18),
(63, 'San Antonio', 19),
(64, 'Algarrobo', 19),
(65, 'Cartagena', 19),
(66, 'El Quisco', 19),
(67, 'El Tabo', 19),
(68, 'Santo Domingo', 19),
(69, 'San Felipe', 20),
(70, 'Catemu', 20),
(71, 'Llay Llay', 20),
(72, 'Panquehue', 20),
(73, 'Putaendo', 20),
(74, 'Santa María', 20),
(75, 'Quilpué', 21),
(76, 'Limache', 21),
(77, 'Olmué', 21),
(78, 'Villa Alemana', 21),
(79, 'Rancagua', 22),
(80, 'Codegua', 22),
(81, 'Coinco', 22),
(82, 'Coltauco', 22),
(83, 'Doñihue', 22),
(84, 'Graneros', 22),
(85, 'Las Cabras', 22),
(86, 'Machalí', 22),
(87, 'Malloa', 22),
(88, 'Mostazal', 22),
(89, 'Olivar', 22),
(90, 'Peumo', 22),
(91, 'Pichidegua', 22),
(92, 'Quinta de Tilcoco', 22),
(93, 'Rengo', 22),
(94, 'Requínoa', 22),
(95, 'San Vicente', 22),
(96, 'Pichilemu', 23),
(97, 'La Estrella', 23),
(98, 'Litueche', 23),
(99, 'Marchihue', 23),
(100, 'Navidad', 23),
(101, 'Paredones', 23),
(102, 'San Fernando', 24),
(103, 'Chépica', 24),
(104, 'Chimbarongo', 24),
(105, 'Lolol', 24),
(106, 'Nancagua', 24),
(107, 'Palmilla', 24),
(108, 'Peralillo', 24),
(109, 'Placilla', 24),
(110, 'Pumanque', 24),
(111, 'Santa Cruz', 24),
(112, 'Talca', 25),
(113, 'Constitución', 25),
(114, 'Curepto', 25),
(115, 'Empedrado', 25),
(116, 'Maule', 25),
(117, 'Pelarco', 25),
(118, 'Pencahue', 25),
(119, 'Río Claro', 25),
(120, 'San Clemente', 25),
(121, 'San Rafael', 25),
(122, 'Cauquenes', 26),
(123, 'Chanco', 26),
(124, 'Pelluhue', 26),
(125, 'Curicó', 27),
(126, 'Hualañé', 27),
(127, 'Licantén', 27),
(128, 'Molina', 27),
(129, 'Rauco', 27),
(130, 'Romeral', 27),
(131, 'Sagrada Familia', 27),
(132, 'Teno', 27),
(133, 'Vichuquén', 27),
(134, 'Linares', 28),
(135, 'Colbún', 28),
(136, 'Longaví', 28),
(137, 'Parral', 28),
(138, 'Retiro', 28),
(139, 'San Javier', 28),
(140, 'Villa Alegre', 28),
(141, 'Yerbas Buenas', 28),
(142, 'Concepción', 29),
(143, 'Coronel', 29),
(144, 'Chiguayante', 29),
(145, 'Florida', 29),
(146, 'Hualqui', 29),
(147, 'Lota', 29),
(148, 'Penco', 29),
(149, 'San Pedro de la Paz', 29),
(150, 'Santa Juana', 29),
(151, 'Talcahuano', 29),
(152, 'Tomé', 29),
(153, 'Hualpén', 29),
(154, 'Lebu', 30),
(155, 'Arauco', 30),
(156, 'Cañete', 30),
(157, 'Contulmo', 30),
(158, 'Curanilahue', 30),
(159, 'Los Álamos', 30),
(160, 'Tirúa', 30),
(161, 'Los Ángeles', 31),
(162, 'Antuco', 31),
(163, 'Cabrero', 31),
(164, 'Laja', 31),
(165, 'Mulchén', 31),
(166, 'Nacimiento', 31),
(167, 'Negrete', 31),
(168, 'Quilaco', 31),
(169, 'Quilleco', 31),
(170, 'San Rosendo', 31),
(171, 'Santa Bárbara', 31),
(172, 'Tucapel', 31),
(173, 'Yumbel', 31),
(174, 'Alto Biobío', 31),
(175, 'Chillán', 32),
(176, 'Bulnes', 32),
(177, 'Cobquecura', 32),
(178, 'Coelemu', 32),
(179, 'Coihueco', 32),
(180, 'Chillán Viejo', 32),
(181, 'El Carmen', 32),
(182, 'Ninhue', 32),
(183, 'Ñiquén', 32),
(184, 'Pemuco', 32),
(185, 'Pinto', 32),
(186, 'Portezuelo', 32),
(187, 'Quillón', 32),
(188, 'Quirihue', 32),
(189, 'Ránquil', 32),
(190, 'San Carlos', 32),
(191, 'San Fabián', 32),
(192, 'San Ignacio', 32),
(193, 'San Nicolás', 32),
(194, 'Treguaco', 32),
(195, 'Yungay', 32),
(196, 'Temuco', 33),
(197, 'Carahue', 33),
(198, 'Cunco', 33),
(199, 'Curarrehue', 33),
(200, 'Freire', 33),
(201, 'Galvarino', 33),
(202, 'Gorbea', 33),
(203, 'Lautaro', 33),
(204, 'Loncoche', 33),
(205, 'Melipeuco', 33),
(206, 'Nueva Imperial', 33),
(207, 'Padre las Casas', 33),
(208, 'Perquenco', 33),
(209, 'Pitrufquén', 33),
(210, 'Pucón', 33),
(211, 'Saavedra', 33),
(212, 'Teodoro Schmidt', 33),
(213, 'Toltén', 33),
(214, 'Vilcún', 33),
(215, 'Villarrica', 33),
(216, 'Cholchol', 33),
(217, 'Angol', 34),
(218, 'Collipulli', 34),
(219, 'Curacautín', 34),
(220, 'Ercilla', 34),
(221, 'Lonquimay', 34),
(222, 'Los Sauces', 34),
(223, 'Lumaco', 34),
(224, 'Purén', 34),
(225, 'Renaico', 34),
(226, 'Traiguén', 34),
(227, 'Victoria', 34),
(228, 'Puerto Montt', 37),
(229, 'Calbuco', 37),
(230, 'Cochamó', 37),
(231, 'Fresia', 37),
(232, 'Frutillar', 37),
(233, 'Los Muermos', 37),
(234, 'Llanquihue', 37),
(235, 'Maullín', 37),
(236, 'Puerto Varas', 37),
(237, 'Castro', 38),
(238, 'Ancud', 38),
(239, 'Chonchi', 38),
(240, 'Curaco de Vélez', 38),
(241, 'Dalcahue', 38),
(242, 'Puqueldón', 38),
(243, 'Queilén', 38),
(244, 'Quellón', 38),
(245, 'Quemchi', 38),
(246, 'Quinchao', 38),
(247, 'Osorno', 39),
(248, 'Puerto Octay', 39),
(249, 'Purranque', 39),
(250, 'Puyehue', 39),
(251, 'Río Negro', 39),
(252, 'San Juan de la Costa', 39),
(253, 'San Pablo', 39),
(254, 'Chaitén', 40),
(255, 'Futaleufú', 40),
(256, 'Hualaihué', 40),
(257, 'Palena', 40),
(258, 'Coyhaique', 41),
(259, 'Lago Verde', 41),
(260, 'Aysén', 42),
(261, 'Cisnes', 42),
(262, 'Guaitecas', 42),
(263, 'Cochrane', 43),
(264, 'O''Higgins', 43),
(265, 'Tortel', 43),
(266, 'Chile Chico', 44),
(267, 'Río Ibáñez', 44),
(268, 'Punta Arenas', 45),
(269, 'Laguna Blanca', 45),
(270, 'Río Verde', 45),
(271, 'San Gregorio', 45),
(272, 'Cabo de Hornos', 46),
(273, 'Antártica', 46),
(274, 'Porvenir', 47),
(275, 'Primavera', 47),
(276, 'Timaukel', 47),
(277, 'Natales', 48),
(278, 'Torres del Paine', 48),
(279, 'Santiago', 49),
(280, 'Cerrillos', 49),
(281, 'Cerro Navia', 49),
(282, 'Conchalí', 49),
(283, 'El Bosque', 49),
(284, 'Estación Central', 49),
(285, 'Huechuraba', 49),
(286, 'Independencia', 49),
(287, 'La Cisterna', 49),
(288, 'La Florida', 49),
(289, 'La Granja', 49),
(290, 'La Pintana', 49),
(291, 'La Reina', 49),
(292, 'Las Condes', 49),
(293, 'Lo Barnechea', 49),
(294, 'Lo Espejo', 49),
(295, 'Lo Prado', 49),
(296, 'Macul', 49),
(297, 'Maipú', 49),
(298, 'Ñuñoa', 49),
(299, 'Pedro Aguirre Cerda', 49),
(300, 'Peñalolén', 49),
(301, 'Providencia', 49),
(302, 'Pudahuel', 49),
(303, 'Quilicura', 49),
(304, 'Quinta Normal', 49),
(305, 'Recoleta', 49),
(306, 'Renca', 49),
(307, 'San Joaquín', 49),
(308, 'San Miguel', 49),
(309, 'San Ramón', 49),
(310, 'Vitacura', 49),
(311, 'Puente Alto', 50),
(312, 'Pirque', 50),
(313, 'San José de Maipo', 50),
(314, 'Colina', 51),
(315, 'Lampa', 51),
(316, 'Tiltil', 51),
(317, 'San Bernardo', 52),
(318, 'Buin', 52),
(319, 'Calera de Tango', 52),
(320, 'Paine', 52),
(321, 'Melipilla', 53),
(322, 'Alhué', 53),
(323, 'Curacaví', 53),
(324, 'María Pinto', 53),
(325, 'San Pedro', 53),
(326, 'Talagante', 54),
(327, 'El Monte', 54),
(328, 'Isla de Maipo', 54),
(329, 'Padre Hurtado', 54),
(330, 'Peñaflor', 54),
(331, 'Valdivia', 35),
(332, 'Corral', 35),
(333, 'Lanco', 35),
(334, 'Los Lagos', 35),
(335, 'Máfil', 35),
(336, 'Mariquina', 35),
(337, 'Paillaco', 35),
(338, 'Panguipulli', 35),
(339, 'La Unión', 36),
(340, 'Futrono', 36),
(341, 'Lago Ranco', 36),
(342, 'Río Bueno', 36),
(343, 'Arica', 1),
(344, 'Camarones', 1),
(345, 'Putre', 2),
(346, 'General Lagos', 2);

create table tiempo
(
  idtiempo int not null auto_increment,
  usuario int not null,
  tipo varchar(100) not null,
  descripcion varchar(250)not null,
  tiempo timestamp,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  constraint pk_tiempo primary key(idtiempo),
  constraint fk_tiem_usu foreign key(usuario)references usuario(idusuario)
); 
alter table tiempo auto_increment=1000;

create table con
(
  idcon int not null auto_increment,
  contacto int not null,
  usuario int not null,
  fecha timestamp,
  tipo varchar(100) not null,
  estado varchar(100) not null,
  constraint pk_con primary key(idcon),
  constraint fk_con_contacto foreign key(contacto) references contacto(idcontacto),
  constraint fk_con_usuario foreign key(usuario) references usuario(idusuario)
);

alter table con auto_increment=1000;

create table llam
(
  idllam int not null auto_increment,
  contacto int not null,
  usuario int not null,
  fecha timestamp,
  tipo varchar(100) not null,
  estado varchar(100) not null,
  constraint pk_llam primary key(idllam),
  constraint fk_llam_contacto foreign key(contacto) references contacto(idcontacto),
  constraint fk_llam_usuario foreign key(usuario) references usuario(idusuario)
);

alter table llam auto_increment=1000;

create table cont
(
  idcont int not null auto_increment,
  contacto int not null,
  usuario int not null,
  fecha timestamp,
  tipo varchar(100) not null,
  estado varchar(100) not null,
  constraint pk_cont primary key(idcont),
  constraint fk_cont_contacto foreign key(contacto) references contacto(idcontacto),
  constraint fk_cont_usuario foreign key(usuario) references usuario(idusuario)
);

alter table cont auto_increment=1000;

create table agen
(
  idagen int not null auto_increment,
  contacto int not null,
  usuario int not null,
  fecha timestamp,
  tipo varchar(100) not null,
  estado varchar(100) not null,
  constraint pk_agen primary key(idagen),
  constraint fk_agen_contacto foreign key(contacto) references contacto(idcontacto),
  constraint fk_agen_usuario foreign key(usuario) references usuario(idusuario)
);

alter table agen auto_increment=1000;

select * from con;
select * from llam;
select * from cont;
select * from agen;

select * from accion;
select * from usuario;
select * from llamada;
select * from historialLlamada;
select * from contacto;

select count(*) from contacto where campana='Campaña 3 zonas' order by campana;
select * from tiempo;
select * from contacto;

delete from llamada where contacto = 1000;

(select usuario,count(idcontacto) from contacto where estado='En espera de llamado'  group by usuario)UNION(select usuario,count(idcontacto) from contacto where estado !='En espera de llamado'  group by usuario);

(select tipo,SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) AS tiempo from  tiempo where tipo='Tiempo llamada' and usuario=1001)UNION(select tipo,SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) AS tiempo from  tiempo where tipo='Tiempo muerto' and usuario=1001);
 
select tipo,SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) AS tiempo from tiempo;

select descripcion,SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) AS tiempo from tiempo where tipo='Tiempo muerto';


select u.usuario,SEC_TO_TIME(SUM(TIME_TO_SEC(t.tiempo))) AS tiempo_muerto from tiempo t INNER JOIN usuario u on t.usuario = u.idusuario group by u.usuario;

SELECT u.usuario,SEC_TO_TIME(SUM(TIME_TO_SEC(ll.tiempoLlamada))) AS horas FROM llamada ll INNER JOIN usuario u on ll.usuario = u.idusuario   group by u.usuario;

select count(idcontacto) from contacto where estado<>'En espera de llamado';