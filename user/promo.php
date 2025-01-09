<?php
include('../auth.php');
include '../assets/db/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!-- BG -->
<div class="bg-[url('../uploads/rumah_sakit.jpg')] bg-cover bg-contain">

<!-- Navbar -->
<?php include "../layout/navbar.php" ?>


<!-- Header Section -->
<header class="text-black-300 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-2">Promo Eksklusif Klinik Kecantikan</h1>
        <p class="text-lg">Manfaatkan penawaran terbatas ini untuk perawatan kecantikan terbaik.</p>
    </div>
</header>
<!-- Promo Section -->
<div>
    <section class="py-10 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-6">Penawaran Spesial</h2>
            <!-- Grid for Promotions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                // Query untuk mengambil data dari tabel promosi
                $query = "SELECT * FROM promos WHERE valid_until >= CURDATE()";
                $result = $conn->query($query);

                // Loop untuk menampilkan setiap promosi
                while ($promo = $result->fetch_assoc()):
                ?>
                    <!-- Promo Card -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="../uploads/<?= htmlspecialchars($promo['image']) ?>" alt="<?= htmlspecialchars($promo['title']) ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold"><?= htmlspecialchars($promo['title']) ?></h3>
                            <p class="text-gray-600 text-sm mt-2"><?= htmlspecialchars($promo['description']) ?></p>
                            <p class="text-pink-500 font-semibold mt-2">Diskon: <?= htmlspecialchars($promo['discount']) ?>%</p>
                            <button class="mt-4 bg-pink-500 text-white py-2 px-4 rounded hover:bg-pink-600 transition">
                                Dapatkan Sekarang
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</div>



<!-- Footer -->
<?php include "../layout/footer.php" ?>

</body>
</html>
