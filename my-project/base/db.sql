create database trinome_prepas;
use trinome_prepas;
create table admin (
    id int primary key auto_increment,
    adminname varchar(50) not null unique,
    password varchar(255) not null
);
INSERT INTO admin (adminname, password)
VALUES (
  'admin',
  'admin'
);
create table user (
    id int primary key auto_increment,
    username varchar(50) not null unique,
    password varchar(255) not null,
    email varchar(100) not null unique,
    phone varchar(15) not null unique
);
create table category (
    id int primary key auto_increment,
    name varchar(50) not null unique,
    description varchar(255) not null,
    image_ varchar(255) not null
);
create table product (
    id int primary key auto_increment,
    name varchar(50) not null unique,
    description varchar(255) not null,
    price decimal(10, 2) not null,
    category_id int not null,
    product_image varchar(255) not null,
    foreign key (category_id) references category(id)
);

create table product_user (
    id int primary key auto_increment,
    product_id int not null,
    user_id int not null,
    foreign key (product_id) references product(id),
    foreign key (user_id) references user(id)
);