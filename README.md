# 📚 Library Management System (Mini Project)

A simple, role-based **Library Management System** built with **Pure PHP**, utilizing the **Model-View-Controller (MVC)** pattern for managing library operations.

## 🚀 Features

This system provides a clean, responsive interface for administrative tasks:

* **🔐 Admin Authentication & Management:** Secure login and complete CRUD (Create, Read, Update, Delete) for admin accounts.
* **👨‍💻 Role-Based Access Control (RBAC):** Permissions management to restrict admin access based on their assigned role.
* **📖 Book Management:** Comprehensive CRUD operations for all library books.
* **📅 Appointment Management:** System to schedule, track, update, and cancel user appointments.
* **📊 Clean UI:** A simple, **responsive** user interface built with **HTML5 & CSS3** only.

---

## 🛠️ Technologies Used

The project is built using a classic LAMP/XAMPP stack setup:

* **Backend:** **PHP** (Pure PHP, no frameworks)
* **Database:** **MySQL**
* **Security:** **PDO (PHP Data Objects)** for secure, parameterized database connections.
* **Frontend:** **HTML5** & **CSS3**

---

## 📂 Project Structure

The project follows a modified MVC structure for clear separation of concerns:
This is a well-detailed description of a mini-project! I've gone through and polished the Markdown file to make it cleaner, more professional, and follow standard formatting conventions.

Here is the revised README.md file:

Markdown

# 📚 Library Management System (Mini Project)

A simple, role-based **Library Management System** built with **Pure PHP**, utilizing the **Model-View-Controller (MVC)** pattern for managing library operations.

## 🚀 Features

This system provides a clean, responsive interface for administrative tasks:

* **🔐 Admin Authentication & Management:** Secure login and complete CRUD (Create, Read, Update, Delete) for admin accounts.
* **👨‍💻 Role-Based Access Control (RBAC):** Permissions management to restrict admin access based on their assigned role.
* **📖 Book Management:** Comprehensive CRUD operations for all library books.
* **📅 Appointment Management:** System to schedule, track, update, and cancel user appointments.
* **📊 Clean UI:** A simple, **responsive** user interface built with **HTML5 & CSS3** only.

---

## 🛠️ Technologies Used

The project is built using a classic LAMP/XAMPP stack setup:

* **Backend:** **PHP** (Pure PHP, no frameworks)
* **Database:** **MySQL**
* **Security:** **PDO (PHP Data Objects)** for secure, parameterized database connections.
* **Frontend:** **HTML5** & **CSS3**

You are absolutely right\! The image shows that the **Project Structure** section in the Markdown file got corrupted during the rendering process. Instead of a neat, readable tree structure, all the files and folders were compressed onto a few lines, making it impossible to read.

The correct, well-formatted project structure should look like this (as it appeared in the full Markdown file I provided):

-----

## 📂 Project Structure

The project follows a modified MVC structure for clear separation of concerns:

```
LIBRARY (MINI PHP PROJECT)
│
├── ConfigurationDb/          # Database connection settings
│   └── database.php
│
├── Controller/               # Handles business logic and processing requests
│   ├── Admin_Controller.php
│   ├── Appointments_Controller.php
│   ├── Books_Controller.php
│   └── LogOut.php            # Session handling
│
├── Model/                    # Handles all database interactions (data layer)
│   ├── Admins_Model.php
│   ├── Appointments_Model.php
│   ├── AuthorModel.php
│   ├── Books_Model.php
│   ├── BooksCopies_Model.php
│   ├── CategoriesModel.php
│   ├── Countries_Model.php
│   └── Users_Model.php
│
├── SQL/                      # Database scripts and diagrams
│   ├── CREATE_TABLES.sql
│   ├── DATA.sql
│   ├── select.sql
│   ├── SET_RULES.sql
│   └── DB_Diagram.jpg
│
├── View/                     # Handles the presentation layer (HTML/CSS)
│   ├── Appointments/
│   ├── Authors.html
│   ├── Books.php
│   ├── BooksCopies.html
│   ├── Categories.html
│   ├── Dashboard.php
│   ├── Login.php
│   ├── ManageAdmins.php
│   └── Users.html
│
└── index.php                 # Main entry point for the application
```

-----
