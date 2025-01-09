<?php
session_start();
$requiresAdmin = true;
include '../../auth.php'; // Proteksi akses
include '../../assets/db/database.php'; // Koneksi database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konten Halaman Depan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include "../sidebar.php"; ?>
    <div class="ml-64 p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-700 mb-6">Edit Konten</h1>
            <?php
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                die("ID konten tidak ditemukan.");
            }

            $id = intval($_GET['id']);
            $result = $conn->query("SELECT * FROM home_content WHERE id = $id");

            if ($result->num_rows === 0) {
                die("Konten tidak ditemukan.");
            }

            $content = $result->fetch_assoc();
            ?>
            <form action="update_content.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $content['id'] ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Judul Konten</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($content['title']) ?>" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-pink-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi Konten</label>
                    <textarea name="description" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-pink-300" required><?= htmlspecialchars($content['description']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Gambar Konten</label>
                    <input type="file" name="image" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-pink-300">
                    <p class="text-sm text-gray-600 mt-2">Gambar saat ini:</p>
                    <img src="../../uploads/<?= htmlspecialchars($content['image']) ?>" alt="Gambar Konten" class="w-32 h-32 object-cover mt-2">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded hover:bg-pink-600 transition">
                        Update Konten
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
