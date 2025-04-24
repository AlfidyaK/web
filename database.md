## database
CREATE TABLE tipe_kamar (
    id_tipe INT AUTO_INCREMENT PRIMARY KEY,
    nama_tipe VARCHAR(50),
    harga_per_malam DECIMAL(10,2)
);

CREATE TABLE kamar (
    id_kamar INT AUTO_INCREMENT PRIMARY KEY,
    nomor_kamar VARCHAR(10),
    id_tipe INT,
    status ENUM('Tersedia', 'Terisi') DEFAULT 'Tersedia',
    FOREIGN KEY (id_tipe) REFERENCES tipe_kamar(id_tipe)
);

CREATE TABLE reservasi (
    id_reservasi INT AUTO_INCREMENT PRIMARY KEY,
    id_kamar INT,
    nama_tamu VARCHAR(100),
    email VARCHAR(100),
    telepon VARCHAR(20),
    check_in DATE,
    check_out DATE,
    FOREIGN KEY (id_kamar) REFERENCES kamar(id_kamar)
);

INSERT INTO tipe_kamar (id_tipe, nama_tipe, harga_per_malam) VALUES
(1, 'Standar', 300000),
(2, 'Deluxe', 500000),
(3, 'Suite', 800000);

INSERT INTO kamar (id_kamar, nomor_kamar, id_tipe, status) VALUES
(1, '1', 1, 'Tersedia'),
(2, '2', 1, 'Terisi'),
(3, '3', 2, 'Tersedia'),
(4, '4', 2, 'Tersedia'),
(5, '5', 3, 'Tersedia'),
(6, '6', 3, 'Terisi');
