# 📚 Library Management System (mini project)  

A simple **Library Management System** built with **Pure PHP**, **PDO**, **MySQL**, **HTML**, and **CSS**.  
This project allows managing **appointments**, **books**, and **admins** in a library environment.  

---

## 🚀 Features  
- 🔐 Admin authentication & management  
- 📖 Add, update, delete, and list books  
- 📅 Manage appointments for library users  
- 👨‍💻 Role-based access for admins  
- 📊 Simple, clean, and responsive UI (HTML & CSS only)  

---

## 🛠️ Technologies Used  
- **PHP (Pure PHP, no frameworks)**  
- **PDO (PHP Data Objects) for secure database connection**  
- **MySQL** as the database  
- **HTML5 & CSS3** for frontend  

---

## 📂 Project Structure  

## 📂 Project Structure  

```bash
LIBRARY (MINI PHP PROJECT)
│── ConfigurationDb/
│   └── database.php
│
│── Controller/
│   ├── Admin_Controller.php
│   ├── Appointments_Controller.php
│   ├── Books_Controller.php
│   └── LogOut.php
│
│── Model/
│   ├── Admins_Model.php
│   ├── Appointments_Model.php
│   ├── AuthorModel.php
│   ├── Books_Model.php
│   ├── BooksCopies_Model.php
│   ├── CategoriesModel.php
│   ├── Countries_Model.php
│   └── Users_Model.php
│
│── SQL/
│   ├── CREATE_TABLES.sql
│   ├── DATA.sql
│   ├── select.sql
│   ├── SET_RULES.sql
│   ├── DB_Diagram.jpg
│
│── View/
│   ├── Appointments/
│   ├── Authors.html
│   ├── Books.php
│   ├── BooksCopies.html
│   ├── Categories.html
│   ├── Dashboard.php
│   ├── Login.php
│   ├── ManageAdmins.php
│   └── Users.html
...
└── index.php



## ⚙️ Installation

Clone the repository

Import the database

Go to phpMyAdmin or MySQL CLI.

Create a database (the sql files are included in the project).

Configure the database connection

Open ConfigurationDb/database.php.

Update your database credentials as your database info

Run the project

Place the project inside the htdocs folder (XAMPP) or www folder (WAMP).

Access it via:

http://localhost/ -- and press enter the index file will handle the process

## 👨‍💻 Usage

Admins can log in and manage books, users, and appointments.

Appointments can be scheduled, updated, or canceled.

Books can be added, edited, or removed.

## 🔒 Security :

 PDO with prepared statements to prevent SQL injection.
 Password hashing.
 sessions and permissions management.


## 🤝 Contributing

Contributions are welcome!

## 📜 License
feel free to use, modify, and distribute it.

