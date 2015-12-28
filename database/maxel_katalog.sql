/*==============================================================*/
/* DBMS name:      Sybase SQL Anywhere 10                       */
/* Created on:     12/28/2015 1:43:49 PM                        */
/*==============================================================*/


/*==============================================================*/
/* Table: admin                                                 */
/*==============================================================*/
create table admin 
(
   admin_id             integer                        not null,
   admin_name           varchar(255)                   null,
   admin_username       varchar(25)                    null,
   admin_password       varchar(32)                    null,
   admin_email          varchar(25)                    null,
   admin_status         tinyint                        null,
   constraint pk_admin primary key (admin_id)
);

/*==============================================================*/
/* Table: member                                                */
/*==============================================================*/
create table member 
(
   member_id            integer                        not null,
   member_name          varchar(255)                   null,
   member_email         varchar(255)                   null,
   member_username      varchar(25)                    null,
   member_password      varchar(32)                    null,
   member_birth_date    date                           null,
   member_gender        char(1)                        null,
   member_fb            varchar(25)                    null,
   member_coin          numeric                        null,
   member_registered    timestamp                      null,
   member_status        smallint                       null,
   constraint pk_member primary key (member_id)
);

/*==============================================================*/
/* Table: ext_city                                              */
/*==============================================================*/
create table ext_city 
(
   city_code            varchar(25)                    not null,
   member_id            integer                        null,
   city_name            varchar(255)                   null,
   constraint pk_ext_city primary key (city_code),
   constraint fk_ext_city_relations_member foreign key (member_id)
      references member (member_id)
        on update restrict
        on delete restrict
);

/*==============================================================*/
/* Table: business                                              */
/*==============================================================*/
create table business 
(
   business_id          integer                        not null,
   member_id            integer                        null,
   business_name        varchar(255)                   null,
   business_email       varchar(255)                   null,
   business_status      tinyint                        null,
   constraint pk_business primary key (business_id),
   constraint fk_business_relations_member foreign key (member_id)
      references member (member_id)
        on update restrict
        on delete restrict
);

/*==============================================================*/
/* Table: building                                              */
/*==============================================================*/
create table building 
(
   building_id          integer                        not null,
   business_id          integer                        null,
   city_code            varchar(25)                    null,
   building_name        varchar(255)                   null,
   building_address     varchar(255)                   null,
   building_lat         varchar(25)                    null,
   building_lng         varchar(25)                    null,
   building_status      tinyint                        null,
   constraint pk_building primary key (building_id),
   constraint fk_building_relations_ext_city foreign key (city_code)
      references ext_city (city_code)
        on update restrict
        on delete restrict,
   constraint fk_building_relations_business foreign key (business_id)
      references business (business_id)
        on update restrict
        on delete restrict
);

/*==============================================================*/
/* Table: business_field                                        */
/*==============================================================*/
create table business_field 
(
   bfield_id            integer                        not null,
   business_id          integer                        null,
   bfield_name          varchar(255)                   null,
   bfield_parent        integer                        null,
   bfield_status        tinyint                        null,
   constraint pk_business_field primary key (bfield_id),
   constraint fk_business_relations_business foreign key (business_id)
      references business (business_id)
        on update restrict
        on delete restrict
);

/*==============================================================*/
/* Table: ext_country                                           */
/*==============================================================*/
create table ext_country 
(
   country_code         varchar(25)                    not null,
   country_name         varchar(255)                   null,
   constraint pk_ext_country primary key (country_code)
);

/*==============================================================*/
/* Table: ext_province                                          */
/*==============================================================*/
create table ext_province 
(
   province_code        varchar(25)                    not null,
   country_code         varchar(25)                    null,
   city_code            varchar(25)                    null,
   province_name        varchar(255)                   null,
   constraint pk_ext_province primary key (province_code),
   constraint fk_ext_prov_relations_ext_coun foreign key (country_code)
      references ext_country (country_code)
        on update restrict
        on delete restrict,
   constraint fk_ext_prov_relations_ext_city foreign key (city_code)
      references ext_city (city_code)
        on update restrict
        on delete restrict
);

