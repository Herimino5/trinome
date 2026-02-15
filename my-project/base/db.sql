create database trinome_prepas;
use trinome_prepas;
create table admin (
    id int primary key auto_increment,
    adminname varchar(50) not null unique,
    password varchar(255) not null
);
INSERT INTO admin (adminname, password)
VALUES (
  'admin',
  'admin'

create table product_exchange_history (
    id int primary key auto_increment,
    exchange_id int not null,
    product_id int not null,
    from_user_id int not null,
    to_user_id int not null,
    exchanged_at datetime not null,
    foreign key (exchange_id) references product_exchange(id),
    foreign key (product_id) references product(id),
    foreign key (from_user_id) references user(id),
    foreign key (to_user_id) references user(id)
);
);
    id int primary key auto_increment,
    username varchar(50) not null unique,
    password varchar(255) not null,
    email varchar(100) not null unique,
    phone varchar(15) not null unique
);

-- Insertion d'utilisateurs fictifs (mot de passe: password123)
INSERT INTO user (username, password, email, phone) VALUES
('jean_dupont', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jean.dupont@email.com', '0601020304'),
('marie_martin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'marie.martin@email.com', '0612345678'),
('pierre_blanc', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pierre.blanc@email.com', '0623456789'),
('sophie_lefebvre', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sophie.lefebvre@email.com', '0634567890'),
('lucas_moreau', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lucas.moreau@email.com', '0645678901');

create table category (
    id int primary key auto_increment,
    name varchar(50) not null unique,
    description varchar(255) not null,
    image_ varchar(255) not null
);

-- Insertion de catégories
INSERT INTO category (name, description, image_) VALUES
('Électronique', 'Appareils électroniques et accessoires high-tech', 'electronique.jpg'),
('Mode', 'Vêtements et accessoires de mode pour tous', 'mode.jpg'),
('Maison & Jardin', 'Articles pour la maison et le jardin', 'maison.jpg'),
('Sports & Loisirs', 'Équipements sportifs et articles de loisirs', 'sports.jpg'),
('Livres & Média', 'Livres, musique, films et jeux', 'livres.jpg'),
('Beauté & Santé', 'Produits de beauté et de santé', 'beaute.jpg');

create table product (
    id int primary key auto_increment,
    name varchar(50) not null unique,
    description varchar(255) not null,
    price decimal(10, 2) not null,
    category_id int not null,
    product_image varchar(255) not null,
    foreign key (category_id) references category(id)
);

-- Insertion de produits
INSERT INTO product (name, description, price, category_id, product_image) VALUES
-- Électronique (category_id = 1)
('iPhone 15 Pro', 'Smartphone Apple dernière génération avec puce A17 Pro', 1299.99, 1, 'iphone15.jpg'),
('Samsung Galaxy S24', 'Smartphone Samsung avec écran AMOLED et caméra 200MP', 999.99, 1, 'galaxy-s24.jpg'),
('MacBook Air M3', 'Ordinateur portable ultra-léger avec puce M3', 1499.99, 1, 'macbook-air.jpg'),
('AirPods Pro', 'Écouteurs sans fil avec réduction de bruit active', 279.99, 1, 'airpods-pro.jpg'),
('Sony WH-1000XM5', 'Casque audio premium avec annulation du bruit', 399.99, 1, 'sony-headphones.jpg'),

-- Mode (category_id = 2)
('Jean Levi\'s 501', 'Jean classique coupe droite en denim bleu', 89.99, 2, 'levis-501.jpg'),
('Nike Air Max', 'Baskets Nike confortables pour le sport et la ville', 149.99, 2, 'nike-airmax.jpg'),
('Robe d\'été fleurie', 'Robe légère parfaite pour l\'été', 59.99, 2, 'robe-ete.jpg'),
('Veste en cuir', 'Veste en cuir véritable style motard', 249.99, 2, 'veste-cuir.jpg'),
('Sac à main Coach', 'Sac à main en cuir de luxe', 349.99, 2, 'sac-coach.jpg'),

-- Maison & Jardin (category_id = 3)
('Aspirateur Dyson V15', 'Aspirateur sans fil haute performance', 599.99, 3, 'dyson-v15.jpg'),
('Cafetière Nespresso', 'Machine à café avec système de capsules', 179.99, 3, 'nespresso.jpg'),
('Canapé 3 places', 'Canapé confortable en tissu gris', 799.99, 3, 'canape.jpg'),
('Lampe LED design', 'Lampe de table moderne avec variateur', 49.99, 3, 'lampe-led.jpg'),
('Set de jardin', 'Table et 4 chaises pour extérieur', 399.99, 3, 'set-jardin.jpg'),

-- Sports & Loisirs (category_id = 4)
('Vélo électrique', 'VTT électrique avec batterie longue durée', 1899.99, 4, 'velo-electrique.jpg'),
('Tapis de yoga', 'Tapis antidérapant pour yoga et fitness', 39.99, 4, 'tapis-yoga.jpg'),
('Raquette de tennis', 'Raquette Wilson Pro Staff légère', 199.99, 4, 'raquette-tennis.jpg'),
('Ballon de football', 'Ballon Nike officiel', 29.99, 4, 'ballon-foot.jpg'),
('Haltères 10kg', 'Paire d\'haltères réglables', 89.99, 4, 'halteres.jpg'),

-- Livres & Média (category_id = 5)
('Harry Potter - Édition', 'Coffret complet des 7 tomes', 79.99, 5, 'harry-potter.jpg'),
('PlayStation 5', 'Console de jeu nouvelle génération', 499.99, 5, 'ps5.jpg'),
('Kindle Paperwhite', 'Liseuse électronique avec écran anti-reflet', 139.99, 5, 'kindle.jpg'),
('Vinyle The Beatles', 'Collection albums vinyle remasterisés', 149.99, 5, 'beatles-vinyl.jpg'),
('Jeu d\'échecs', 'Échiquier en bois avec pièces sculptées', 69.99, 5, 'echecs.jpg'),

-- Beauté & Santé (category_id = 6)
('Sérum visage Dior', 'Sérum anti-âge premium', 129.99, 6, 'serum-dior.jpg'),
('Parfum Chanel N°5', 'Eau de parfum iconique 100ml', 159.99, 6, 'chanel-5.jpg'),
('Brosse à dents électrique', 'Oral-B avec capteur de pression', 89.99, 6, 'oral-b.jpg'),
('Crème solaire SPF 50', 'Protection solaire visage et corps', 24.99, 6, 'creme-solaire.jpg'),
('Montre Fitbit', 'Montre connectée suivi santé', 199.99, 6, 'fitbit.jpg');



-- Distribution des produits entre les utilisateurs
INSERT INTO product_user (product_id, user_id) VALUES
-- jean_dupont (user_id = 1)
(1, 1), (2, 1), (3, 1), (4, 1), (5, 1),
-- marie_martin (user_id = 2)
(6, 2), (7, 2), (8, 2), (9, 2), (10, 2),
-- pierre_blanc (user_id = 3)
(11, 3), (12, 3), (13, 3), (14, 3), (15, 3),
-- sophie_lefebvre (user_id = 4)
(16, 4), (17, 4), (18, 4), (19, 4), (20, 4),
-- lucas_moreau (user_id = 5)
(21, 5), (22, 5), (23, 5), (24, 5), (25, 5),
-- Répartition supplémentaire (chaque user reçoit aussi un produit d'une autre catégorie)
(6, 1), (11, 2), (16, 3), (21, 4), (1, 5);

-- Vue pour récupérer les produits avec leur propriétaire
CREATE VIEW product_with_owner AS
SELECT p.id AS product_id, p.name AS product_name, p.description, p.price, p.product_image,
       c.name AS category_name, u.id AS user_id, u.username AS owner_name, u.email, u.phone
FROM product p
JOIN category c ON p.category_id = c.id
JOIN product_user pu ON p.id = pu.product_id
JOIN user u ON pu.user_id = u.id;

create table product_user (
    id int primary key auto_increment,
    product_id int not null,
    user_id int not null,
    foreign key (product_id) references product(id),
    foreign key (user_id) references user(id)
);