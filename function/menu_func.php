<?php 

class menu_func
{

    public function get()
    {
        $db = new connection();
        $data = [];
        $query = $db::getConnection()->query("CALL GET_MENU()");
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}

