<?php
class DatabaseManager
{
    protected $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getAllOrders()
    {
        $query = "SELECT * FROM service_requests"; // Replace 'your_orders_table' with your actual table name
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return $result; // Return the result set
        } else {
            return []; // Return an empty array if no orders are found
        }
    }

    public function updateOrderStatus($orderId, $newStatus)
    {
        $query = "UPDATE service_requests SET status = ? WHERE id_pesan = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $newStatus, $orderId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true; // Return true for success
        } else {
            return false; // Return false for failure
        }
    }

    public function getAcceptedOrders()
    {
        $query = "SELECT * FROM service_requests WHERE status = 'ACCEPTED'";
        $result = mysqli_query($this->conn, $query);

        if ($result !== false) {
            if (mysqli_num_rows($result) > 0) {
                return $result; // Return the result set if there are accepted orders
            } else {
                return []; // Return an empty array if no accepted orders are found
            }
        } else {
            // Handle the case where the query encountered an error
            // For example, log the error or return a specific message
            return null;
        }
    }
}

class OrderManager extends DatabaseManager
{
    public function editOrder($orderId, $newDetail, $newPrice)
    {
        $updateQuery = "UPDATE service_requests SET detail = ?, price = ? WHERE id_pesan = ?";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bind_param("sdi", $newDetail, $newPrice, $orderId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true; // Return true for successful update
        } else {
            return false; // Return false for update failure
        }
    }
    public function getOrderById($orderId)
    {
        $query = "SELECT * FROM service_requests WHERE id_pesan = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Return the fetched order details
        } else {
            return null; // Return null if no order found for the provided ID
        }
    }

    public function deleteOrder($deleteId)
    {
        $deleteQuery = "DELETE FROM service_requests WHERE id_pesan = ?";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
    }

    public function acceptOrder($acceptId)
    {
        $updateQuery = "UPDATE service_requests SET status = 'accepted' WHERE id_pesan = ?";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bind_param("i", $acceptId);
        $stmt->execute();
    }
    
}
