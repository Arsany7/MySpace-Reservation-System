CREATE SCHEMA MY_SPACE_RESERVATION_SYSTEM;
USE MY_SPACE_RESERVATION_SYSTEM;
CREATE TABLE `TABLE` (table_id int AUTO_INCREMENT, category varchar (20) not null, number_of_seats int not null, price_per_hour decimal(8,2) not null ,branch_id int not null, PRIMARY KEY (table_id));
CREATE TABLE BRANCH(branch_id int AUTO_INCREMENT, location varchar(30) not null, PRIMARY KEY (branch_id));
CREATE TABLE TABLE_STATUS(table_id int, state varchar (20), `from` datetime not null,`to` datetime, PRIMARY KEY (table_id,state,`from`));
CREATE TABLE CUSTOMER(cust_id int AUTO_INCREMENT, fname varchar (30) not null,lname varchar (30) not null, email varchar (50) not null,password varchar (256) not null , phone_number varchar(20), profession varchar(30) , PRIMARY KEY (cust_id));
CREATE TABLE RESERVATION (cust_id int, table_id int, `from` datetime, `to` datetime not null, cost decimal(20,2) not null, reserved_hours int not null, PRIMARY KEY(cust_id,table_id,`from`));
CREATE TABLE ADMIN (admin_id int AUTO_INCREMENT, admin_email varchar (50),admin_password varchar(30), PRIMARY KEY (admin_id));

ALTER TABLE TABLE_STATUS ADD CONSTRAINT STATTABLEFK FOREIGN KEY (table_id) REFERENCES `TABLE` (table_id);
ALTER TABLE `TABLE` ADD CONSTRAINT BRATABFK FOREIGN KEY (branch_id) REFERENCES BRANCH (branch_id);
ALTER TABLE RESERVATION Add CONSTRAINT RESTABFK FOREIGN KEY (cust_id) REFERENCES CUSTOMER (cust_id);
ALTER TABLE RESERVATION Add CONSTRAINT RESTABFK2 FOREIGN KEY (table_id) REFERENCES `TABLE` (table_id);
