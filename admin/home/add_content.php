<?php
session_start();
$requiresAdmin = true;
include '../../auth.php'; // Proteksi akses admin
include '../../assets/db/database.php'; // Koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Content</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Tambah Konten Halaman Depan</h2>
            <form action="add_content_process.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Judul</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-md" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded">Tambah Konten</button>
            </form>
        </div>
    </div>
</body>
