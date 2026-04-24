CREATE DATABASE IF NOT EXISTS echo_creative_db;
USE echo_creative_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    home_address VARCHAR(255) NOT NULL,
    home_phone VARCHAR(30) NOT NULL,
    cell_phone VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (first_name, last_name, email, home_address, home_phone, cell_phone) VALUES
('Ava', 'Patel', 'ava.patel@echocreative.com', '120 Cedar St, San Jose, CA', '408-200-1001', '408-300-1001'),
('Noah', 'Kim', 'noah.kim@echocreative.com', '45 Willow Ave, Sunnyvale, CA', '408-200-1002', '408-300-1002'),
('Liam', 'Lopez', 'liam.lopez@echocreative.com', '78 Maple Rd, Santa Clara, CA', '408-200-1003', '408-300-1003'),
('Emma', 'Nguyen', 'emma.nguyen@echocreative.com', '9 Pine Ct, Milpitas, CA', '408-200-1004', '408-300-1004'),
('Mia', 'Singh', 'mia.singh@echocreative.com', '332 Bay St, Fremont, CA', '408-200-1005', '408-300-1005'),
('Ethan', 'Garcia', 'ethan.garcia@echocreative.com', '102 Market St, San Jose, CA', '408-200-1006', '408-300-1006'),
('Olivia', 'Rao', 'olivia.rao@echocreative.com', '67 El Camino, Mountain View, CA', '408-200-1007', '408-300-1007'),
('Lucas', 'Chen', 'lucas.chen@echocreative.com', '500 Main St, Cupertino, CA', '408-200-1008', '408-300-1008'),
('Sophia', 'Brown', 'sophia.brown@echocreative.com', '31 Park Ave, Palo Alto, CA', '408-200-1009', '408-300-1009'),
('Mason', 'Shah', 'mason.shah@echocreative.com', '810 Lake Dr, Saratoga, CA', '408-200-1010', '408-300-1010'),
('Isabella', 'Khan', 'isabella.khan@echocreative.com', '412 Oak St, Campbell, CA', '408-200-1011', '408-300-1011'),
('Logan', 'Wright', 'logan.wright@echocreative.com', '180 First St, Los Gatos, CA', '408-200-1012', '408-300-1012'),
('Amelia', 'Miller', 'amelia.miller@echocreative.com', '299 Creek Rd, San Jose, CA', '408-200-1013', '408-300-1013'),
('James', 'Taylor', 'james.taylor@echocreative.com', '740 North St, Cupertino, CA', '408-200-1014', '408-300-1014'),
('Charlotte', 'Das', 'charlotte.das@echocreative.com', '14 South Ave, Sunnyvale, CA', '408-200-1015', '408-300-1015'),
('Benjamin', 'Clark', 'benjamin.clark@echocreative.com', '58 State St, Santa Clara, CA', '408-200-1016', '408-300-1016'),
('Harper', 'Iyer', 'harper.iyer@echocreative.com', '920 River Rd, Milpitas, CA', '408-200-1017', '408-300-1017'),
('Elijah', 'Scott', 'elijah.scott@echocreative.com', '77 Mission St, Fremont, CA', '408-200-1018', '408-300-1018'),
('Evelyn', 'Young', 'evelyn.young@echocreative.com', '12 Center St, Palo Alto, CA', '408-200-1019', '408-300-1019'),
('Henry', 'Gomez', 'henry.gomez@echocreative.com', '350 Valley Rd, Mountain View, CA', '408-200-1020', '408-300-1020');

