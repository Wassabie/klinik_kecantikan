<?php
include('../auth.php');
include '../assets/db/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treatment</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <!-- BG -->
    <div class="bg-[url('../uploads/rumah_sakit.jpg')] bg-cover bg-contain">

    <!-- NAVBAR -->
    <?php include "../layout/navbar.php" ?>

    <!-- Header Section -->
    <header class="transparent-bg text-black-300 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-2">Layanan Treatment Kami</h1>
            <p class="text-lg">Jelajahi berbagai perawatan yang dirancang untuk meningkatkan kecantikan dan kesehatan kulit Anda.</p>
        </div>
    </header>

    <!-- Treatment Section -->
    <div>
        <section class="py-12 px-6 transparent-bg">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Pilihan Treatment</h2>

                <!-- Grid for Treatments -->        
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $query = "SELECT * FROM treatments";
                    $result = $conn->query($query);
                    while ($treatment = $result->fetch_assoc()): ?>
                        <!-- Treatment Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <div class="relative">
                                <img src="../uploads/<?= htmlspecialchars($treatment['image']) ?>"
                                    alt="<?= htmlspecialchars($treatment['name']) ?>"
                                    class="w-full h-48 object-cover">
                                <span class="absolute top-4 left-4 bg-blue-500 text-white py-1 px-3 rounded-full text-sm">
                                    Rp <?= number_format($treatment['price'], 0, ',', '.') ?>
                                </span>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($treatment['name']) ?></h3>
                                <p class="text-gray-600 text-sm mt-3"><?= htmlspecialchars($treatment['description']) ?></p>
                                <button class="mt-4 w-full bg-gradient-to-r from-blue-400 to-blue-600 text-white py-2 px-4 rounded-lg hover:shadow-lg transition">
                                    Hubungi Sekarang
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