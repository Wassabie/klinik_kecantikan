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
            <section class="py-12 px-6 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Daftar Produk</h2>
                    
                    <!-- Grid for Products -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php
                        $query = "SELECT 
                                    products.id, 
                                    products.name, 
                                    products.price, 
                                    products.stock, 
                                    products.image, 
                                    promos.discount, 
                                    promos.valid_until
                                FROM 
                                    products
                                LEFT JOIN 
                                    promos 
                                ON 
                                    products.category = promos.category COLLATE utf8mb4_general_ci 
                                WHERE 
                                    promos.valid_until >= CURDATE() 
                                    OR promos.category IS NULL";
            
                        $result = $conn->query($query);

                        while ($product = $result->fetch_assoc()): 
                            // Harga diskon jika promo berlaku
                            $isPromoValid = !empty($product['discount']) && strtotime($product['valid_until']) >= time();
                            $discountedPrice = $isPromoValid 
                                ? $product['price'] * (1 - ($product['discount'] / 100)) 
                                : $product['price'];
                        ?>
                            <!-- Product Card -->
                            <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                                <div class="relative">
                                    <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" 
                                        alt="<?= htmlspecialchars($product['name']) ?>" 
                                        class="w-full h-48 object-cover">
                                    <?php if ($isPromoValid): ?>
                                        <span class="absolute top-4 left-4 bg-pink-500 text-white py-1 px-3 rounded-full text-sm">
                                            Diskon <?= $product['discount'] ?>%
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($product['name']) ?></h3>
                                    <p class="text-gray-600 text-sm mt-2">Stok: <?= htmlspecialchars($product['stock']) ?></p>
                                    <?php if ($isPromoValid): ?>
                                        <p class="text-gray-400 line-through text-sm">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                                    <?php endif; ?>
                                    <p class="text-pink-500 text-lg font-bold">Rp <?= number_format($discountedPrice, 0, ',', '.') ?></p>
                                    <button class="mt-4 w-full btn-pink text-white py-2 px-4 rounded-lg hover:shadow-lg transition">
                                        Beli Sekarang
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