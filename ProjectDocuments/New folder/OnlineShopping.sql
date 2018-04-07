/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/03/2018 11:08:03                          */
/*==============================================================*/


alter table ORDERS 
   drop foreign key FK_ORDERS_PRODUCTST_PRODUCTS;

alter table ORDERS 
   drop foreign key FK_ORDERS_USERTOORD_SYSTEMUS;

alter table PRODUCTS 
   drop foreign key FK_PRODUCTS_PRODUCTCA_PRODUCTS;

alter table PRODUCTS 
   drop foreign key FK_PRODUCTS_PRODUCTPR_PRICECAT;


alter table ORDERS 
   drop foreign key FK_ORDERS_PRODUCTST_PRODUCTS;

alter table ORDERS 
   drop foreign key FK_ORDERS_USERTOORD_SYSTEMUS;

drop table if exists ORDERS;

drop table if exists PRICECATEGORY;


alter table PRODUCTS 
   drop foreign key FK_PRODUCTS_PRODUCTPR_PRICECAT;

alter table PRODUCTS 
   drop foreign key FK_PRODUCTS_PRODUCTCA_PRODUCTS;

drop table if exists PRODUCTS;

drop table if exists PRODUCTSCATEGORY;

drop table if exists SYSTEMUSERS;

/*==============================================================*/
/* Table: ORDERS                                                */
/*==============================================================*/
create table ORDERS
(
   ORDERSID             int not null auto_increment  comment '',
   SYSTEMUSERSID        int not null  comment '',
   PRODUCTSID           int not null  comment '',
   ORDERDATE            datetime not null  comment '',
   ORDERSTATUS          smallint not null default 1  comment '0 deactive
             1 added to cart
             2 payed
             3 delivered',
   PRODUCTRATE          int default 0  comment 'for rating the products',
   ORDERQUANTITY        int default 1  comment '',
   ORDERPRICE           decimal(5,2) not null  comment '',
   primary key (ORDERSID)
);

/*==============================================================*/
/* Table: PRICECATEGORY                                         */
/*==============================================================*/
create table PRICECATEGORY
(
   PRICECATEGORYID      int not null auto_increment  comment '',
   PRICECATPERECENT     decimal(5,2) not null default 0.00  comment '',
   primary key (PRICECATEGORYID)
);

/*==============================================================*/
/* Table: PRODUCTS                                              */
/*==============================================================*/
create table PRODUCTS
(
   PRODUCTSID           int not null auto_increment  comment '',
   PRODUCTSCATEGORYID   int not null  comment '',
   PRICECATEGORYID      int not null  comment '',
   PRODUCNAME           varchar(200) not null  comment '',
   PRODUCTQUANTITY      int not null default 0  comment '',
   PRODUCTDESC          varchar(200) not null  comment '',
   PRODUCTPICTURE       varchar(200)  comment '',
   PRODUTMAXCAPASITY    int not null default 1  comment '',
   PRODUCTORDERPOINT    int not null default 0  comment '',
   PRODUCTSTATE         smallint not null default 1  comment '0 Deactivated Product
             1 Active products',
   PRODUCTADDINGDATE    datetime not null  comment '',
   PRODUCTPRICE         decimal(5,2) not null default 0  comment '',
   primary key (PRODUCTSID)
);

/*==============================================================*/
/* Table: PRODUCTSCATEGORY                                      */
/*==============================================================*/
create table PRODUCTSCATEGORY
(
   PRODUCTSCATEGORYID   int not null auto_increment  comment '',
   PRDCATDESCRIPTION    longtext not null  comment '',
   primary key (PRODUCTSCATEGORYID)
);

/*==============================================================*/
/* Table: SYSTEMUSERS                                           */
/*==============================================================*/
create table SYSTEMUSERS
(
   SYSTEMUSERSID        int not null auto_increment  comment '',
   USERFIRSTNAME        varchar(50) not null  comment '',
   USERLASTNAME         varchar(50)  comment '',
   USEREMAIL            varchar(100) not null  comment '',
   USERTYPE             smallint not null default 1  comment '0 for admin
             1 for requalre users',
   USERSTATE            smallint not null default 1  comment '0 for deactivated users
             1 for Active users',
   USERADDRESS          varchar(100)  comment '',
   USERPASS             varchar(200) not null  comment '',
   primary key (SYSTEMUSERSID)
);

alter table ORDERS add constraint FK_ORDERS_PRODUCTST_PRODUCTS foreign key (PRODUCTSID)
      references PRODUCTS (PRODUCTSID) on delete restrict on update restrict;

alter table ORDERS add constraint FK_ORDERS_USERTOORD_SYSTEMUS foreign key (SYSTEMUSERSID)
      references SYSTEMUSERS (SYSTEMUSERSID) on delete restrict on update restrict;

alter table PRODUCTS add constraint FK_PRODUCTS_PRODUCTCA_PRODUCTS foreign key (PRODUCTSCATEGORYID)
      references PRODUCTSCATEGORY (PRODUCTSCATEGORYID) on delete restrict on update restrict;

alter table PRODUCTS add constraint FK_PRODUCTS_PRODUCTPR_PRICECAT foreign key (PRICECATEGORYID)
      references PRICECATEGORY (PRICECATEGORYID) on delete restrict on update restrict;

