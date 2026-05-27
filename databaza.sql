CREATE DATABASE IF NOT EXISTS game_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE game_app;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    category_id INT,
    description TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

INSERT INTO categories (name) VALUES
('RPG'),
('FPS'),
('Strategy'),
('Adventure'),
('Sports');


INSERT INTO games (title, year, category_id, description) VALUES
('The Witcher 3', 2015, 1, 'Otvorený svet RPG od CD Projekt Red.'),
('GTA V', 2013, 2, 'Akčná hra v otvorenom svete od Rockstar Games.'),
('Civilization VI', 2016, 3, 'Ťahová strategická hra od Firaxis.'),
('Red Dead Redemption 2', 2018, 4, 'Epická dobrodružná hra na Divokom Západe.'),
('FIFA 23', 2022, 5, 'Futbalová simulácia od EA Sports.'),
('Cyberpunk 2077', 2020, 1, 'Futuristické RPG v Night City.'),
('Counter-Strike 2', 2023, 2, 'Taktická FPS strieľačka od Valve.');


INSERT INTO users (username, password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
