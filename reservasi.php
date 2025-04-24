
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reservasi = $_POST['id_reservasi'];
    $nama_tamu = $_POST['nama_tamu'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $id_kamar = $_POST['id_kamar'];

    $query = "INSERT INTO reservasi (id_reservasi, nama_tamu, email, telepon, check_in, check_out, id_kamar) VALUES ('$id_reservasi','$nama_tamu', '$email', '$telepon', '$check_in', '$check_out', '$id_kamar')";
    
    if (mysqli_query($conn, $query)) {
        // Update status kamar
        mysqli_query($conn, "UPDATE kamar SET status = 'Terisi' WHERE id_kamar = '$id_kamar'");
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
 
