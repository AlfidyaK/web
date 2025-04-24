<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama_tamu'];
    $email    = $_POST['email'];
    $no_telp  = $_POST['no_telepon'];
    $id_kamar = $_POST['id_kamar'];
    $checkin  = $_POST['check_in'];
    $checkout = $_POST['check_out'];

    // Simpan ke tabel reservasi
    mysqli_query($conn, "INSERT INTO reservasi (nama_tamu, email, no_telepon, id_kamar, check_in, check_out)
                         VALUES ('$nama', '$email', '$no_telp', '$id_kamar', '$checkin', '$checkout')");

    // Update status kamar
    mysqli_query($conn, "UPDATE kamar SET status='Terisi' WHERE id_kamar='$id_kamar'");

    echo "<p style='color: green;'><strong>Reservasi berhasil!</strong></p>";
}

// Ambil data kamar
$result_kamar = mysqli_query($conn, "SELECT k.*, t.nama_tipe FROM kamar k JOIN tipe_kamar t ON k.id_tipe = t.id_tipe");

// Ambil data reservasi
$result_reservasi = mysqli_query($conn, "SELECT * FROM reservasi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>UMS Hotel - Reservasi</title>
</head>
<body>
<a href="tambahKamar.php">
    <button type="button">Tambah Kamar</button>
</a>
    <h2>Daftar Kamar</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nomor Kamar</th>
            <th>Tipe Kamar</th>
            <th>tipe</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_kamar)) : ?>
        <tr>
            <td><?= $row['nomor_kamar']; ?></td>
            <td><?= $row['id_tipe']; ?></td>
            <td><?= $row['id_kamar']; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <a href="edit_kamar.php?id=<?= $row['id_kamar']; ?>">Edit</a>
                <a href="hapus_reservasi.php?id=<?= $row['id_kamar']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Form Reservasi</h2>
    <form action="reservasi.php" method="POST">
        <label>Nama Tamu:</label>
        <input type="text" name="nama_tamu" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Nomor Telepon:</label>
        <input type="text" name="telepon" required><br>
        
        <label>Tanggal Check-in:</label>
        <input type="date" name="check_in" required><br>
        
        <label>Tanggal Check-out:</label>
        <input type="date" name="check_out" required><br>
        
        <label>Pilih Kamar:</label>
        <select name="id_kamar" required>
            <?php
            $kamar_result = mysqli_query($conn, "SELECT * FROM kamar WHERE status = 'Tersedia'");
            while ($kamar = mysqli_fetch_assoc($kamar_result)) {
                echo "<option value='{$kamar['id_kamar']}'>{$kamar['nomor_kamar']}</option>";
            }
            ?>
        </select><br>
        
        <button type="submit">Reservasi</button>
    </form>

    <h2>Daftar Reservasi</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama Tamu</th>
            <th>Email</th>
            <th>Nomor Kamar</th>
            <th>Nomor Telepon</th>
            <th>Tanggal Check-in</th>
            <th>Tanggal Check-out</th>
            <th>Aksi</th>
        </tr>
        <?php while ($reservasi = mysqli_fetch_assoc($result_reservasi)) : ?>
        <tr>
            <td><?= $reservasi['nama_tamu']; ?></td>
            <td><?= $reservasi['email']; ?></td>
            <td><?= $reservasi['id_kamar']; ?></td>
            <td><?= $reservasi['telepon']; ?></td>
            <td><?= $reservasi['check_in']; ?></td>
            <td><?= $reservasi['check_out']; ?></td>
            <td>
                <a href="hapus_reservasi.php?id=<?= $reservasi['id_reservasi']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>