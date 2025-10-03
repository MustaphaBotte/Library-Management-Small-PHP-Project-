# 📚 Library Management System (Mini Project)

A simple, role-based **Library Management System** built with **Pure PHP**, utilizing the **Model-View-Controller (MVC)** structure for managing library operations.

## 🚀 Features

This system provides a clean, responsive interface for core administrative tasks:

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

While the full file structure isn't listed here, the project generally follows this organization:

* **`ConfigurationDb/`**: Database connection settings.
* **`Controller/`**: Handles business logic and processing requests.
* **`Model/`**: Handles all database interactions and data validation.
* **`View/`**: Handles the presentation layer (HTML/CSS).
* **`SQL/`**: Contains database creation and data scripts.
* **`index.php`**: The main application entry point.

---

## ⚙️ Installation Guide

Follow these steps to get the project running on your local machine:

1.  **Clone the Repository.**
2.  **Server Setup:** Place the project folder inside your local web server's root directory (e.g., **`htdocs`** for XAMPP or **`www`** for WAMP).
3.  **Import the Database:**
    * Go to **phpMyAdmin** or your MySQL CLI.
    * **Create a database.**
    * Import the SQL files provided in the `SQL/` directory (start with `CREATE_TABLES.sql`).
4.  **Configure Connection:**
    * Open **`ConfigurationDb/database.php`**.
    * Update your database credentials (username, password, database name) to match your local server information.
5.  **Access the Application:** Open your web browser and navigate to the project's root URL (e.g., `http://localhost/`). The **`index.php`** file will handle the initial process.

---

## 👨‍💻 Usage

The system is designed for **Administrators** to manage library operations through the login page (`Login.php`):

* **Book Management:** Books can be **added, edited, or removed**.
* **Appointment Management:** Appointments can be **scheduled, updated, or canceled**.
* **Admin Tasks:** Admins can manage users and other administrator accounts.

---

## 🔒 Security

Security was addressed using industry best practices:

* **SQL Injection Prevention:** Uses **PDO with prepared statements** for all database queries.
* **Password Security:** Implements **password hashing** for securely storing admin credentials.
* **Access Control:** Utilizes **PHP sessions** and **permissions management** to enforce role-based access.

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the issues page or submit a pull request.

## 📜 License

This project is open-source. Feel free to use, modify, and distribute it.

-----

## 📂 Project Structure

The project follows a modified MVC structure for clear separation of concerns:

```
LIBRARY (MINI PHP PROJECT)
│
├── ConfigurationDb/          # Database connection settings
│   └── database.php
│
├── Controller/               # Handles   requests
│   ├── Admin_Controller.php
│   ├── Appointments_Controller.php
│   ├── Books_Controller.php
│   └── LogOut.php            # Session handling
│
├── Model/                    # Handles all database interactions (data layer) and business domain.
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

The corruption likely happened because the original Markdown output wasn't placed inside a **code block** (using triple backticks ` ``` `), which is necessary to preserve the spacing and line breaks of a file tree structure.


