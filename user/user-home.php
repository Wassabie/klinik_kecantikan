<?php
include '../auth.php';
include '../assets/db/database.php';

$today = date("Y-m-d");
$activePromos = $conn->query("SELECT * FROM promos WHERE valid_until >= '$today'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azra Beauty Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <style>
        .text-blue-600 {
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.9), -1px -1px 2px rgba(255, 255, 255, 0.9);
        }


    </style>
</head>

<body class="bg-gray-100">
    <!-- Background -->
    <div class="bg-[url('../uploads/rumah_sakit.jpg')] bg-cover bg-center min-h-screen">

        <!-- Navbar -->
        <?php include "../layout/navbar.php" ?>

        <!-- Carousel -->
        <div class="relative mx-auto mt-10 max-w-7xl px-6">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php while ($promo = $activePromos->fetch_assoc()): ?>
                        <div class="swiper-slide relative">
                            <img src="../uploads/<?= $promo['image'] ?>" alt="<?= htmlspecialchars($promo['title']) ?>"
                                class="w-full h-[550px] object-cover rounded-xl shadow-lg">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent rounded-xl p-6 flex flex-col justify-end">
                                <h2 class="text-2xl font-bold text-white mb-2"><?= htmlspecialchars($promo['title']) ?></h2>
                                <p class="text-gray-300 text-sm mb-4"><?= htmlspecialchars($promo['description']) ?></p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-blue-400 font-semibold">Diskon: <?= $promo['discount'] ?>%</span>
                                    <span class="text-xs text-gray-400">Berlaku hingga: <?= date("d M Y", strtotime($promo['valid_until'])) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <!-- Tombol Navigasi -->
                <div class="swiper-button-next !text-white !text-3xl !right-4 !inset-y-1/2"></div>
                <div class="swiper-button-prev !text-white !text-3xl !left-4 !inset-y-1/2"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>


        <!-- Deskripsi Klinik -->
        <section class="mt-10 max-w-7xl mx-auto px-6">
            <div class="px-10 py-6 rounded-xl shadow-xl">
                <h2 class="text-6xl font-bold text-blue-600 mb-8 text-center font-playwrite relative">
                    Azra Beauty Clinic
                    <span class="absolute inset-0 text-transparent -z-10 bg-blue-300/50 rounded-lg blur-md"></span>
                </h2>
                <p class="text-gray-700 text-lg mb-4 text-justify">
                    Kami adalah klinik kecantikan terpercaya yang berdedikasi untuk membantu Anda tampil cantik dan percaya diri. 
                    Dengan pengalaman bertahun-tahun dan tenaga ahli profesional, kami menawarkan berbagai perawatan kulit, wajah, 
                    dan tubuh yang dirancang khusus untuk kebutuhan Anda.
                </p>
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <strong>Perawatan Berkualitas Tinggi:</strong> Kami menggunakan teknologi terbaru dan produk berkualitas untuk memastikan hasil terbaik bagi Anda.
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <strong>Tenaga Ahli Profesional:</strong> Tim kami terdiri dari dokter dan terapis yang berpengalaman di bidang estetika dan dermatologi.
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <strong>Lingkungan Nyaman:</strong> Kami menyediakan fasilitas yang nyaman dan modern untuk pengalaman perawatan yang menyenangkan.
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <strong>Pendekatan Personal:</strong> Setiap pelanggan kami adalah istimewa. Kami menawarkan konsultasi untuk merancang perawatan yang sesuai dengan Anda.
                    </div>
                </div>
            </div>
        </section>

        <!-- Profil Dokter -->
        <section class="mt-10 max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $doctors = [
                    [
                        'name' => 'dr. Azra Sihombing',
                        'specialty' => 'Spesialis Dermatologi & Estetika',
                        'description' => 'Memiliki pengalaman lebih dari 10 tahun di bidang perawatan kulit dan kecantikan.',
                        'image' => '../uploads/alemak.png'
                    ],
                    [
                        'name' => 'dr. Adit Tampubulon',
                        'specialty' => 'Spesialis Dermatologi & Estetika',
                        'description' => 'Ahli estetika dengan pendekatan personal yang fokus pada kebutuhan pasien.',
                        'image' => '../uploads/assalamualikum-bro.jpg'
                    ],
                    [
                        'name' => 'dr. Zidan Rajagukguk',
                        'specialty' => 'Spesialis Dermatologi & Estetika',
                        'description' => 'Berkomitmen memberikan solusi terbaik dalam estetika kulit.',
                        'image' => 'https://via.placeholder.com/150'
                    ],
                    [
                        'name' => 'dr. Rama Raja Iblis',
                        'specialty' => 'Spesialis Susuk',
                        'description' => 'Ahli dalam memberikan pelayanan terbaik untuk estetika supernatural.',
                        'image' => '../uploads/harimau_duduk.png'
                    ]
                ];
                foreach ($doctors as $doctor): ?>
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500">
                            <img src="<?= $doctor['image'] ?>" alt="<?= htmlspecialchars($doctor['name']) ?>" class="w-full h-full object-cover">
                        </div>
                        <h2 class="mt-4 text-xl font-bold text-gray-800"><?= htmlspecialchars($doctor['name']) ?></h2>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($doctor['specialty']) ?></p>
                        <p class="mt-4 text-gray-600 text-center"><?= htmlspecialchars($doctor['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Footer -->
        <?php include "../layout/footer.php" ?>

        <!-- Script Swiper -->
        <script>
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        </script>
    </div>
</body>
</html>
