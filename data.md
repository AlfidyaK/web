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
