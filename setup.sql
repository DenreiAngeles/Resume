-- Create database (run this first)
CREATE DATABASE resumelogin_db;

-- Connect to the database before running the rest
\c resumelogin_db;

-- Create users table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create index on username for faster lookups
CREATE INDEX idx_username ON users(username);

-- Insert a test user (username: admin, password: admin123)
INSERT INTO users (username, password) VALUES ('admin', 'admin123');

-- Verify table creation
SELECT * FROM users;