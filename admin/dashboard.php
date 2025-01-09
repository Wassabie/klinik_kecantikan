<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$requiresAdmin = true;
include('../auth.php'); // Proteksi akses admin
include('../assets/db/database.php'); // Koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Konten Utama -->
    <div class="ml-64 p-6">
        <!-- Manajemen Promo -->
        <section id="promo" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Promo</h2>
            <!-- Konten Promo -->
            <?php include "promo/promos.php"; ?>
        </section>

        <!-- Manajemen Produk -->
        <section id="product" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Produk</h2>
            <!-- Konten Produk -->
            <?php include "products/products.php"; ?>
        </section>

        <!-- Manajemen Treatment -->
        <section id="treatment" class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Treatment</h2>
            <!-- Konten Treatment -->
            <?php include "treatments/treatments.php"; ?>
        </section>

        <!-- Manajemen Halaman Depan -->
        <section id="homepage">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Halaman Depan</h2>
            <!-- Konten Halaman Depan -->
            <?php include "home/home.php"; ?>
        </section>
    </div>
</body>
</html>
