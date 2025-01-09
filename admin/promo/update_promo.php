<?php
session_start();
$requiresAdmin = true;
include '../../auth.php'; // Proteksi akses
include '../../assets/db/database.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $valid_until = $_POST['valid_until'];
    $discount = $_POST['discount'];
    $newImage = $_FILES['image']['name'];

    if (!empty($newImage)) {
        $targetDir = "../../uploads/";
        $targetFile = $targetDir . basename($newImage);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $result = $conn->query("SELECT image FROM promos WHERE id = $id");
            if ($result && $result->num_rows > 0) {
                $oldImage = $result->fetch_assoc()['image'];
                unlink($targetDir . $oldImage);
            }

            $stmt = $conn->prepare("UPDATE promos SET title = ?, description = ?, discount = ?, valid_until = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $title, $description, $discount, $valid_until, $newImage, $id);
        } else {
            die("Gagal mengupload gambar baru.");
        }
    } else {
        $stmt = $conn->prepare("UPDATE promos SET title = ?, description = ?, discount = ?, valid_until = ? WHERE id = ?");
            $stmt->bind_param("ssisi", $title, $description, $discount, $valid_until, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?success=Promo berhasil diupdate");
    } else {
        die("Error: " . $stmt->error);
    }
} else {
    die("Akses tidak valid.");

}
?>