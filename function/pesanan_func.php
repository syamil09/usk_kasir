<?php 


class pesanan_func
{
    private static $conn = null; 
    public function __construct()
	{
		// self::$conn = new mysqli('localhost', 'root', '', 'usk_kasir');	
        self::$conn = connection::getConnection();
	}

    public function get()
    {
        return connection::getQuery("CALL GET_PESANAN()");
    }

    public function add($data)
    {
        $idPesanan = 'P'.date('dmyHis');
        $idUser = 2;

        if ($query = self::$conn->prepare("CALL ADD_PESANAN(?,?,?,?,?)")) {
            $query->bind_param('siiii',
                $idPesanan,
                $data['id_menu'],
                $data['id_pelanggan'],
                $data['jumlah'],
                $idUser
            );
            if ($query->execute()) {
                return $query->affected_rows;
            }
            var_dump($query);die();
        }
        return false;
    }

    public function edit($id)
    {
        if ($query = self::$conn->prepare("CALL SHOW_PESANAN(?)")) {
            $query->bind_param('s', $id);
            if ($query->execute()) {
                $res = $query->get_result();
                return $res->fetch_assoc();
            }
        }
        return false;
    }

    public function update($data, $id)
    {
        $idUser = 2;
        if ($query = self::$conn->prepare("CALL UPDATE_PESANAN(?,?,?,?,?)")) {
            $query->bind_param('iiiis',
                $data['id_menu'],
                $data['id_pelanggan'],
                $data['jumlah'],
                $idUser,
                $id
            );        
            if ($query->execute()) {
                return $query->affected_rows;
            }       
        }
        return false;
    }

    public function delete($id)
    {
        $query = self::$conn->query("CALL DELETE_PESANAN('{$id}')");
        $deleted = self::$conn->affected_rows;
        if ($deleted > 0) {
            return $deleted;
        }
        return false;

    }
}

?>