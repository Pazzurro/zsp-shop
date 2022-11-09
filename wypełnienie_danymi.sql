INSERT INTO accounts (is_admin, lastname, name, nick_name, password, phone) VALUES
    (0, "Kowalski", "Kacper", "Kap123", "Kacper1", "032567832"),
    (0, "Dąb", "Wojciech", "Wojtek1992", "Wojciech1", "123456789"),
    (1, "Kapral", "Damian", "Pazzurro", "Damian1", "032567832"),
    (0, "Zdun", "Andrzej", "Andy", "Andrzej1", "546327843"),
    (1, "Nowak", "Agnieszka", "Agnieszka201", "Agi1", "032567832");

INSERT INTO advertisments (accounts_id, content, price, product_type_id, title) VALUES
    (1, "super telefon w dobrym stanie", 500.00, 2, "Nokia 3310"),
    (1, "super laptop w dobrym stanie jak nowy", 2500.00, 1, "Lenovo Ideapad"),
    (2, "szafa z dziurami", 50.00, 3, "Szafa duża"),
    (4, "dobry misker do kuchni", 200.00, 2, "Mikser Bosch"),
    (5, "super bluza z kapturem", 140.00, 2, "Bluza Nike");
    
INSERT INTO orders (accounts_id, advertisments_id, created_at, house_number, status_id, street, city, post_number) VALUES
    (3, 3, 2022-11-04, 21, 2, "Dworcowa", "Witkowo", "62-230"),
    (4, 1, 2022-09-20, 7, 3, "Poznańska", "Wraszawa", "02-368"),
    (1, 5, 2022-11-11, 21, 1, "Jana Pawła 2", "Poznań", "60-470");
    
INSERT INTO product_type (type) VALUES
    ("nowy"),
    ("używany"),
    ("uszkodzony");
    
INSERT INTO status (status) VALUES
    ("pakowany"),
    ("wysłany"),
    ("doręczony");