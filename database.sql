CREATE DATABASE IF NOT EXISTS laravel_master;

Use laravel_master;

CREATE TABLE users(
    id                  int(11) auto_increment not null,
    role                varchar(20),
    name                varchar(20),
    surname             varchar(20),
    nick                varchar(20),
    email               varchar(40),
    password            varchar(40),
    image               varchar(80),
    created_at          datetime,
    updated_at          datetime,
    remember_token      varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL,'user','Daniel','Restrepo','danielRestrepoWeb','jdrestrepo@unitecnica.net','12345',null,CURTIME(),CURTIME(),null);
INSERT INTO users VALUES(NULL,'user','Felipe','Ramirez','felipeRamirezWeb','ramirez@unitecnica.net','12345',null,CURTIME(),CURTIME(),null);
INSERT INTO users VALUES(NULL,'user','Liliana','Lopez','lilianaLopezWeb','Lopez@unitecnica.net','12345',null,CURTIME(),CURTIME(),null);

CREATE TABLE IF NOT EXISTS images(
    id                  int(11) auto_increment not null,
    user_id             int(11) ,
    image_path          varchar(20),
    description         text,
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(null,1,'test.jpg','descripcion de prueba 1',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'arena.jpg','descripcion de prueba 2',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'comida.jpg','descripcion de prueba 3',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,3,'familia.jpg','descripcion de prueba 4',CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id                  int(11) auto_increment not null,
    user_id             int(11) ,
    image_id            int(11),
    content             text,
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(null,1,4,'Buena foto de la familia',CURTIME(),CURTIME());
INSERT INTO comments VALUES(null,2,1,'que bonito dia',CURTIME(),CURTIME());
 INSERT INTO comments VALUES(null,3,2,'se ve delicioso',CURTIME(),CURTIME());
CREATE TABLE IF NOT EXISTS likes(
    id                  int(11) auto_increment not null,
    user_id             int(11) ,
    image_id            int(11),
    created_at          datetime,
    updated_at          datetime,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;
 
INSERT INTO likes VALUES(null,1,2,CURTIME(),CURTIME());
INSERT INTO likes VALUES(null,2,3,CURTIME(),CURTIME());
INSERT INTO likes VALUES(null,2,4,CURTIME(),CURTIME());