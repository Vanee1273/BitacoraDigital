USE correo_bd;


INSERT INTO admins (nombre, correo, password, created_at)
VALUES ('admin2','rafavel555@gmail.com','Rafael',NOW());
SELECT * FROM admins;

INSERT INTO users (email, password, created_at, updated_at)
VALUES ('rafavel555@gmail.com','Rafael', NOW(),NOW());
SELECT * FROM users;