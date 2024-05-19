create table product(
    id int(10) unsigned not null AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) not null,
    price_import decimal(10,2) default 0,
    price_sale decimal(10,2) default 0,
    warehouse_id int(10) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    description text,
    type varchar(100) default null,
    quantity int(10) default 0
) ;

alter table product auto_increment=1;

create table warehouse(
    id int(10) unsigned not null AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) not null,
    address text
    
) ;

alter table warehouse auto_increment=1;

create table inbounds(
    id int(10) unsigned not null AUTO_INCREMENT PRIMARY KEY,
    product_id int(10) unsigned not null,
    warehouse_id int(10) unsigned not null,
    quantity int(10) default 0,
    supplier varchar(100) default null,
    staff varchar(100) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (product_id) references product(id),
    foreign key (warehouse_id) references warehouse(id)
) ;


alter table inbounds auto_increment=1;

insert into warehouse(name, address) values
('Kho 1', 'So 1, Duong 1, Quan 1'),
('Kho 2', 'So 2, Duong 2, Quan 2'),
('Kho 3', 'So 3, Duong 3, Quan 3'),
('Kho 4', 'So 4, Duong 4, Quan 4'),
('Kho 5', 'So 5, Duong 5, Quan 5');

insert into product(name,type, price_import, price_sale, warehouse_id, description, quantity) values
('Sữa tươi','Đồ uống' ,10000, 12000, 1, 'Sữa tươi Vinamilk', 100),
('Bánh mì','Thực phẩm', 5000, 6000, 2, 'Bánh mì tươi', 200),
('Trà xanh','Đồ uống' ,10000, 12000, 3, 'Tra xanh Olong', 300),
('Nước ngọt','Đồ uống', 5000, 6000, 4, 'Nước ngọt Coca', 400),
('Bánh quy','Đồ ăn', 10000, 12000, 5, 'Bánh quy', 500),
('Điện thoại Iphone 15', 'Điện tử',100000,200000,1, 'Iphone 15', 10),
('Laptop Dell XPS 2021', 'Điện tử', 200000, 300000, 2, 'Laptop Dell XPS 2021', 20),
('Tivi Sony 4K', 'Điện tử', 300000, 400000, 3, 'Tivi Sony 4K', 30),
('Máy lạnh Daikin', 'Điện tử', 400000, 500000, 4, 'Máy lạnh Daikin', 40),
('Tủ lạnh Panasonic', 'Điện tử', 500000, 600000, 5, 'Tủ lạnh Panasonic', 50);

insert into inbounds(product_id, warehouse_id, quantity, supplier) values
(1, 1, 100, 'Vinamilk'),
(2, 2, 200, 'Banh mi ABC'),
(3, 3, 300, 'Tra xanh XYZ'),
(4, 4, 400, 'Coca Cola'),
(5, 5, 500, 'Kinh Do'),
(6, 1, 10, 'Apple'),
(7, 2, 20, 'Dell'),
(8, 3, 30, 'Sony'),
(9, 4, 40, 'Daikin'),
(10, 5, 50, 'Panasonic');
