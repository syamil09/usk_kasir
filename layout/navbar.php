<nav class="navbar navbar-expand-lg navbar-light bg-primary ">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav2">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav1">
        <ul class="navbar-nav">
            <li class="navbar-item dropdown">
                <a href="<?= BASE_URL.'view/home.php?menu=pelanggan&page=view'; ?>" 
                    class="nav-link text-white <?= $menu == 'pelanggan' ? 'bg-success rounded' : ''; ?>">Pelanggan</a>
            </li>
            <li class="navbar-item dropdown">
                <a href="" class="nav-link text-white">Menu</a>
            </li>
            <li class="nav-item">
                <a href=""  class="nav-link text-white">Transaksi</a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link text-white">Pesanan</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#"  class="nav-link text-white">Laporan</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#"  class="nav-link text-white">Logout</a>
            </li>
        </ul>
    </div>
</nav>