

create table wksinv
(
	serial_num varchar(45) primary key, 
	hostname varchar (45), 
	model varchar(25), 
	processor varchar (25), 
	ram varchar (8), 
	HDD_size_type varchar(20), 
	office_site varchar(25), 
	custodian varchar(25), 
	status varchar(15), 
	purchase_date varchar(25), 
	refresh_date varchar(25)
); 

