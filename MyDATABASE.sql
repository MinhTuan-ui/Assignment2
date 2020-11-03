CREATE TABLE Agency(
	AgencyID serial PRIMARY KEY,
	Name VARCHAR (50) UNIQUE NOT NULL,
	Email varchar (255) not null,
	Username varchar (50) not null,
	Pass varchar (50) not null,
	Address VARCHAR (255) NOT NULL,
	Tel VARCHAR (20) UNIQUE NOT NULL
	);

CREATE TABLE Customer(
	CustomerID serial PRIMARY KEY,
	Name VARCHAR (50) NOT NULL,
	Address VARCHAR (355) NOT NULL,
	Tel VARCHAR (20) UNIQUE NOT NULL
	);

CREATE TABLE Category(
	CategoryID serial not null PRIMARY KEY,
	Name VARCHAR (50) NOT NULL
	);

CREATE TABLE Suppliery(
	SupplierID serial not null PRIMARY KEY,
	Name VARCHAR (50) not NULL,
	Address VARCHAR (355) NOT NULL,
	Tel VARCHAR (20) UNIQUE NOT NULL
	);

CREATE TABLE Product(
	ProductID serial not null unique PRIMARY KEY,
	Name VARCHAR (50) NOT NULL,
	Description VARCHAR (255),
	Image varchar(255) not null,
	Price numeric (5, 2) not null,
	CategoryID int references Category(CategoryID),
	SupplierID int references Suppliery(SupplierID)
	);

CREATE TABLE Bill(
	OrderID integer not null PRIMARY KEY,
	orderdate date ,
	ShippingAddress varchar (50),
	AgencyID int references Agency(AgencyID),
	CustomerID int references Customer(CustomerID)
	);

CREATE TABLE OrderDetail(
	OrderID int references Bill(OrderID),
	ProductID int references Product(ProductID),
	Quantity int not null,
	TotalCost numeric not null
	);

