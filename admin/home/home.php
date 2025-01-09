
<!-- Konten Manajemen Halaman Depan -->
<div class="flex justify-between items-center mb-6">
    <a href="home/add_content.php" class="px-4 py-2 bg-pink-500 text-white rounded-md hover:bg-pink-600">
        Tambah Konten
    </a>
</div>

<!-- Tabel Konten Halaman Depan -->
<div class="overflow-x-auto shadow-lg rounded-lg border border-pink-300 bg-white">
    <table class="table-auto w-full text-left border-collapse">
        <thead class="bg-pink-500 text-white">
            <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Gambar</th>
                <th class="py-3 px-4">Judul</th>
                <th class="py-3 px-4">Deskripsi</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <?php
            $result = $conn->query("SELECT * FROM home_content");
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='border-t'>
                    <td class='py-3 px-4'>{$no}</td>
                    <td class='py-3 px-4'>
                        <img src='../uploads/{$row['image']}' alt='{$row['title']}' class='w-16 h-16 object-cover rounded'>
                    </td>
                    <td class='py-3 px-4'>{$row['title']}</td>
                    <td class='py-3 px-4'>" . substr($row['description'], 0, 50) . "...</td>
                    <td class='py-3 px-4'>
                        <a href='home/edit_content.php?id={$row['id']}' class='inline-block px-4 py-2 text-sm text-white bg-pink-500 rounded hover:bg-pink-600'>Edit</a>
                        <a href='#' 
                            class='home-delete-btn inline-block px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 ml-2' 
                            id={$row['id']}>Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.home-delete-btn');

        deleteButtons.forEach(button => {   
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const homeId = button.getAttribute('id');
                const confirmDelete = confirm('Apakah Anda yakin ingin menghapus content ini?');

                if (confirmDelete) {
                    // Redirect ke halaman delete_home.php
                    window.location.href = `home/delete_home.php?id=${homeId}`;
                }
            });
        });
    });
</script>