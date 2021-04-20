<?php 
    $pesanan   = new pesanan_func();
    $menu      = new menu_func();
    $pelanggan = new pelanggan_func();


    if (isset($_POST['submit'])) {
        if ($pesanan->add($_POST)) {
            echo "<script>
                alert('Data pesanan berhasil ditambah');
                document.location.href='".BASE_URL."view/home.php?menu=pesanan&page=view';
                </script>";
        } else {
            echo "<script>
                alert('Data pesanan gagal ditambah');
                document.location.href='".BASE_URL."view/home.php?menu=pesanan&page=add';
                </script>";
        }
    }
    
    $dataPel  = $pelanggan->get();
    $dataMenu = $menu->get();
    
?>

<div class="row">
    <div class="col-md-10 offset-md-1 py-4">
        <h2 class="text-center"> Tambah Data Pesanan</h2>
        <form action="" method="POST">
            <div class="row mt-5">
                <div class="form-group col-md-6">
                    <label for="">Menu</label>
                    <select name="id_menu" id="" class="custom-select">
                        <?php foreach ($dataMenu as $key => $row) : ?>
                        <option value="<?= $row['id_menu']; ?>"><?= $row['nama_menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Pelanggan</label>
                    <select name="id_pelanggan" id="" class="custom-select">
                    <?php foreach ($dataPel as $key => $row) : ?>
                        <option value="<?= $row['id_pelanggan']; ?>"><?= $row['nama_pelanggan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" placeholder="Masukkan Jumlah Pesanan" required class="form-control">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-info col-12">Tambah Pesanan</button>
        </form>
    </div>
</div>