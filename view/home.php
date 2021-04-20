<?php 
    session_start();
    $menu = $_GET['menu'] ?? '';
    $page = $_GET['page'] ?? '';
    
    include_once '../function/connection.php';
    include_once '../helper/url.php';
    include_once '../layout/header.php';
    include_once '../layout/navbar.php';
    include_once '../function/menu_func.php';
    include_once '../function/pelanggan_func.php';

    include_once '../function/pesanan_func.php';
    
    if (file_exists("../function/{$menu}_func.php")) {
        include_once "../function/{$menu}_func.php";
    }

    
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
