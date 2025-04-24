
<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id_reservasi = $_GET['id'];
    $query = "DELETE FROM reservasi WHERE id_reservasi = '$id_reservasi'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM kamar WHERE id_kamar=$id");
header("Location: index.php");
?>

