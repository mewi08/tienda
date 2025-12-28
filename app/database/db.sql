DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda;

Create table juguetes(
id          INT AUTO_INCREMENT PRIMARY KEY,
nombre      VARCHAR(50) NOT NULL,
descripcion VARCHAR (100) NOT NULL,
marca       ENUM ('LEGO','Mattel','Hasbro','Nerf', 'VTech','WowWee','Fisher-Price') NOT NULL,
precio      TINYINT NOT NULL,
categoria   ENUM('Muñecos y figuras','Construcción y creatividad','Juegos educativos','Juegos de mesa','Vehículos y pistas','Juguetes tecnológicos','Juguetes de acción') NOT NULL,
edadminima  TINYINT NOT NULL,
stock       SMALLINT NOT NULL,
ingreso     DATE NOT NULL,
created     DATETIME NOT NULL DEFAULT NOW(),
updated     DATETIME NULL
)ENGINE= InnoDB;

INSERT INTO juguetes
(nombre, descripcion, marca, precio, categoria, edadminima, stock, ingreso)
VALUES
('Bloques Creativos', 'Set de bloques para construir figuras', 'LEGO', 80, 'Construcción y creatividad', 5, 30, '2025-01-10'),
('Muñeca Fashion', 'Muñeca con accesorios modernos', 'Mattel', 60, 'Muñecos y figuras', 4, 25, '2025-01-12'),
('Auto de Carreras', 'Vehículo con pista desmontable', 'Hasbro', 50, 'Vehículos y pistas', 6, 20, '2025-01-15'),
('Juego Aprende Letras', 'Juego educativo interactivo', 'VTech', 45, 'Juegos educativos', 3, 18, '2025-01-18'),
('Robot Inteligente', 'Robot programable para niños', 'WowWee', 95, 'Juguetes tecnológicos', 8, 10, '2025-01-20');

/*ALTER TABLE juguete DROP COLUMN edadmaxima;*/
SELECT id,nombre, descripcion, marca, precio, categoria, edadminima, stock, ingreso
FROM juguetes
ORDER BY id DESC;