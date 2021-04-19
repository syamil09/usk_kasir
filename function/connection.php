<?php 

class connection 
{
    public static $conn = null;
    public function __construct() 
    {
        if (self::$conn == null) {
            self::$conn = new mysqli('localhost', 'root', '', 'usk_kasir');
        }   
    }
}

// $p = new connection();
// // var_dump(connection::$conn);
// var_dump($p::$conn);