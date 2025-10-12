CREATE DATABASE cypherkomputer;

USE cypherkomputer;

CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    kategori VARCHAR(50),
    harga DECIMAL(10,2),
    foto VARCHAR(255)
);
