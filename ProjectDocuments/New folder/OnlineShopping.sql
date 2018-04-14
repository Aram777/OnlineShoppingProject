/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     15/04/2018 01:52:50                          */
/*==============================================================*/


alter table Discounts 
   drop foreign key FK_DISCOUNT_PRODUCTSD_PRODUCTS;

alter table Orders 
   drop foreign key FK_ORDERS_DISCOUNTO_DISCOUNT;

alter table Orders 
   drop foreign key FK_ORDERS_PRODUCTST_PRODUCTS;

alter table Orders 
   drop foreign key FK_ORDERS_USERTOORD_SYSTEMUS;

alter table Products 
   drop foreign key FK_PRODUCTS_PRODUCTCA_PRODUCTS;

alter table Products 
   drop foreign key FK_PRODUCTS_PRODUCTPR_PRICECAT;

alter table Discounts
   drop primary key;


alter table Discounts 
   drop foreign key FK_DISCOUNT_PRODUCTSD_PRODUCTS;

drop table if exists Discounts;

alter table Orders
   drop primary key;


alter table Orders 
   drop foreign key FK_ORDERS_PRODUCTST_PRODUCTS;

alter table Orders 
   drop foreign key FK_ORDERS_USERTOORD_SYSTEMUS;

alter table Orders 
   drop foreign key FK_ORDERS_DISCOUNTO_DISCOUNT;

drop table if exists Orders;

alter table PriceCategory
   drop primary key;

drop table if exists PriceCategory;

alter table Products
   drop primary key;


alter table Products 
   drop foreign key FK_PRODUCTS_PRODUCTPR_PRICECAT;

alter table Products 
   drop foreign key FK_PRODUCTS_PRODUCTCA_PRODUCTS;

drop table if exists Products;

alter table ProductsCategory
   drop primary key;

drop table if exists ProductsCategory;

alter table SystemUsers
   drop primary key;

drop table if exists SystemUsers;

/*==============================================================*/
/* Table: Discounts                                             */
/*==============================================================*/
create table Discounts
(
   DiscountsId          int not null auto_increment  comment '',
   ProductsId           int not null  comment '',
   DiscountStartDate    date not null  comment '',
   DiscountEndDate      date not null  comment '',
   DiscountPercent      decimal(5,2) not null  comment ''
);

alter table Discounts
   add primary key (DiscountsId);

/*==============================================================*/
/* Table: Orders                                                */
/*==============================================================*/
create table Orders
(
   OrdersId             int not null auto_increment  comment '',
   SystemUsersId        int not null  comment '',
   ProductsId           int not null  comment '',
   DiscountsId          int  comment '',
   OrdersDate           datetime not null  comment '',
   OrderStatus          smallint not null default 1  comment '0 deactive
             1 added to cart
             2 payed
             3 delivered',
   ProductRate          int default 0  comment 'for rating the products',
   OrderQuantity        int default 1  comment '',
   OrderPrice           decimal(5,2) not null  comment ''
);

alter table Orders
   add primary key (OrdersId);

/*==============================================================*/
/* Table: PriceCategory                                         */
/*==============================================================*/
create table PriceCategory
(
   PriceCategoryId      int not null auto_increment  comment '',
   PriceCatPerecent     decimal(5,2) not null default 0.00  comment ''
);

alter table PriceCategory
   add primary key (PriceCategoryId);

/*==============================================================*/
/* Table: Products                                              */
/*==============================================================*/
create table Products
(
   ProductsId           int not null auto_increment  comment '',
   ProductsCategoryId   int not null  comment '',
   PriceCategoryId      int not null  comment '',
   ProductName          varchar(200) not null  comment '',
   ProductQuantity      int not null default 0  comment '',
   ProductDesc          varchar(200) not null  comment '',
   ProductPicture       varchar(200)  comment '',
   ProdutMaxCapasity    int not null default 1  comment '',
   ProductOrderPoint    int not null default 0  comment '',
   ProductState         smallint not null default 1  comment '0 Deactivated Product
             1 Active products',
   ProductAddingDate    datetime not null  comment '',
   ProductPrice         decimal(5,2) not null default 0  comment ''
);

alter table Products
   add primary key (ProductsId);

/*==============================================================*/
/* Table: ProductsCategory                                      */
/*==============================================================*/
create table ProductsCategory
(
   ProductsCategoryId   int not null auto_increment  comment '',
   PrdCatDescription    longtext not null  comment ''
);

alter table ProductsCategory
   add primary key (ProductsCategoryId);

/*==============================================================*/
/* Table: SystemUsers                                           */
/*==============================================================*/
create table SystemUsers
(
   SystemUsersId        int not null auto_increment  comment '',
   UserFirstName        varchar(50) not null  comment '',
   UserLastName         varchar(50)  comment '',
   UserEmail            varchar(100) not null  comment '',
   UserType             smallint not null default 1  comment '0 for admin
             1 for requalre users',
   UserState            smallint not null default 1  comment '0 for deactivated users
             1 for Active users',
   UserAddress          varchar(100)  comment '',
   UserPass             varchar(200) not null  comment ''
);

alter table SystemUsers
   add primary key (SystemUsersId);

alter table Discounts add constraint FK_DISCOUNT_PRODUCTSD_PRODUCTS foreign key (ProductsId)
      references Products (ProductsId) on delete restrict on update restrict;

alter table Orders add constraint FK_ORDERS_DISCOUNTO_DISCOUNT foreign key (DiscountsId)
      references Discounts (DiscountsId) on delete restrict on update restrict;

alter table Orders add constraint FK_ORDERS_PRODUCTST_PRODUCTS foreign key (ProductsId)
      references Products (ProductsId) on delete restrict on update restrict;

alter table Orders add constraint FK_ORDERS_USERTOORD_SYSTEMUS foreign key (SystemUsersId)
      references SystemUsers (SystemUsersId) on delete restrict on update restrict;

alter table Products add constraint FK_PRODUCTS_PRODUCTCA_PRODUCTS foreign key (ProductsCategoryId)
      references ProductsCategory (ProductsCategoryId) on delete restrict on update restrict;

alter table Products add constraint FK_PRODUCTS_PRODUCTPR_PRICECAT foreign key (PriceCategoryId)
      references PriceCategory (PriceCategoryId) on delete restrict on update restrict;

