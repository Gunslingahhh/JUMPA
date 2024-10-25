-- Backup script for the Jumpa database
DROP TABLE IF EXISTS task;
DROP TABLE IF EXISTS users;

-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    fullname VARCHAR(100) NOT NULL,
    gender VARCHAR(10),
    age INT,
    contact VARCHAR(20),
    race VARCHAR(50),
    religion VARCHAR(50),
    language VARCHAR(50)
);

-- Task table
CREATE TABLE task (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    task_title VARCHAR(255) NOT NULL,
    task_description TEXT NOT NULL,
    task_date DATE NOT NULL,
    task_duration VARCHAR(50) NOT NULL,
    task_location VARCHAR(255) NOT NULL,
    task_toolsRequired VARCHAR(255),
    task_pax INT NOT NULL,
    task_price DECIMAL(10, 2) NOT NULL,
    task_dressCode VARCHAR(255),
    task_gender VARCHAR(50),
    task_nationality VARCHAR(100),
    task_ageRange VARCHAR(50),
    task_muslimFriendly BOOLEAN,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Dummy data the users table
INSERT INTO users (email, fullname, gender, age, contact, race, religion, language) VALUES
('john.doe@example.com', 'John Doe', 'Male', 30, '123456789', 'Caucasian', 'Christian', 'English'),
('jane.smith@example.com', 'Jane Smith', 'Female', 28, '987654321', 'Asian', 'Buddhist', 'Mandarin');

-- Dummy data for the task table
INSERT INTO task (task_title, task_description, task_date, task_duration, task_location, task_toolsRequired, task_pax, task_price, task_dressCode, task_gender, task_nationality, task_ageRange, task_muslimFriendly, user_id) VALUES
('Task 1', 'Description of task 1', '2024-10-30', '2 hours', 'Location 1', 'Tool A, Tool B', 5, 100.00, 'Casual', 'Any', 'Local', '18-30', FALSE, 1),
('Task 2', 'Description of task 2', '2024-11-05', '3 hours', 'Location 2', 'Tool C', 10, 150.00, 'Formal', 'Female', 'International', '25-35', TRUE, 2);
