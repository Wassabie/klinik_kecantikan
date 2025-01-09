<?php
include '../auth.php';
include '../assets/db/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>

<!-- BG -->
<div class="bg-[url('../uploads/rumah_sakit.jpg')] bg-cover bg-contain">

<!-- NAVBAR -->
<?php include "../layout/navbar.php" ?>


<!-- Header Section -->
<header class="text-black-300 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-2">Produk Skincare Terbaik</h1>
        <p class="text-lg">Temukan produk yang dirancang untuk kecantikan dan kesehatan kulit Anda.</p>
    </div>
</header>

<!-- Produk Section -->
<div>
<section class="py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Our Products</h2>

        <!-- Grid for Products -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $query = "SELECT * FROM products WHERE stock > 0";
            $result = $conn->query($query);
            while ($product = $result->fetch_assoc()): ?>
                <!-- Product Card -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="relative">
                        <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" 
                                alt="<?= htmlspecialchars($product['name']) ?>" 
                                class="w-full h-48 object-cover">
                        <span class="absolute top-4 left-4 bg-pink-500 text-white py-1 px-3 rounded-full text-sm">
                            Rp <?= number_format($product['price'], 0, ',', '.') ?>
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="text-gray-600 text-sm mt-3">Stock: <?= $product['stock'] ?></p>
                        <button class="mt-6 w-full bg-pink-500 text-white py-2 px-4 rounded-lg hover:shadow-lg transition">
                            Add to Cart
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