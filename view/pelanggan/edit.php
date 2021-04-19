<?php 
    $pel = new pelanggan_func();
    $id = $_GET['id'] ?? '';

    if (isset($_POST['submit'])) {
        if ($pel->update($_POST, $id)) {
            echo "<script>
                alert('Data pelanggan berhasil diubah');
                </script>";
        } else {
            echo "<script>
                alert('Data pelanggan gagal diubah :(');
                </script>";
        }
        header('location:'.BASE_URL.'view/home.php?menu=pelanggan&page=edit&id='.$id);
    }
    
    $dataPel = $pel->edit($id);
?>

<div class="row">
    <div class="col-md-10 offset-md-1 py-4">
        <h2 class="text-center"> Edit Data Pelanggan</h2>
        <form action="" method="POST">
            <div class="row mt-5">
                <div class="form-group col-md-6">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" name="nama" placeholder="Masukkan nama" class="form-control" value="<?= $dataPel['nama_pelanggan']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenkel" id="" class="custom-select">
                        <option value="L" <?php if ($dataPel['jenis_kelamin'] === 'L') echo 'selected'; ?>>Laki-laki</option>
                        <option value="P" <?php if ($dataPel['jenis_kelamin'] === 'P') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Nomor HP</label>
                    <input type="text" name="nohp" placeholder="Masukkan NO HP" class="form-control" value="<?= $dataPel['nohp']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Alamat" class="form-control" value="<?= $dataPel['alamat']; ?>">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-info col-12">Edit Data</button>
        </form>
    </div>
</div>