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
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- <style>
    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style> -->

</head> 

<!--Backround-->
<div class="bg-[url('../uploads/rumah_sakit.jpg')] bg-cover bg-contain">
<!--Backround-->


<!-- Navbar -->
<?php include "../layout/navbar.php" ?>

<!-- Carousell -->
<div class="swiper mySwiper w-full max-w-5xl mx-auto mt-8">
    <div class="swiper-wrapper">
        <?php while ($promo = $activePromos->fetch_assoc()): ?>
            <div class="swiper-slide relative">
                <!-- Gambar Promo -->
                <img src="../uploads/<?= $promo['image'] ?>" alt="<?= htmlspecialchars($promo['title']) ?>" 
                     class="w-full h-[400px] object-cover rounded-xl shadow-lg">

                <!-- Overlay Konten -->
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent rounded-xl p-6 flex flex-col justify-end">
                    <h2 class="text-2xl font-bold text-white mb-2"><?= htmlspecialchars($promo['title']) ?></h2>
                    <p class="text-gray-300 text-sm mb-4"><?= htmlspecialchars($promo['description']) ?></p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-pink-400 font-semibold">
                            Diskon: <?= $promo['discount'] ?>% <?= $promo['discount'] ? "" : "Promo Spesial!" ?>
                        </span>
                        <span class="text-xs text-gray-400">Berlaku hingga: <?= date("d M Y", strtotime($promo['valid_until'])) ?></span>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Tombol Navigasi -->
    <div class="swiper-button-next !text-white !text-3xl"></div>
    <div class="swiper-button-prev !text-white !text-3xl"></div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>
<br><br>
<!-- Deskripsi Klinik -->
<!-- Deskripsi Klinik -->
<section class="py-10">
    <div class="transparent-bg px-20 py-5 rounded-lg container mx-auto text-justify">
        <h2 class="text-6xl font-bold text-pink-600 mb-8 text-center font-playwrite">Azra Beauty Clinic</h2>
        <p class="text-black-1000 font-bold text-xl mb-6">
            Kami adalah klinik kecantikan terpercaya yang berdedikasi untuk membantu Anda tampil cantik dan percaya diri. 
            Dengan pengalaman bertahun-tahun dan tenaga ahli profesional, kami menawarkan berbagai perawatan kulit, wajah, 
            dan tubuh yang dirancang khusus untuk kebutuhan Anda.
        </p>
        <div class="grid grid-cols-2 gap-4 text-lg">
            <!-- Kolom Kiri -->
            <div class="bg-white p-6 shadow-md rounded-lg">
                <p><strong>Perawatan Berkualitas Tinggi:</strong> Kami menggunakan teknologi terbaru dan produk berkualitas untuk memastikan hasil terbaik bagi Anda.</p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-lg">
                <p><strong>Tenaga Ahli Profesional:</strong> Tim kami terdiri dari dokter dan terapis yang berpengalaman di bidang estetika dan dermatologi.</p>
            </div>
            <!-- Kolom Kanan -->
            <div class="bg-white p-6 shadow-md rounded-lg">
                <p><strong>Lingkungan Nyaman:</strong> Kami menyediakan fasilitas yang nyaman dan modern untuk pengalaman perawatan yang menyenangkan.</p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-lg">
                <p><strong>Pendekatan Personal:</strong> Setiap pelanggan kami adalah istimewa. Kami menawarkan konsultasi untuk merancang perawatan yang sesuai dengan Anda.</p>
            </div>
        </div>
    </div>
</section>



<br><br>
<!-- Profile Dokter -->
<div class="flex flex-wrap justify-center gap-x-8 gap-y-8">

    <!--Dokter Azra-->
    <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
    <div class="flex flex-col items-center p-6 bg-white shadow-md rounded-lg max-w-sm mx-auto">
        <!-- Foto Dokter -->
        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500">
            <img src="../uploads/alemak.png" alt="Foto Dokter" class="w-full h-full object-cover">
        </div>

        <!-- Nama Dokter -->
        <h2 class="mt-4 text-2xl font-bold text-gray-800">dr. Azra Sihombing</h2>

        <!-- Spesialisasi Dokter -->
        <p class="text-sm text-gray-500">Spesialis Dermatologi & Estetika</p>

        <!-- Deskripsi Singkat -->
        <p class="mt-4 text-gray-600 text-center">
            Dr. Jane Doe memiliki pengalaman lebih dari 10 tahun di bidang perawatan kulit dan kecantikan.
            Beliau berkomitmen untuk memberikan pelayanan terbaik dan solusi yang disesuaikan untuk setiap pasien.
        </p>

        <!-- Tombol Sosial Media -->
        <div class="flex space-x-4 mt-6">
            <a href="#" class="hover:text-indigo-700">
                <!-- Logo Instagram -->
                <i class="fa-brands fa-instagram fa-2x"></i>
            </a>
            <a href="#" class="hover:text-green-700">
                <!-- Logo Whatsapp -->
                <i class="fa-brands fa-whatsapp fa-2x"></i>
            </a>
        </div>
    </div>
    </div>

    <!--Dokter adit-->
    <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
    <div class="flex flex-col items-center p-6 bg-white shadow-md rounded-lg max-w-sm mx-auto">
    <!-- Foto Dokter -->
    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500">
        <img src="https://via.placeholder.com/150" alt="Foto Dokter" class="w-full h-full object-cover">
    </div>

    <!-- Nama Dokter -->
    <h2 class="mt-4 text-2xl font-bold text-gray-800">dr. Adit Tampubulon</h2>

    <!-- Spesialisasi Dokter -->
    <p class="text-sm text-gray-500">Spesialis Dermatologi & Estetika</p>

    <!-- Deskripsi Singkat -->
    <p class="mt-4 text-gray-600 text-center">
        Dr. Jane Doe memiliki pengalaman lebih dari 10 tahun di bidang perawatan kulit dan kecantikan.
        Beliau berkomitmen untuk memberikan pelayanan terbaik dan solusi yang disesuaikan untuk setiap pasien.
    </p>

    <!-- Tombol Sosial Media -->
    <div class="flex space-x-4 mt-6">
        <div></div>
        <a href="#" class="hover:text-indigo-700">
            <i class="fa-brands fa-instagram fa-2x"></i>
        </a>
        <a href="#" class="hover:text-green-700">
            <i class="fa-brands fa-whatsapp fa-2x"></i>
        </a>
    </div>
</div>
</div>


<!--Dokter zidan-->
<div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
<div class="flex flex-col items-center p-6 bg-white shadow-md rounded-lg max-w-sm mx-auto">
    <!-- Foto Dokter -->
    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500">
        <img src="https://via.placeholder.com/150" alt="Foto Dokter" class="w-full h-full object-cover">
    </div>

    <!-- Nama Dokter -->
    <h2 class="mt-4 text-2xl font-bold text-gray-800">dr. Zidan Rajagukguk</h2>

    <!-- Spesialisasi Dokter -->
    <p class="text-sm text-gray-500">Spesialis Dermatologi & Estetika</p>

    <!-- Deskripsi Singkat -->
    <p class="mt-4 text-gray-600 text-center">
        Dr. Zidan Rajagukguk memiliki pengalaman lebih dari 10 tahun di bidang perawatan kulit dan kecantikan.
        Beliau berkomitmen untuk memberikan pelayanan terbaik dan solusi yang disesuaikan untuk setiap pasien.
    </p>

    <!-- Tombol Sosial Media -->
    <div class="flex space-x-4 mt-6 ">
        <a href="#" class="hover:text-indigo-700">
            <i class="fa-brands fa-instagram fa-2x"></i>
        </a>
        <a href="#" class="hover:text-green-700">
            <i class="fa-brands fa-whatsapp fa-2x"></i>
        </a>
    </div>
</div>
</div>

<!--Dokter Rama-->
<div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
<div class="flex flex-col items-center p-6 bg-white shadow-md rounded-lg max-w-sm mx-auto">
    <!-- Foto Dokter -->
    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500">
        <img src="../uploads/harimau_duduk.png" alt="Foto Dokter" class="w-full h-full object-cover">
    </div>

    <!-- Nama Dokter -->
    <h2 class="mt-4 text-2xl font-bold text-gray-800">dr. Rama Raja Iblis</h2>

    <!-- Spesialisasi Dokter -->
    <p class="text-sm text-gray-500">Spesialis Dermatologi & Estetika</p>

    <!-- Deskripsi Singkat -->
    <p class="mt-4 text-gray-600 text-center">
        Dr. Rama Raja Iblis memiliki pengalaman lebih dari 10 tahun di bidang susuk.
        Beliau berkomitmen untuk memberikan pelayanan terbaik dan solusi yang disesuaikan untuk setiap iblis bawahannya.
    </p>

    <!-- Tombol Sosial Media -->
    <div class="flex space-x-4 mt-6 ">
        <a href="#" class="hover:text-indigo-700">
            <i class="fa-brands fa-instagram fa-2x"></i>
        </a>
        <a href="#" class="hover:text-green-700">
            <i class="fa-brands fa-whatsapp fa-2x"></i>
        </a>
    </div>
</div>
</div>
</div>


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