<?php 
    $pel = new pelanggan_func();

    if (isset($_POST['submit'])) {
        if ($pel->add($_POST)) {
            echo "<script>
                alert('Data pelanggan berhasil ditambah');
                document.location.href='".BASE_URL."view/home.php?menu=pelanggan&page=view';
                </script>";
        } 
        // header('location:'.BASE_URL.'view/home.php?menu=pelanggan&page=view');
    }
?>

<div class="row">
    <div class="col-md-10 offset-md-1 py-4">
        <h2 class="text-center"> Tambah Data Pelanggan</h2>
        <form action="" method="POST">
            <div class="row mt-5">
                <div class="form-group col-md-6">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" name="nama" placeholder="Masukkan nama" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenkel" id="" class="custom-select">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Nomor HP</label>
                    <input type="text" name="nohp" placeholder="Masukkan NO HP" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="10" rows="3" class="form-control">
                    </textarea>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-info col-12">Tambah Data</button>
        </form>
    </div>
</div>