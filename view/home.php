<?php 
    $menu = $_GET['menu'] ?? '';
    $page = $_GET['page'] ?? '';
    
    include_once '../helper/url.php';
    include_once '../layout/header.php';
    include_once '../layout/navbar.php';
    include_once '../function/pelanggan_func.php';

    
?>

<div class="container">
    <?php 
        if (file_exists($menu.'/'.$page.'.php')) {
            include_once "$menu/$page.php";
        } else {
            echo 'halaman tidak ditemukan.';
        }
    ?>
</div>
