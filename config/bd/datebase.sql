# Creando la base de datos del proyecto
CREATE DATABASE tienda;
use tienda;

# Creando tablas de la base de datos:Categoria
CREATE TABLE categorias(
id          int(11) auto_increment   not null,
nombre      varchar(100)             not null,

CONSTRAINT pk_categoria PRIMARY KEY(id)

)ENGINE=InnoDb;

# Creando tablas de la base de datos:Usuarios
CREATE TABLE usuarios(
id              int(11) auto_increment not null,
nombre          varchar(100) not null,
apellidos       varchar(100) not null,
email           varchar(100) not null,
rol             varchar(100) not null,
imagen          varchar(200) not null,

CONSTRAINT pk_usuario PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;


# Creando tablas de la base de datos:Pedidos

CREATE TABLE pedidos(
id              int(11) auto_increment not null,
usuario_id      int(11) not null,
pais       varchar(100) not null,
estado       varchar(100) not null,
minucipio       varchar(255) not null,
coste           float(200,2) not null,
direccion          varchar(20) not null,
status          varchar(20) not null,
fecha           date,
hora            time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;


# Creando tablas de la base de datos:Productos
CREATE TABLE productos(
id                int(11) auto_increment not null,
categoria_id      int(11) not null,
nombre            varchar(100) not null,
descripcion       text,
oferta            varchar(2),
precio            float(100,2) not null,
stock             int(200) not null,
fecha             date,
imagen            varchar(200),
CONSTRAINT pk_producto PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;


# Creando tablas de la base de datos:Lineas_Pedidos

CREATE TABLE lineas_pedido(
id                int(11) auto_increment not null,
pedido_id         int(11) not null,
producto_id       int(11) not null,
paypal_id         int(11) not null,
unidades          int(200) not null,

CONSTRAINT pk_lineas PRIMARY KEY(id),
CONSTRAINT fk_lineas_pedidos FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_lineas_productos FOREIGN KEY(producto_id) REFERENCES productos(id),
CONSTRAINT fk_lineas_payment FOREIGN KEY(paypal_id) REFERENCES payment(id)
)ENGINE=InnoDb;

# Creando tablas de la base de datos:PAYPAL
CREATE TABLE IF NOT EXISTS payment (
id              int(11)  AUTO_INCREMENT NOT NULL,
payment_id      int(25) not null,
payment_status  varchar(255) NOT NULL,
payment_id_user int(25) not null,
payment_email   varchar(255) NOT NULL,


CONSTRAINT pk_payment PRIMARY KEY(id)
)ENGINE=InnoDb;


# INSERCCION DE REGISTROS
INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'contraseÃ±a', 'admin', null);

INSERT INTO categorias VALUES(null, 'Manga corta');
INSERT INTO categorias VALUES(null, 'Tirantes');
INSERT INTO categorias VALUES(null, 'Manga larga');
INSERT INTO categorias VALUES(null, 'Sudaderas');
