<?php 
    $pel = new pesanan_func();
    

    if (isset($_POST['delete'])) {
        if ($pel->delete($_POST['id']) > 0) {
            echo "<script>
                alert('Data pelanggan berhasil dihapus');
                document.location.href='".BASE_URL."view/home.php?menu=pesanan&page=view'
                </script>";
        } else {
            echo "<script>
                alert('Data pelanggan gagal dihapus!');
                document.location.href='".BASE_URL."view/home.php?menu=pesanan&page=view'
                </script>";
        }
    }
    // get data must be under delete function to prevent pass by reference
    $dataPes = $pel->get();

    function formatRupiah($number) 
    {
        return 'Rp. '.number_format($number, 0, '', '.'); 
    }
?>

<div class="row">
    <div class="col-md-12 py-4">
        <h2 class="text-center">Data Pesanan</h2>  
        <a href="<?= BASE_URL.'view/home.php?menu=pesanan&page=add'; ?>" class="btn btn-info mb-2">Tambah</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID Pesanan</th>
                    <th>Waktu Pesan</th>
                    <th>Menu</th>
                    <th>Harga Menu</th>
                    <th>Jumlah</th>
                    <th>Pelanggan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>            
            </thead>
            <tbody>
                <?php foreach($dataPes as $key => $row) :  ?>
                <tr>
                    <td><?= $row['id_pesanan']; ?></td>
                    <td><?= $row['waktu_pesanan']; ?></td>
                    <td><?= $row['nama_menu']; ?></td>
                    <td><?= formatRupiah($row['harga']); ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['status_pembayaran']; ?></td>
                    <td>
                        <a href="<?= BASE_URL.'view/home.php?menu=pesanan&page=edit&id='.$row['id_pesanan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $row['id_pesanan']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ini?');"> Delete</button>
                        </form>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>