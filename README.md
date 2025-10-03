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

---

## 📂 Project Structure

The project follows a modified MVC structure for clear separation of concerns:

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
This is a well-detailed description of a mini-project\! I've gone through and polished the Markdown file to make it cleaner, more professional, and follow standard formatting conventions.

Here is the revised `README.md` file:

```markdown
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

```

LIBRARY (MINI PHP PROJECT)
│
├── ConfigurationDb/          \# Database connection settings
│   └── database.php
│
├── Controller/               \# Handles business logic and processing requests
│   ├── Admin\_Controller.php
│   ├── Appointments\_Controller.php
│   ├── Books\_Controller.php
│   └── LogOut.php            \# Session handling
│
├── Model/                    \# Handles all database interactions (data layer)
│   ├── Admins\_Model.php
│   ├── Appointments\_Model.php
│   ├── AuthorModel.php
│   ├── Books\_Model.php
│   ├── BooksCopies\_Model.php
│   ├── CategoriesModel.php
│   ├── Countries\_Model.php
│   └── Users\_Model.php
│
├── SQL/                      \# Database scripts and diagrams
│   ├── CREATE\_TABLES.sql
│   ├── DATA.sql
│   ├── select.sql
│   ├── SET\_RULES.sql
│   └── DB\_Diagram.jpg
│
├── View/                     \# Handles the presentation layer (HTML/CSS)
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
└── index.php                 \# Main entry point for the application
---

## ⚙️ Installation Guide

Follow these steps to get the project running on your local machine:

1.  **Clone the Repository:**
    ```bash
    git clone [repository-link-here] library-management
    ```
2.  **Server Setup:** Place the `library-management` folder into your local web server's root directory (e.g., `htdocs` for XAMPP or `www` for WAMP).
3.  **Import the Database:**
    * Open **phpMyAdmin** or your preferred MySQL tool.
    * **Create a new database** (e.g., `library_db`).
    * Import the scripts located in the `SQL/` directory, starting with `CREATE_TABLES.sql`.
4.  **Configure Database Connection:**
    * Open `ConfigurationDb/database.php`.
    * Update the credentials (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`) to match your local MySQL setup.
5.  **Access the Application:** Open your web browser and navigate to the project's root URL:
    ```
    http://localhost/library-management/
    ```
    The `index.php` file will automatically load the login page.

---

## 👨‍💻 Usage

The system is designed for **Administrators** to manage library operations.

* **Login:** Admins can log in using credentials (check `SQL/DATA.sql` for initial admin accounts).
* **Management:** Once logged in, admins can navigate the dashboard to perform actions:
    * **Manage Books:** Add new titles, update stock, or remove books.
    * **Manage Appointments:** Track and modify user scheduling.
    * **Manage Admins/Users:** Handle administrative and user accounts.

---

## 🔒 Security Highlights

Security was a priority during development:

* **SQL Injection Prevention:** Uses **PDO with prepared statements** for all database queries.
* **Password Security:** Implements **password hashing** for securely storing admin credentials.
* **Session Management:** Utilizes **PHP sessions** and **permissions checks** to enforce role-based access control and secure state.

---

## 🤝 Contributing

Contributions are always welcome! If you find a bug or have an idea for an enhancement, please feel free to open an issue or submit a pull request.

## 📜 License

This project is open-source. Feel free to use, modify, and distribute it for personal or educational purposes.
