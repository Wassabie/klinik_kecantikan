<?php
session_start();
$requiresAdmin = true;
include '../../auth.php'; // Proteksi akses
include '../../assets/db/database.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $newImage = $_FILES['image']['name'];

    if (!empty($newImage)) {
        $targetDir = "../../uploads/";
        $targetFile = $targetDir . basename($newImage);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $result = $conn->query("SELECT image FROM home_content WHERE id = $id");
            if ($result && $result->num_rows > 0) {
                $oldImage = $result->fetch_assoc()['image'];
                unlink($targetDir . $oldImage);
            }

            $stmt = $conn->prepare("UPDATE home_content SET title = ?, description = ?, image = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $description, $newImage, $id);
        } else {
            die("Gagal mengupload gambar baru.");
        }
    } else {
        $stmt = $conn->prepare("UPDATE home_content SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?success=Konten berhasil diupdate");
    } else {
        die("Error: " . $stmt->error);
    }
} else {
    die("Akses tidak valid.");
}
?>
