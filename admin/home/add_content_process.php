<?php
session_start();
$requiresAdmin = true;
include '../../auth.php'; // Proteksi akses admin
include '../../assets/db/database.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageName = $_FILES['image']['name'];
    $targetDir = "../../uploads/";
    $targetFile = $targetDir . basename($imageName);

    // Upload file gambar
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        // Simpan data ke database
        $stmt = $conn->prepare("INSERT INTO home_content (title, description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $imageName);

        if ($stmt->execute()) {
            header("Location: ../dashboard.php");
        } else {
            die("Error: " . $stmt->error);
        }
    } else {
        die("Gagal mengupload gambar.");
    }
} else {
    die("Akses tidak valid.");
}
?>
