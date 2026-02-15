-- Vue pour récupérer les produits avec leur proprietaire actuel
CREATE OR REPLACE VIEW product_with_owner AS
SELECT p.id AS product_id, p.name AS product_name, p.description, p.price, p.product_image,
       c.name AS category_name, u.id AS user_id, u.username AS owner_name, u.email, u.phone
FROM product p
JOIN category c ON p.category_id = c.id
JOIN product_user pu ON p.id = pu.product_id
JOIN user u ON pu.user_id = u.id
WHERE pu.id = (SELECT MAX(id) FROM product_user WHERE product_id = p.id);

CREATE VIEW exchange_received_view AS
SELECT pe.*, s.status_name, p1.name AS myproduct, p2.name AS desiredproduct, u.username AS proposer, pu.user_id
FROM product_exchange pe
JOIN exchange_status s ON pe.id_status = s.id
JOIN product p1 ON pe.myproduct_id = p1.id
JOIN product p2 ON pe.desiredproduct_id = p2.id
JOIN product_user pu ON p2.id = pu.product_id
JOIN user u ON pu.user_id = u.id;

CREATE VIEW exchange_accepted_view AS
SELECT pe.*, p1.name AS myproduct, p2.name AS desiredproduct,
       u1.username AS proposer, u2.username AS receiver
FROM product_exchange pe
JOIN product p1 ON pe.myproduct_id = p1.id
JOIN product p2 ON pe.desiredproduct_id = p2.id
JOIN product_user pu1 ON p1.id = pu1.product_id
JOIN product_user pu2 ON p2.id = pu2.product_id
JOIN user u1 ON pu1.user_id = u1.id
JOIN user u2 ON pu2.user_id = u2.id
WHERE pe.id_status = 2;