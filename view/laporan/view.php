<?php 
    $transaksi = new transaksi_func();
    

    if (isset($_POST['bayar'])) {
        if ($transaksi->bayar($_POST['id']) > 0) {
            echo "<script>
                alert('Data pesanan berhasil dibayar');
                document.location.href='".BASE_URL."view/home.php?menu=transaksi&page=view';
                </script>";
        } else {
            echo "<script>
                alert('Data pesanan gagal dibayar');
                document.location.href='".BASE_URL."view/home.php?menu=transaksi&page=view';
                </script>";
        }
    }
    // get data must be under delete function to prevent pass by reference
    $dataPes = $transaksi->getPesanan('Sudah Dibayar');

    function formatRupiah($number) 
    {
        return 'Rp. '.number_format($number, 0, '', '.'); 
    }
    
?>

<div class="row">
    <div class="col-md-12 py-4">
        <h2 class="text-center mb-4">Laporan Transaksi</h2> 
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
                    <th>Total</th>
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
                    <td><?= formatRupiah($row['jumlah'] * $row['harga']);  ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="bg-light">
                    <td colspan="6"></td>
                    <td>Total</td>
                    <td ><?= formatRupiah($transaksi->getTotalTransaksi()); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
