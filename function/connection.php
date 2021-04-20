<?php 
class connection 
{
    public static $conn = null;

    public static function getConnection()
    {
        if (self::$conn == null) {
            $mysqli = new mysqli('localhost', 'root', '', 'usk_kasir');	
            if ($mysqli->connect_error){
                echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")";die();
            }  
            return $mysqli;
        }
		return self::$conn;
    }

    public static function getQuery($query)
    {
        $data = [];
        $query = self::getConnection()->query($query);
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}