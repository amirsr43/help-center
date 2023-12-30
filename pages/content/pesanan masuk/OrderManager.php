<?php
class DatabaseManager {
    protected $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }
}

class OrderManager extends DatabaseManager {
    public function deleteOrder($deleteId) {
        $deleteQuery = "DELETE FROM service_requests WHERE id_pesan = $deleteId";
        mysqli_query($this->conn, $deleteQuery);
    }

    public function acceptOrder($acceptId) {
        $updateQuery = "UPDATE service_requests SET status = 'accepted' WHERE id_pesan = $acceptId";
        mysqli_query($this->conn, $updateQuery);
    }

    public function searchOrders($search) {
        $whereClause = $search ? "WHERE token LIKE '%$search%'" : '';
        $products = mysqli_query($this->conn, "SELECT * FROM service_requests $whereClause");
        return $products;
    }
}
?>
