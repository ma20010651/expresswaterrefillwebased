<?php
session_start();
class Online
{
   private  $host = "localhost";
    private $username = "u139123658_waterstation";
    private $password = "Qoobeeagapi04";
    private $db = "u139123658_waterstation";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
            
            echo "Connection error " . $th->getMessage();
        }
    }

   public function fetch()
{
    $data = [];

    if (isset($_SESSION['useradmin_id'])) {
        
        $useradmin_id = $this->conn->real_escape_string($_SESSION['useradmin_id']);

        
        $query = "SELECT u.useradmin_id, u.fullname, u.contact, u.barangay, b.houseno, b.purok, b.street, t.ref_number, t.payment_type, t.products_sold, t.amount, t.status, t.category, t.date
            FROM transaction t
            INNER JOIN billing_address b ON b.id = t.billing_address
            INNER JOIN users u ON u.user_id = b.user_id
            WHERE u.useradmin_id = '$useradmin_id' AND t.status = 'Delivered'
            ORDER BY t.date DESC";

        
        $result = $this->conn->query($query);

        
        if ($result) {
            
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            
            echo "Error: " . $this->conn->error;
        }
    }

    return $data;
}

public function date_range($start_date, $end_date)
{
    $data = [];
    $useradmin_id = $_SESSION['useradmin_id'];

    $query = "SELECT u.useradmin_id, u.fullname, u.contact, b.houseno, b.street, b.barangay, b.city, b.province, b.country, t.ref_number, t.payment_type, t.products_sold, t.amount, t.status, t.category, t.date
    FROM transaction t
    INNER JOIN billing_address b ON b.id = t.billing_address
    INNER JOIN users u ON u.user_id = b.user_id
    WHERE u.useradmin_id = '$useradmin_id' AND t.status = 'Delivered'";

    if (isset($start_date) && isset($end_date)) {
        $query .= " AND DATE(t.date) BETWEEN '$start_date' AND '$end_date'";
    } elseif (isset($start_date)) {
        $query .= " AND DATE(t.date) >= '$start_date'";
    } elseif (isset($end_date)) {
        $query .= " AND DATE(t.date) <= '$end_date'";
    }

    $query .= " ORDER BY t.date DESC";

    if ($sql = $this->conn->query($query)) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}
}