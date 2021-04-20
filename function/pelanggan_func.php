<?php 

class pelanggan_func
{
    private static $conn = null; 
    public function __construct()
	{
		// self::$conn = new mysqli('localhost', 'root', '', 'usk_kasir');	
		self::$conn = connection::getConnection();	
	}

    public function get()
    {
        return connection::getQuery("CALL GET_PELANGGAN()");  
    }

    public function add($data = [])
    {
        $query =  self::$conn->prepare("CALL ADD_PELANGGAN(?,?,?,?)");
        $query->bind_param('ssss',
            $data['nama'],
            $data['jenkel'],
            $data['nohp'],
            $data['alamat'] 
        );

        if ($query->execute()) {
            return $query->affected_rows;
        }
        return false;
    }

    public function edit($id) 
    {
        $db = new connection();
        if ($query = self::$conn->prepare("CALL SHOW_PELANGGAN(?)")) {
            $query->bind_param('i', $id);
            // var_dump($query->execute());die();
            if ($query->execute()) {
                $res = $query->get_result();
                return $res->fetch_assoc();
                
            }
        }
        return false;
    }

    public function update($data, $id)
    {
        $db = new connection();
        if ($query = self::$conn->prepare("CALL UPDATE_PELANGGAN(?,?,?,?,?)")) {
            $query->bind_param('ssssi', 
                $data['nama'],
                $data['jenkel'],
                $data['nohp'],
                $data['alamat'],
                $id
            );
            if ($query->execute()) {
                return true;
            }
        }
        return false;
    }

    public function delete($id)
    {   
        $db = new connection();
        
        if ($query = self::$conn->prepare("CALL DELETE_PELANGGAN(?)")) {
            $query->bind_param('i', $id);
            if ($query->execute()) 
                return $query->affected_rows;
            
            // var_dump(self::$conn->errno);die();
            if (self::$conn->errno === 1451) 
                $_SESSION['error_message'] = "Data pelanggan tidak bisa dihapus. Karena memiliki data pesanan";
        }
        
        return false;
    }
}

?>

