create database Biblio;
use Biblio;
select * from books  where bookid >= 100
create table Books
(
BookId int primary key auto_increment,
Isbn varchar(20) unique not null,
BookName varchar(255)  not null,
BookDescription TEXT null,
NumberOfPages int null,
PublishedAt date null,
BookLanguage varchar(20) ,
AuthorId int ,
CategoryId int
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table Admins
(
AdminId int primary key auto_increment,
FirstName varchar(20) not null,
LastName varchar(20) not null,
Phone varchar(15) not null,
Mail  varchar(254) null,
DateOfBirth DATE NULL,
Gender ENUM('male', 'female') not NULL,
NationalityId int,
Address varchar(255) ,
AdminStatus Enum('active','inactive','suspended') default 'active',
UserName varchar(50) not null unique,
PassWord varchar(255) not null,
CreatedBy int ,
CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Users (
    UserId INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    Phone VARCHAR(15) NOT NULL,
    Email VARCHAR(254) NULL,
    NationalityId INT,
    Address VARCHAR(255)  NULL,
    UserStatus ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,  
    DateOfBirth DATE not NULL,
    Gender ENUM('male', 'female')not NULL,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    CreatedBy int 
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE Authors (
    AuthorId INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    NationalityId INT,
    DateOfBirth DATE NULL,
    Gender ENUM('male', 'female')not NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table Appointments
(
  AppointmentId INT PRIMARY KEY AUTO_INCREMENT,
  UserId INT NOT NULL,
  AppointmentDate DATE NOT NULL,
  AppointmentTime TIME NOT NULL,
  Description TEXT null,
  CreatedAt datetime not null,
  CreatedBy int 
  );

create table Categories
(
CategoryId int PRIMARY KEY AUTO_INCREMENT,
CategoryName VARCHAR(20) NOT NULL,
CategoryDescription TEXT null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table Countries
(CountryID int primary key auto_increment,
CountryName varchar(50)
);


create table Bookscopies
( 
CopyID int primary key auto_increment,
BookID int,
Status Enum('available','rented')
)
















