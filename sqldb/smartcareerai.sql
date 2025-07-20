-- Create Database
CREATE DATABASE IF NOT EXISTS smartcareerai;
USE smartcareerai;

-- Table: users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: admins
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);

-- Table: test_questions
CREATE TABLE test_questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_text TEXT NOT NULL,
  category VARCHAR(50),
  option_a VARCHAR(255),
  option_b VARCHAR(255),
  option_c VARCHAR(255),
  option_d VARCHAR(255)
);

-- Table: test_answers
CREATE TABLE test_answers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  question_id INT,
  selected_option VARCHAR(10),
  answered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (question_id) REFERENCES test_questions(id)
);

-- Table: results
CREATE TABLE results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  ai_output TEXT,
  generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: careers
CREATE TABLE careers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  description TEXT,
  category VARCHAR(100),
  roadmap_link VARCHAR(255)
);

-- Table: mentors
CREATE TABLE mentors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  field VARCHAR(100),
  bio TEXT
);

-- Table: reports
CREATE TABLE reports (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  activity VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: logs (Optional AI logging)
CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  prompt TEXT,
  response TEXT,
  log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: Tokens (For User Login/Registration)
CREATE TABLE auth_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    selector VARCHAR(255) NOT NULL,
    hashed_validator VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    expires DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
