<?php 

class transaksi_func
{
    private static $conn = null;

    public function __construct()
    {
        self::$conn = connection::getConnection();
    }

    public function getPesanan($status)
    {
        return connection::getQuery("CALL GET_PESANAN_BY_STATUS('{$status}')");
    }

    public function bayar($idPesanan)
    {
        if ($query = self::$conn->query("CALL BAYAR_PESANAN('{$idPesanan}')")) {
            if ($updateStatus = self::$conn->query("UPDATE pesanan SET status_pembayaran='Sudah Dibayar' WHERE id_pesanan='{$idPesanan}'"))
                return self::$conn->affected_rows;
        }
        return false;
    }

    public function getTotalTransaksi()
    {
        if ($query = self::$conn->query("CALL GET_TOTAL_TRANSAKSI()")) {
            $data  = $query->fetch_assoc();
            return $data['total_transaksi'];
        }
        return false;
    }
}

?>