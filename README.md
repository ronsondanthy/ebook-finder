# Student Pocket Book Project Readme

## Project Overview

The **Student Pocket Book** is a web application designed to provide a platform for students and faculty members to share and access educational resources. It includes features such as book uploads, administrative control, and user authentication. This readme file provides an overview of the project, its components, and how to set it up for use.

## Table of Contents

1. [Technologies Used](#technologies-used)
2. [Project Structure](#project-structure)
3. [Features](#features)
4. [Database Schema](#database-schema)
5. [Installation and Setup](#installation-and-setup)
6. [Usage](#usage)
7. [Contributing](#contributing)
8. [License](#license)

## Technologies Used

- **Frontend:**
  - HTML
  - CSS
  - Bootstrap

- **Backend:**
  - PHP
  - jQuery

- **Database:**
  - MySQL

- **Diagrams:**
  - ER Diagram
  - Sequence Diagram
  - Use Case Diagram

## Project Structure

The project is organized as follows:

- `index.html`: The main landing page of the application.
- `admin.php`: The admin panel for managing user uploads.
- `faculty.php`: Page for faculty members to upload books.
- `login.php`: User authentication page.
- `assets/`: Directory containing CSS, JavaScript, and image assets.
- `sql/`: SQL scripts for setting up the MySQL database.
- `diagrams/`: Contains ER, Sequence, and Use Case diagrams.

## Features

- **User Authentication:** Users (faculty and students) must log in to access the system.
- **Faculty Upload:** Faculty members can upload educational books to the system.
- **Admin Control:** An admin panel allows administrators to monitor and approve/reject book uploads.
- **Student Access:** Students can view and download approved books from the home page.

## Database Schema

The MySQL database schema includes tables for user accounts, uploaded books, and admin control. Detailed schema information can be found in the ER diagram located in the `diagrams/` directory.

## Installation and Setup

1. **Database Setup:**
   - Create a MySQL database and run the SQL scripts provided in the `sql/` directory to create the necessary tables and set up initial data.

2. **Web Server:**
   - Host the project files on a web server with PHP support (e.g., Apache).

3. **Configuration:**
   - Update the database connection configuration in PHP files (e.g., `db.php`) to match your database credentials.

4. **Bootstrap and Libraries:**
   - Ensure that Bootstrap and jQuery libraries are included in the project. You can use CDN links or download and include them locally.

## Usage

1. Access the application by navigating to the project's landing page.
2. Users (faculty and students) must log in using their credentials.
3. Faculty members can upload books through the "Upload" feature.
4. Admins can access the admin panel (`admin.php`) to review and approve/reject book uploads.
5. Approved books will be visible on the home page for students to view and download.

## Contributing

Contributions to this project are welcome. If you have ideas for improvements or would like to report issues, please feel free to submit a pull request or open an issue on the project's repository.

## License

This project is licensed under the [MIT License](LICENSE).