TODO List Application (PHP + MySQL)

A simple and elegant TODO List Web Application built using PHP, MySQL, HTML, CSS, and a little JavaScript.
This project allows users to:

✔ Add tasks
✔ Edit tasks
✔ Delete tasks
✔ Mark tasks as Completed / Not Completed
✔ Store all tasks in MySQL database
✔ Clean and responsive UI

Features

📝 Add new tasks

✏ Edit existing tasks

❌ Delete tasks

✔ Mark tasks as Completed

❗ Mark tasks as Pending

🎨 Modern and attractive UI

📦 Stores tasks in MySQL database

⚡ Fast and lightweight

Technologies Used

PHP (Core PHP)

MySQL (Database)

HTML5

CSS3

JavaScript

XAMPP / WAMP / LAMP
Database Setup

Create a MySQL database:

CREATE DATABASE todoapplicationpro;


Then create the table:

CREATE TABLE todo (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Status ENUM('Completed', 'Pending') DEFAULT 'Pending'
);

▶️ How to Run the Project

Install XAMPP or WAMP

Place project folder in:

/xampp/htdocs/  (on Windows)
/var/www/html/  (on Linux)


Start Apache and MySQL

Import the SQL file into phpMyAdmin

Open the browser and go to:

http://localhost/todo-application/

📸 Screenshots

<img width="1366" height="728" alt="image" src="https://github.com/user-attachments/assets/62343062-928b-4811-9ef7-a4e03f1ecf4c" />
<img width="1366" height="728" alt="image" src="https://github.com/user-attachments/assets/48652484-a0ae-4fb4-96e6-81c39894ba83" />

