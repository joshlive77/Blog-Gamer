CREATE TABLE usuarios(
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
apellidos   varchar(100) not null,
email       varchar(255) not null,
password    varchar(255) not null,
fecha       date not null,
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE categorias(
id      int(255) auto_increment not null,
nombre  varchar(100),
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE entradas(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
categoria_id    int(255) not null,
titulo          varchar(255) not null,
descripcion     MEDIUMTEXT,
fecha           date not null,
CONSTRAINT pk_entradas PRIMARY KEY(id),
CONSTRAINT fk_entrada_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
CONSTRAINT fk_entrada_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE NO ACTION
)ENGINE=InnoDb;

/* inserts: */

insert into usuarios values(null,'Carolina','Pagan','Carolina@usr.com','Carolina',curdate());
insert into usuarios values(null,'Adán','Tamayo','Tamayo@usr.com','Tamayo',curdate());
insert into usuarios values(null,'Lucas','Ruiz','Lucas@usr.com','Lucas',curdate());

insert into categorias values(null, 'indie');
insert into categorias values(null, 'accion');
insert into categorias values(null, 'terror');

insert into entradas values(null, 1, 1, 'fifa 19', 'simulador de futbol', curdate());
insert into entradas values(null, 2, 2, 'skyrim', 'mundo abierto', curdate());
insert into entradas values(null, 3, 3, 'overwatch', 'juego raro', curdate());
insert into entradas values(null, 4, 4, 'battlefield 5', 'simulador de guerra', curdate());

insert into entradas values(null, 1, 4, 'call of duty', 'simulador de guerra', curdate());
insert into entradas values(null, 2, 3, 'gris', 'juego musical rarisimo', curdate());
insert into entradas values(null, 3, 2, 'wow', 'mundo abierto', curdate());
insert into entradas values(null, 4, 5, 'outlast', 'survival horror', curdate());


/* PARA MODIFICAR EL AUTO INCREMNT LUEGO DE ELIMINIAR REGISTROS 
ALTER TABLE nombre_tabla AUTO_INCREMENT=1
 */