DELIMITER //
drop table if exists user;
drop table if exists coche;
drop table if exists revision;
drop table if exists coche_revision;
//

create table user(
                     uuid varchar(60),
                     username varchar(255),
                     password varchar(255),
                     email varchar(255),
                     edad integer,
                     tipo enum('NORMAL','ANUNCIOS','ADMIN')
);
//
alter table user add constraint pk_user primary key (uuid);
alter table user add constraint uk_user_username unique (username);
alter table user add constraint uk_user_email unique (email);
//

#use proyecto1; #Esto se hace para que podamos usar la base de datos en otro dispositivo diferente (que no tiene la base de datos) al que solemos trabajar.
#show tables;

create table coche(
    uuid varchar(60),
    marca varchar(255),
    usuario varchar(255)
);
alter table coche add constraint pk_coche primary key (uuid);

create table revision(
    uuid varchar(60),
    nombre varchar(255),
    precio integer
);
alter table revision add constraint pk_revision primary key (uuid);

create table coche_revision(
    uuid_coche varchar(60),
    uuid_revision varchar(60)
);
alter table coche_revision add constraint fk_coche_revision_coche foreign key (uuid_coche) references coche(uuid);
alter table coche_revision add constraint fk_coche_revision_revision foreign key (uuid_revision) references revision(uuid);

show tables;

select * from coche;
