<?php 
include 'connection.php';

class pelanggan_func extends connection
{
    public function get()
    {
        $data  = [];
        $query = self::$conn->query("CALL GET_PELANGGAN()");
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function add($data = [])
    {
        $query = self::$conn->prepare("CALL ADD_PELANGGAN(?,?,?,?)");
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
        if ($query = self::$conn->prepare("CALL SHOW_PELANGGAN(?)")) {
            $query->bind_param('i', $id);
            if ($query->execute()) {
                $res = $query->get_result();
                return $res->fetch_assoc();
                
            }
        }
        return false;
    }

    public function update($data, $id)
    {
        if ($query = self::$conn->prepare("CALL UPDATE_PELANGGAN(?,?,?,?,?)")) {
            $query->bind_param('ssssi', 
                $data['nama'],
                $data['jenkel'],
                $data['nohp'],
                $data['alamat'],
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
        if ($query = self::$conn->prepare("CALL DELETE_PELANGGAN(?)")) {
            $query->bind_param('i', $id);

            if ($query->execute()) {
                return $query->affected_rows;
            }
        }
        return false;
    }
}

?>

