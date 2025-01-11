-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS facturas_db;
USE facturas_db;

-- Crear la tabla de clientes
CREATE TABLE clientes
(
    id_cliente     INT AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(100) NOT NULL,
    email          VARCHAR(150),
    telefono       VARCHAR(15),
    direccion      VARCHAR(255),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    grupo_negocio  VARCHAR(50) -- Campo para el grupo de negocio
);

-- Crear la tabla de productos
CREATE TABLE productos
(
    id_producto     INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(100)                  NOT NULL,
    tipo_producto   ENUM ('Molecula', 'Servicio') NOT NULL,
    precio_unitario DECIMAL(10, 2)                NOT NULL
);

-- Crear la tabla de ventas
CREATE TABLE ventas
(
    id_venta          INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente        INT            NOT NULL,
    id_producto       INT            NOT NULL,
    fecha_venta       DATE           NOT NULL,
    cantidad_m3       DECIMAL(10, 2) NOT NULL,
    total_mxn         DECIMAL(10, 2) NOT NULL,
    saldo_vencido     DECIMAL(10, 2) DEFAULT 0, -- Monto pendiente
    fecha_vencimiento DATE,                     -- Fecha de vencimiento de la venta
    FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente),
    FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
);

-- Insertar datos en la tabla de clientes
INSERT INTO clientes (nombre, email, telefono, direccion, grupo_negocio)
VALUES
    ('Cliente 1', 'cliente1@example.com', '555-1234', 'Calle 1, Ciudad', 'Agua Dulce'),
    ('Cliente 2', 'cliente2@example.com', '555-5678', 'Calle 2, Ciudad', 'SLP'),
    ('Cliente 3', 'cliente3@example.com', '555-9101', 'Calle 3, Ciudad', 'Agua Dulce'),
    ('Cliente 4', 'cliente4@example.com', '555-1122', 'Calle 4, Ciudad', 'SLP');

-- Insertar datos en la tabla de productos
INSERT INTO productos (nombre_producto, tipo_producto, precio_unitario)
VALUES
    ('Producto A', 'Molecula', 500.00),
    ('Producto B', 'Servicio', 300.00);

-- Insertar datos en la tabla de ventas
INSERT INTO ventas (id_cliente, id_producto, fecha_venta, cantidad_m3, total_mxn, saldo_vencido, fecha_vencimiento)
VALUES
    (1, 1, '2024-01-15', 50, 25000, 5000, '2024-03-01'),
    (2, 1, '2024-02-10', 40, 20000, 2000, '2024-02-25'),
    (3, 2, '2024-03-05', 60, 18000, 0, '2024-03-15'),
    (4, 1, '2024-03-20', 70, 35000, 10000, '2024-01-20'),
    (1, 2, '2024-04-15', 30, 9000, 3000, '2024-04-10'),
    (1, 1, '2024-01-20', 80, 40000, 0, '2024-04-01'),
    (2, 2, '2024-02-15', 100, 30000, 0, '2024-04-01'),
    (3, 1, '2024-02-25', 120, 60000, 0, '2024-03-01'),
    (4, 1, '2024-03-10', 200, 100000, 0, '2024-04-10'),
    (1, 2, '2024-04-05', 50, 15000, 0, '2024-05-01'),
    (2, 1, '2024-04-18', 30, 15000, 0, '2024-05-01');

-- Insertar muchos más datos en la tabla de clientes
INSERT INTO clientes (nombre, email, telefono, direccion, grupo_negocio)
VALUES
    ('Cliente 11', 'cliente11@example.com', '555-8899', 'Calle 11, Ciudad', 'Agua Dulce'),
    ('Cliente 12', 'cliente12@example.com', '555-9900', 'Calle 12, Ciudad', 'SLP'),
    ('Cliente 13', 'cliente13@example.com', '555-1010', 'Calle 13, Ciudad', 'Agua Dulce'),
    ('Cliente 14', 'cliente14@example.com', '555-1111', 'Calle 14, Ciudad', 'SLP'),
    ('Cliente 15', 'cliente15@example.com', '555-1212', 'Calle 15, Ciudad', 'Agua Dulce'),
    ('Cliente 16', 'cliente16@example.com', '555-1313', 'Calle 16, Ciudad', 'SLP'),
    ('Cliente 17', 'cliente17@example.com', '555-1414', 'Calle 17, Ciudad', 'Agua Dulce'),
    ('Cliente 18', 'cliente18@example.com', '555-1515', 'Calle 18, Ciudad', 'SLP'),
    ('Cliente 19', 'cliente19@example.com', '555-1616', 'Calle 19, Ciudad', 'Agua Dulce'),
    ('Cliente 20', 'cliente20@example.com', '555-1717', 'Calle 20, Ciudad', 'SLP'),
    ('Cliente 21', 'cliente21@example.com', '555-1818', 'Calle 21, Ciudad', 'Agua Dulce'),
    ('Cliente 22', 'cliente22@example.com', '555-1919', 'Calle 22, Ciudad', 'SLP'),
    ('Cliente 23', 'cliente23@example.com', '555-2020', 'Calle 23, Ciudad', 'Agua Dulce'),
    ('Cliente 24', 'cliente24@example.com', '555-2121', 'Calle 24, Ciudad', 'SLP'),
    ('Cliente 25', 'cliente25@example.com', '555-2222', 'Calle 25, Ciudad', 'Agua Dulce');

-- Insertar más productos
INSERT INTO productos (nombre_producto, tipo_producto, precio_unitario)
VALUES
    ('Producto G', 'Molecula', 800.00),
    ('Producto H', 'Servicio', 650.00),
    ('Producto I', 'Molecula', 900.00),
    ('Producto J', 'Servicio', 750.00),
    ('Producto K', 'Molecula', 1000.00),
    ('Producto L', 'Servicio', 850.00),
    ('Producto M', 'Molecula', 1100.00),
    ('Producto N', 'Servicio', 950.00),
    ('Producto O', 'Molecula', 1200.00),
    ('Producto P', 'Servicio', 1050.00),
    ('Producto Q', 'Molecula', 1300.00),
    ('Producto R', 'Servicio', 1150.00),
    ('Producto S', 'Molecula', 1400.00),
    ('Producto T', 'Servicio', 1250.00),
    ('Producto U', 'Molecula', 1500.00);

-- Insertar más datos en la tabla de ventas
INSERT INTO ventas (id_cliente, id_producto, fecha_venta, cantidad_m3, total_mxn, saldo_vencido, fecha_vencimiento)
VALUES
    (11, 1, '2024-06-10', 50, 25000, 0, '2024-07-10'),
    (12, 2, '2024-06-12', 30, 9000, 2000, '2024-07-12'),
    (13, 3, '2024-06-15', 40, 16000, 0, '2024-07-15'),
    (14, 4, '2024-06-18', 50, 25000, 5000, '2024-07-18'),
    (15, 5, '2024-06-20', 60, 30000, 0, '2024-07-20'),
    (16, 6, '2024-06-22', 80, 48000, 0, '2024-07-22'),
    (17, 7, '2024-06-25', 100, 70000, 0, '2024-07-25'),
    (18, 8, '2024-06-28', 120, 84000, 0, '2024-07-28'),
    (19, 9, '2024-07-01', 200, 120000, 0, '2024-08-01'),
    (20, 10, '2024-07-03', 150, 112500, 10000, '2024-08-03'),
    (21, 11, '2024-07-05', 180, 162000, 0, '2024-08-05'),
    (22, 12, '2024-07-07', 130, 104000, 0, '2024-08-07'),
    (23, 13, '2024-07-09', 140, 126000, 5000, '2024-08-09'),
    (24, 14, '2024-07-11', 160, 144000, 0, '2024-08-11'),
    (25, 15, '2024-07-13', 170, 153000, 0, '2024-08-13'),
    (11, 2, '2024-07-15', 50, 25000, 0, '2024-08-15'),
    (12, 3, '2024-07-17', 40, 16000, 0, '2024-08-17'),
    (13, 4, '2024-07-19', 60, 30000, 0, '2024-08-19'),
    (14, 5, '2024-07-21', 50, 25000, 0, '2024-08-21'),
    (15, 6, '2024-07-23', 70, 42000, 5000, '2024-08-23'),
    (16, 7, '2024-07-25', 90, 63000, 0, '2024-08-25'),
    (17, 8, '2024-07-27', 100, 75000, 0, '2024-08-27'),
    (18, 9, '2024-07-29', 110, 99000, 0, '2024-08-29'),
    (19, 10, '2024-07-31', 120, 108000, 0, '2024-09-01'),
    (20, 11, '2024-08-02', 130, 117000, 0, '2024-09-02'),
    (21, 12, '2024-08-04', 140, 126000, 0, '2024-09-04'),
    (22, 13, '2024-08-06', 150, 135000, 10000, '2024-09-06'),
    (23, 14, '2024-08-08', 160, 144000, 0, '2024-09-08'),
    (24, 15, '2024-08-10', 170, 153000, 0, '2024-09-10'),
    (25, 16, '2024-08-12', 180, 162000, 0, '2024-09-12');


-- Consultar ventas por cliente (MXN y m³)
-- Esta consulta es para pruebas rápidas
SELECT c.nombre AS cliente,
       SUM(v.cantidad_m3) AS total_m3,
       SUM(v.total_mxn) AS total_mxn
FROM ventas v
         INNER JOIN clientes c ON v.id_cliente = c.id_cliente
GROUP BY c.nombre
ORDER BY total_mxn DESC;

-- Consultar ventas mensuales por producto
SELECT p.nombre_producto,
       MONTH(v.fecha_venta) AS mes,
       SUM(v.total_mxn) AS ventas_mxn,
       SUM(v.cantidad_m3) AS ventas_m3
FROM ventas v
         INNER JOIN productos p ON v.id_producto = p.id_producto
GROUP BY p.nombre_producto, mes;

-- Consultar ventas anuales por producto
SELECT p.nombre_producto,
       YEAR(v.fecha_venta) AS anio,
       SUM(v.total_mxn) AS ventas_mxn,
       SUM(v.cantidad_m3) AS ventas_m3
FROM ventas v
         INNER JOIN productos p ON v.id_producto = p.id_producto
GROUP BY p.nombre_producto, anio;

-- Ventas por grupo de negocio (MXN)
SELECT c.grupo_negocio,
       SUM(v.total_mxn) AS ventas_mxn
FROM ventas v
         INNER JOIN clientes c ON v.id_cliente = c.id_cliente
GROUP BY c.grupo_negocio;

-- Clientes con saldo vencido y días vencidos (MXN)
SELECT c.nombre AS cliente,
       v.saldo_vencido,
       DATEDIFF(CURDATE(), v.fecha_vencimiento) AS dias_vencidos
FROM ventas v
         INNER JOIN clientes c ON v.id_cliente = c.id_cliente
WHERE v.saldo_vencido > 0
ORDER BY dias_vencidos DESC;
