# Resume (with PHP Login)

A simple PHP application that lets a user log in and view my resumé.

## Table of Contents

- [Features](#features)  
- [File Structure](#file-structure)  
- [Requirements](#requirements)  
- [Setup Instructions](#setup-instructions)  
- [Usage](#usage)  

## Features

- Login / logout functionality  
- Protected pages (only accessible when logged in)  
- Resume / profile display after login  

## File Structure

```bash
assets/ # CSS / images / static assets
css/ # Styles for the pages
config.php # Configuration (DB connection, constants)
data.php # Data logic / retrieval
index.php # Entry page / login form
login.php # Handles login processing
logout.php # Logs user out / destroys session
setup.sql # SQL script to create needed tables
```

## Requirements

- PHP (Latest Version)
- Browser (e.g Chrome, Edge)  
- PostgreSQL  
- PGSQL or PDO extension enabled  

## Setup Instructions

1. Clone or download the repository:
   ```bash
   git clone https://github.com/DenreiAngeles/Resume.git
   cd Resume
   ```

2. Run the `setup.sql` file to create the database and required tables:
   ```bash
   psql -U your_username -f setup.sql
   ```
   > Note: setup.sql already contains a CREATE DATABASE command, so you don’t need to create the database manually.
    After running it, connect to the new database using:
    ```bash
    psql -U your_username -d resumelogin_db
    ```

3. Update config.php with your PostgreSQL connection details:
    ```php
    $host     = "localhost";
    $port     = "5432";
    $dbname   = "resumelogin_db";
    $user     = "your_username"; // change to your username
    $password = "your_password"; // change to your password
    ```

4. Run using:
   ```bash
   php -S localhost:8000
   ```

5. Access in your browser via `http://localhost:8000/`

## Usage
- Enter a valid username and password (You can also register)
    > Note: the default username is `admin` and the password `admin123`.
- On successful login, you will be redirected to the résumé page
- Use `logout` button to end the session


