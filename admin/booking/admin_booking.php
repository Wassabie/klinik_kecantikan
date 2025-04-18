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

// Ambil semua booking
$query = "SELECT bt.*, t.name AS treatments_name FROM booking_treatments bt LEFT JOIN treatments t ON bt.treatments_id = t.id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Gagal mengambil data booking: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = (int)$_POST['booking_id'];
    $status = $_POST['status'];

    // Validasi status
    $valid_statuses = ['pending', 'confirmed', 'cancelled'];
    if (!in_array($status, $valid_statuses)) {
        echo "<div style='color:red;'>❌ Status tidak valid.</div>";
    } else {
        // Update status booking
        $stmt = $conn->prepare("UPDATE booking_treatments SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $booking_id);
        if ($stmt->execute()) {
            // Ambil data untuk email
            $emailQuery = $conn->prepare("SELECT email, name, treatments_id FROM booking_treatments WHERE id = ?");
            $emailQuery->bind_param("i", $booking_id);
            $emailQuery->execute();
            $emailResult = $emailQuery->get_result();
            $emailData = $emailResult->fetch_assoc();

            // Ambil nama treatment
            $treatmentNameQuery = $conn->prepare("SELECT name FROM treatments WHERE id = ?");
            $treatmentNameQuery->bind_param("i", $emailData['treatments_id']);
            $treatmentNameQuery->execute();
            $treatmentResult = $treatmentNameQuery->get_result();
            $treatmentName = $treatmentResult->fetch_assoc()['name'];

            // Kirim email pemberitahuan
            $msg = "Halo {$emailData['name']},\n\nPemesanan treatment '$treatmentName' Anda telah diubah menjadi: $status.";
            mail($emailData['email'], "Status Pemesanan Treatment", $msg);

            echo "<div style='color:green;'>✅ Status booking telah diperbarui.</div>";
        } else {
            echo "<div style='color:red;'>❌ Terjadi kesalahan saat mengubah status booking: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<div class="overflow-x-auto shadow-lg rounded-lg border border-blue-500 bg-white">
    <table class="table-auto w-full text-left border-collapse">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="py-3 px-4">ID</th>
                <th class="py-3 px-4">Nama</th>
                <th class="py-3 px-4">Treatment</th>
                <th class="py-3 px-4">Tanggal</th>
                <th class="py-3 px-4">Waktu</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="border-t hover:bg-gray-50 transition duration-200">
                    <td class="py-3 px-4"><?php echo $row['id']; ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td class="py-3 px-4"><?php echo htmlspecialchars($row['treatments_name']); ?></td>
                    <td class="py-3 px-4"><?php echo $row['date']; ?></td>
                    <td class="py-3 px-4"><?php echo $row['time']; ?></td>
                    <td class="py-3 px-4">
                        <span class="inline-block px-2 py-1 text-sm font-medium rounded <?php echo $row['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($row['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <form method="POST" class="flex items-center space-x-2">
                            <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                            <select name="status" class="block w-32 px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="confirmed" <?php echo ($row['status'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="cancelled" <?php echo ($row['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                            <button type="submit" class="px-4 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>