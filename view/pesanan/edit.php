<?php 
    $pesanan   = new pesanan_func();
    $menu      = new menu_func();
    $pelanggan = new pelanggan_func();

    $id = $_GET['id'] ?? ''; 

    if (isset($_POST['submit'])) {
        if ($pesanan->update($_POST, $_POST['id_pesanan'])) {
            echo "<script>
                alert('Data pesanan berhasil diubah');
                document.location.href='".BASE_URL."view/home.php?menu=pesanan&page=view';
                </script>";
        } else {
            echo "<script>
                alert('Data pesanan gagal diubah');
                document.location.href='".BASE_URL."view/home.php?menu=pesanan&page=edit&id={$id}';
                </script>";
        }
    }
    $dataPes  = $pesanan->edit($id);
    $dataPel  = $pelanggan->get();
    $dataMenu = $menu->get();
?>

<div class="row">
    <div class="col-md-10 offset-md-1 py-4">
        <h2 class="text-center"> Edit Data Pesanan</h2>
        <form action="" method="POST">
            <div class="row mt-5">
                <div class="form-group col-md-6">
                    <label for="">ID Pesanan</label>
                    <input type="text" readonly name="id_pesanan" value="<?= $dataPes['id_pesanan']; ?>" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Menu</label>
                    <select name="id_menu" id="" class="custom-select">
                        <?php foreach ($dataMenu as $key => $row) : ?>
                        <option value="<?= $row['id_menu']; ?>" 
                            <?= $dataPes['id_menu'] == $row['id_menu'] ? 'selected' : ''; ?>>
                            <?= $row['nama_menu']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Pelanggan</label>
                    <select name="id_pelanggan" id="" class="custom-select">
                        <?php foreach ($dataPel as $key => $row) : ?>
                        <option value="<?= $row['id_pelanggan']; ?>" 
                        <?= $dataPes['id_pelanggan'] == $row['id_pelanggan'] ? 'selected' : ''; ?>>
                        <?= $row['nama_pelanggan']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" 
                            placeholder="Masukkan Jumlah Pesanan" 
                            value="<?= $dataPes['jumlah']; ?>" 
                            class="form-control"
                            required>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-info col-12">Ubah Pesanan</button>
        </form>
    </div>
</div>