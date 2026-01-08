CREATE DATABASE MaBagnole;

CREATE TABLE users(
	user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL,
    user_password VARCHAR(250),
    role VARCHAR(100) DEFAULT 'customer'
);

CREATE TABLE categories(
	id INT AUTO_INCREMENT PRIMARY KEY,
    cate_name VARCHAR(150) NOT NULL
);

CREATE TABLE vehicles (
	vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(200) NOT NULL,
    price_day DECIMAL(10,2),
    vehicle_status VARCHAR(100),
    category_id INT,
    creat_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Vehicle_image	varchar(300),
    
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE reservations (
	reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vehicle_id INT,
    start_date DATE,
    end_date DATE,
    pickup_location VARCHAR(100),
    timeofcreating TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(vehicle_id)
);

CREATE TABLE reviews (
	reviews_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vehicle_id INT,
    rating VARCHAR(50),
    reviews_comment TEXT,
    deleted_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(vehicle_id)
);

-- insert

INSERT INTO users (user_name, email, user_password, role) VALUES
('Admin', 'mouad.gourita@gmail.com', 'admin123', 'admin'),
('Sara', 'sara@mail.com', 'pass123', 'customer'),
('Youssef', 'youssef@mail.com', 'pass123', 'customer'),
('Imane', 'imane@mail.com', 'pass123', 'customer'),
('Omar', 'omar@mail.com', 'pass123', 'customer'),
('Khalid', 'khalid@mail.com', 'pass123', 'customer'),
('Nadia', 'nadia@mail.com', 'pass123', 'customer'),
('Hassan', 'hassan@mail.com', 'pass123', 'customer'),
('Salma', 'salma@mail.com', 'pass123', 'customer');


INSERT INTO categories (cate_name) VALUES
('Economy'),
('SUV'),
('Luxury'),
('Electric'),
('Motorbike');


INSERT INTO vehicles (model, price_day, vehicle_status, category_id, Vehicle_image) VALUES
('Dacia Logan', 30.00, 'available', 1, 'logan.jpg'),
('Hyundai i10', 28.00, 'available', 1, 'i10.jpg'),
('Peugeot 208', 35.00, 'available', 1, '208.jpg'),

('Toyota Rav4', 70.00, 'available', 2, 'rav4.jpg'),
('Range Rover Evoque', 120.00, 'available', 2, 'evoque.jpg'),

('Mercedes C-Class', 95.00, 'available', 3, 'cclass.jpg'),
('BMW Serie 5', 130.00, 'available', 3, 'bmw5.jpg'),

('Tesla Model 3', 110.00, 'available', 4, 'tesla3.jpg'),

('Yamaha MT-07', 40.00, 'available', 5, 'mt07.jpg'),
('Honda CB500', 38.00, 'available', 5, 'cb500.jpg');


INSERT INTO reservations (user_id, vehicle_id, start_date, end_date, pickup_location) VALUES
(1, 1, '2025-01-10', '2025-01-15', 'Casablanca'),
(2, 2, '2025-01-12', '2025-01-18', 'Rabat'),
(3, 4, '2025-01-20', '2025-01-25', 'Marrakech'),
(4, 6, '2025-01-22', '2025-01-27', 'Agadir'),
(5, 5, '2025-01-05', '2025-01-10', 'Tanger'),
(7, 3, '2025-01-08', '2025-01-12', 'Casablanca'),
(8, 8, '2025-01-14', '2025-01-20', 'Rabat'),
(9, 9, '2025-01-18', '2025-01-21', 'Marrakech'),
(9, 10, '2025-01-25', '2025-01-30', 'Agadir'),
(1, 7, '2025-02-01', '2025-02-05', 'Casablanca');


INSERT INTO reviews (user_id, vehicle_id, rating, reviews_comment, deleted_at) VALUES
(1, 1, '5', 'Very clean and economical car', NULL),
(2, 2, '4', 'Good value for money', NULL),
(3, 4, '5', 'Perfect SUV for long trips', NULL),
(4, 6, '4', 'Luxury feeling, smooth drive', NULL),
(5, 5, '5', 'Amazing comfort and power', NULL),
(7, 3, '3', 'Average experience', NULL),
(8, 8, '5', 'Electric car was super quiet', NULL),
(9, 9, '4', 'Fun motorbike to ride', NULL),
(1, 7, '2', 'Too expensive for the value', '2025-01-01 12:00:00');


SELECT 
v.model, 
v.price_day, 
v.vehicle_status,
v.Vehicle_image,
r.reviews_comment,
u.user_name
FROM vehicles v
LEFT JOIN reviews r 
ON v.vehicle_id = r.vehicle_id
LEFT JOIN users u
ON r.user_id = u.user_id
WHERE v.vehicle_id = ? ;


-- Version 2 Sql Code 

CREATE TABLE themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT
);


CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    author_id INT NOT NULL,
    publish_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (theme_id) REFERENCES themes(id),
    FOREIGN KEY (author_id) REFERENCES users(user_id)
);


CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);


CREATE TABLE article_tags (
    article_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);


CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    author_id INT NOT NULL,
    content TEXT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE favorite_articles (
    client_id INT NOT NULL,
    article_id INT NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (client_id, article_id),
    FOREIGN KEY (client_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);


CREATE TABLE media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(500) NOT NULL,
    type VARCHAR(20) NOT NULL,
    article_id INT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);


INSERT INTO themes (title, description) VALUES
('Car Maintenance', 'Tips and guides on keeping your car in top shape'),
('Road Trips', 'Stories and advice for long drives and vacations'),
('Car Reviews', 'In-depth reviews of the latest vehicles');


INSERT INTO articles (theme_id, title, content, status, author_id, publish_date) VALUES
(1, 'How to Change Your Oil', 'Step by step guide to changing oil at home.', 'published', 1, '2026-01-01 10:00:00'),
(2, 'Best Routes for Winter Road Trips', 'Explore the most scenic routes this winter.', 'published', 2, '2026-01-02 12:30:00'),
(3, 'Tesla Model S Review', 'A deep dive into the Tesla Model S features.', 'pending', 3, NULL);


INSERT INTO tags (name) VALUES
('DIY'),
('Winter'),
('Electric'),
('Review'),
('Travel');


INSERT INTO article_tags (article_id, tag_id) VALUES
(1, 1), 
(2, 2),
(2, 5),
(3, 3),
(3, 4);


INSERT INTO comments (article_id, author_id, content) VALUES
(1, 2, 'Great guide, very helpful!'),
(1, 1, 'Thanks for sharing this information.'),
(2, 1, 'I love these routes!'),
(3, 2, 'Can’t wait to read more about Tesla.');


INSERT INTO favorite_articles (client_id, article_id) VALUES
(1, 1),
(2, 2);


INSERT INTO media (url, type, article_id) VALUES
('https://example.com/images/oil-change.jpg', 'image', 1),
('https://example.com/videos/winter-trip.mp4', 'video', 2),
('https://example.com/images/tesla-model-s.jpg', 'image', 3);

