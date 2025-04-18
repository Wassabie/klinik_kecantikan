<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$database_path = '../assets/db/database.php';
if (!file_exists($database_path)) {
    die("File database.php tidak ditemukan di: $database_path. Periksa path atau keberadaan file.");
}
include($database_path);

// Periksa apakah koneksi berhasil
if (!isset($conn)) {
    die("Koneksi database gagal. Silakan periksa konfigurasi database di assets/db/database.php.");
}

// Ambil semua treatments yang tersedia
$query = "SELECT * FROM treatments";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Gagal mengambil data treatments: " . mysqli_error($conn));
}

// Inisialisasi pesan
$error_message = '';
$success_message = '';

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $treatments_id = (int)$_POST['treatments_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validasi input
    if (empty($name) || empty($email) || empty($treatments_id) || empty($date) || empty($time)) {
        $error_message = "❌ Semua field harus diisi.";
    } else {
        // Validasi tanggal tidak boleh di masa lalu
        $today = date("Y-m-d");
        if ($date < $today) {
            $error_message = "❌ Tidak bisa booking untuk tanggal yang sudah lewat.";
        } else {
            // Periksa apakah treatments sudah terbooking pada waktu yang sama
            $stmt = $conn->prepare("SELECT * FROM booking_treatments WHERE date = ? AND time = ? AND treatments_id = ? AND status != 'cancelled'");
            $stmt->bind_param("ssi", $date, $time, $treatments_id);
            $stmt->execute();
            $checkResult = $stmt->get_result();

            if ($checkResult->num_rows > 0) {
                $error_message = "❌ Waktu ini sudah terbooking. Silakan pilih waktu lain.";
            } else {
                // Simpan data booking
                $stmt = $conn->prepare("INSERT INTO booking_treatments (name, email, treatments_id, date, time, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                if ($stmt) {
                    $stmt->bind_param("ssiss", $name, $email, $treatments_id, $date, $time);
                    $success = $stmt->execute();

                    if ($success) {
                        $booking_id = $stmt->insert_id;

                        // Ambil nama treatment untuk email
                        $treatmentsNameQuery = $conn->prepare("SELECT name FROM treatments WHERE id = ?");
                        $treatmentsNameQuery->bind_param("i", $treatments_id);
                        $treatmentsNameQuery->execute();
                        $resulttreatments = $treatmentsNameQuery->get_result();
                        $treatmentsName = $resulttreatments->fetch_assoc()['name'];

                        // Kirim email pemberitahuan
                        $msg_user = "Halo $name,\n\nPemesanan treatment '$treatmentsName' pada tanggal $date jam $time berhasil dibuat. Status saat ini: Pending.";
                        $msg_admin = "Ada booking baru:\nNama: $name\ntreatment: $treatmentsName\nTanggal: $date\nJam: $time";

                        // Catatan: pastikan fungsi mail() aktif di server
                        mail($email, "Pemesanan Treatment Anda", $msg_user);
                        mail("admin@klinik.com", "Booking Baru", $msg_admin);

                        // Redirect ke halaman bukti booking
                        header("Location: bukti_booking.php?id=$booking_id");
                        exit;
                    } else {
                        $error_message = "❌ Terjadi kesalahan saat menyimpan data booking: " . $stmt->error;
                    }
                } else {
                    $error_message = "❌ Gagal mempersiapkan statement: " . $conn->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking Treatments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[url('../Uploads/rumah_sakit.jpg')] bg-cover bg-center min-h-screen flex items-center justify-center">
    <div class="bg-black bg-opacity-50 min-h-screen w-full flex items-center justify-center py-8">
        <div class="bg-white p-8 rounded-xl shadow-md max-w-md w-full transform transition duration-300 hover:shadow-xl">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8 bg-gradient-to-r from-blue-400 to-blue-600 text-transparent bg-clip-text">
                Booking Treatment Anda
            </h2>

            <!-- Pesan Error/Sukses -->
            <?php if (isset($error_message)): ?>
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 flex items-center rounded-md">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php elseif (isset($success_message)): ?>
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 flex items-center rounded-md">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <!-- Form Booking -->
            <form method="POST" class="space-y-6">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 text-gray-800 placeholder-gray-400 transition duration-200"
                        placeholder="Masukkan nama Anda">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 text-gray-800 placeholder-gray-400 transition duration-200"
                        placeholder="Masukkan email Anda">
                </div>

                <!-- Pilih Treatments -->
                <div>
                    <label for="treatments_id" class="block text-sm font-medium text-gray-700">Pilih Treatment</label>
                    <div class="relative">
                        <select name="treatments_id" id="treatments_id" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 text-gray-800 appearance-none transition duration-200">
                            <option value="" disabled selected>-- Pilih Treatment --</option>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Tanggal -->
                <div>
                    <figure>
                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="date" id="date" min="<?= date('Y-m-d') ?>" required
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 text-gray-800 transition duration-200">
                </div>

                <!-- Waktu -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700">Waktu</label>
                    <input type="time" name="time" id="time" required
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 text-gray-800 transition duration-200">
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-400 to-blue-600 text-white py-3 px-4 rounded-xl shadow-md hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform transform hover:scale-105 duration-300">
                        Pesan Treatment Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>