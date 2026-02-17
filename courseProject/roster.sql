CREATE TABLE roster (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100),
  last_name  VARCHAR(100),
  position VARCHAR(100),
  email      VARCHAR(150),
  phone      VARCHAR(20),
  changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);