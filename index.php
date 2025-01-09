<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azra Beauty Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />  
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+AU+SA:wght@100..400&display=swap" rel="stylesheet">


</head>

<body>

<!--Font Judul-->
<style>
  .font-playwrite {
    font-family: "Playwrite AU SA", serif;
  }
</style>
<!--Font Judul-->

    <nav class="bg-pink-400 text-white">
        <div class="mx-auto px-8 py-5 flex justify-between items-center">

            <a href="#" class="text-xl md:text-2xl font-bold font-playwrite">Azra Beauty Clinic</a>

            <div class="flex items-center space-x-4 md:space-x-6">
                <a href="login.php"
                    class="inline-block bg-pink-500 text-white px-4 md:px-6 py-1 md:py-2 rounded-full font-semibold text-sm md:text-base shadow-lg transition duration-300 ease-in-out transform hover:bg-pink-600 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-pink-300">
                    LOGIN
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-pink-100 py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-pink-600 mb-4">Perawatan Diri Terbaik untuk Anda</h2>
            <p class="text-gray-700 mb-6">Dapatkan kulit yang sehat, cerah, dan bercahaya dengan treatment terbaik kami.
            </p>
        </div>
    </section>


    <!-- About Section -->
    <section id="tentang" class="bg-gray-100 py-20">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold text-gray-800 mb-6">Tentang Kami</h3>
            <p class="text-gray-700 max-w-2xl mx-auto">Kami adalah klinik kecantikan terpercaya yang telah melayani
                pelanggan selama lebih dari 10 tahun. Dengan tenaga ahli dan teknologi terbaru, kami berkomitmen untuk
                memberikan perawatan terbaik untuk kulit Anda.</p>
        </div>
    </section>

    <!-- Cabang Toko -->
    <section class="py-10 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Cabang Klinik Kami</h2>
            <p class="text-gray-600 mb-10">Kami hadir di berbagai lokasi untuk melayani Anda dengan pelayanan terbaik.
            </p>
        </div>

        <!-- Grid untuk cabang -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
            <!-- Card Cabang -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="https://via.placeholder.com/400x250" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Cabang Jakarta</h3>
                    <p class="text-gray-600 text-sm mt-2">Alamat: Jl. Sudirman No. 45, Jakarta Pusat. Melayani sejak
                        2010.</p>
                </div>
            </div>

            <!-- Card Cabang -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="https://via.placeholder.com/400x250" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Cabang Bandung</h3>
                    <p class="text-gray-600 text-sm mt-2">Alamat: Jl. Dago No. 78, Bandung. Dikenal dengan layanan
                        unggulan.</p>
                </div>
            </div>

            <!-- Card Cabang -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="https://via.placeholder.com/400x250" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Cabang Surabaya</h3>
                    <p class="text-gray-600 text-sm mt-2">Alamat: Jl. Tunjungan No. 32, Surabaya. Pelayanan 24/7.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold text-gray-800 mb-10">Apa Kata Pelanggan Kami</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="text-gray-600 italic">"Layanan di klinik ini luar biasa! Kulit saya jadi lebih sehat."</p>
                    <h4 class="mt-4 text-pink-500 font-bold">- Sarah</h4>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="text-gray-600 italic">"Tenaga ahli yang profesional dan ramah. Sangat direkomendasikan!"
                    </p>
                    <h4 class="mt-4 text-pink-500 font-bold">- Amanda</h4>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="text-gray-600 italic">"Hasil yang memuaskan. Saya pasti akan kembali lagi."</p>
                    <h4 class="mt-4 text-pink-500 font-bold">- Diana</h4>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container mx-auto text-center">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="text-gray-600 italic">"Layanan di klinik ini luar biasa! Kulit saya jadi lebih sehat."</p>
                    <h4 class="mt-4 text-pink-500 font-bold">- Sarah</h4>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="text-gray-600 italic">"Tenaga ahli yang profesional dan ramah. Sangat direkomendasikan!"
                    </p>
                    <h4 class="mt-4 text-pink-500 font-bold">- Amanda</h4>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="text-gray-600 italic">"Hasil yang memuaskan. Saya pasti akan kembali lagi."</p>
                    <h4 class="mt-4 text-pink-500 font-bold">- Diana</h4>
                </div>
            </div>
        </div>
        </div>

    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold text-gray-800 mb-6">Kontak Kami</h3>
        <p class="text-gray-700 mb-6">Hubungi kami untuk konsultasi atau informasi lebih lanjut.</p>
        <i class="fa-brands fa-instagram fa-2x"></i>
        <i class="ml-4 fa-brands fa-whatsapp fa-2x"></i>
        <a href="mailto:info@klinik.com" class="mt-4 block text-pink-500 font-bold text-lg">info@klinik.com</a>
    </div>
</section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2024 Azra Beauty Clinic. Copyright.</p>
        </div>
    </footer>
</body>

</html>