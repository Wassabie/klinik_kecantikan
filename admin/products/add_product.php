<?php
include('../../assets/db/database.php'); 
include('../../auth.php'); 

// DEBUG: Pastikan koneksi database tersedia
if (!isset($conn)) {
    die("Error: Koneksi database tidak tersedia. Periksa file database.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Proses form dimulai.<br>"; // DEBUG
    
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];


    // Validasi upload gambar
    if (!empty($_FILES['image']['name'])) {

        $image = $_FILES['image']['name'];
        $targetDir = "../../uploads/";
        $targetFile = $targetDir . basename($image);

        // Pastikan folder `uploads` sudah ada
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
            echo "Folder uploads dibuat.<br>";
        }

        // Proses upload file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {

            // Insert data ke database
            $stmt = $conn->prepare("INSERT INTO products (name, price, stock, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdis", $name, $price, $stock, $image);

            if ($stmt->execute()) {
                header("Location: ../dashboard.php?success=Produk berhasil ditambahkan");
                exit;
            } else {
                echo "Error: " . $stmt->error . "<br>"; 
            }
        } else {
            echo "Gagal mengunggah gambar.<br>"; 
        }
    } else {
        echo "Gambar produk harus diunggah.<br>"; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Tambah Produk</h2>
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold mb-2">Harga</label>
                    <input type="number" name="price" id="price" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold mb-2">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-md">
                </div>
                <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded">Tambah Produk</button>
            </form>

        </div>
    </div>
</body>
</html>
