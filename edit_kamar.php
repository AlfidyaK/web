
<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id_kamar = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar = '$id_kamar'");
    $kamar = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_kamar = $_POST['nomor_kamar'];
    $id_tipe = $_POST['id_tipe'];
    $status = $_POST['status'];

    $query = "UPDATE kamar SET nomor_kamar = '$nomor_kamar', id_tipe = '$id_tipe',  status = '$status' WHERE id_kamar = '$id_kamar'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Kamar</title>
</head>
<body>
    <h2>Edit Kamar</h2>
    <form action="" method="POST">
        <label>Nomor Kamar:</label>
        <input type="text" name="nomor_kamar" value="<?= $kamar['nomor_kamar']; ?>" required><br>
        
        <label>Tipe Kamar:</label>
        <select name="id_tipe" required>
            <?php
            $tipe_result = mysqli_query($conn, "SELECT * FROM tipe_kamar");
            while ($tipe = mysqli_fetch_assoc($tipe_result)) {
                $selected = ($tipe['id_tipe'] == $kamar['id_tipe']) ? 'selected' : '';
                echo "<option value='{$tipe['id_tipe']}' $selected>{$tipe['nama_tipe']}</option>";
            }
            ?>
        </select><br>
        
        <label>Status:</label>
        <select name="status" required>
            <option value="Tersedia" <?= ($kamar['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
            <option value="Terisi" <?= ($kamar['status'] == 'Terisi') ? 'selected' : ''; ?>>Terisi</option>
        </select><br>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>