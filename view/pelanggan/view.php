<?php 
    $pel = new pelanggan_func();
    $msg = $_SESSION['error_message'];

    if (isset($_POST['delete'])) {
        if ($pel->delete($_POST['id']) > 0) {
            echo "<script>
                alert('Data pelanggan berhasil dihapus');
                document.location.href='".BASE_URL."view/home.php?menu=pelanggan&page=view';
                </script>";
        } else {
            echo "<script>
                alert('Data pelanggan gagal dihapus!.".$msg."');
                document.location.href='".BASE_URL."view/home.php?menu=pelanggan&page=view';
                </script>";
        }
    }
    // get data must be under delete function to prevent pass by reference
    $dataPel = $pel->get();
?>

<div class="row">
    <div class="col-md-12 py-4">
        <h2 class="text-center">Data Pelanggan</h2>  
        <a href="<?= BASE_URL.'view/home.php?menu=pelanggan&page=add'; ?>" class="btn btn-info mb-2">Tambah</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>            
            </thead>
            <tbody>
                <?php foreach($dataPel as $key => $row) :  ?>
                <tr>
                    <td><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['jenis_kelamin']; ?></td>
                    <td><?= $row['nohp']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td>
                        <a href="<?= BASE_URL.'view/home.php?menu=pelanggan&page=edit&id='.$row['id_pelanggan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $row['id_pelanggan']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ini?');"> Delete</button>
                        </form>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>