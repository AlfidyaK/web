<?php include 'db.php'; ?>
<h2>Tambah Data Kamar</h2>

<form method="POST">
    Nomor Kamar: <input type="text" name="nomor_kamar" required><br><br>
    
    Tipe Kamar: 
    <select name="id_tipe" required>
        <option value="">-- Pilih Tipe --</option>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM tipe_kamar");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['id_tipe']}'>{$row['nama_tipe']}</option>";
        }
        ?>
    </select><br><br>

    Status:
    <select name="status">
        <option value="Tersedia">Tersedia</option>
        <option value="Terisi">Terisi</option>
    </select><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nomor = $_POST['nomor_kamar'];
    $id_tipe = $_POST['id_tipe'];
    $status = $_POST['status'];

    $insert = mysqli_query($conn, "INSERT INTO kamar (nomor_kamar, id_tipe, status) 
                                   VALUES ('$nomor', '$id_tipe', '$status')");
    
    if ($insert) {
        echo "<p>Kamar berhasil ditambahkan!</p>";
    } else {
        echo "<p>Gagal menambahkan kamar: " . mysqli_error($conn) . "</p>";
    }
}
?>
