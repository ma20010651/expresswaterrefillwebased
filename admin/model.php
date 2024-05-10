<?php
session_start();
class Order
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
            //throw $th;
            echo "Connection error " . $th->getMessage();
        }
    }

    public function fetch()
    {
        $data = [];
        $useradmin_id = $_SESSION['useradmin_id'];

        $query = "SELECT * FROM `order` WHERE useradmin_id = '$useradmin_id'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

   public function date_range($start_date, $end_date)
{
    $data = [];
    $useradmin_id = $_SESSION['useradmin_id'];

    if ((!empty($start_date) && empty($end_date)) || (empty($start_date) && !empty($end_date))) {

        $query = "SELECT * FROM `order` WHERE `useradmin_id` = '$useradmin_id'"; 
    } elseif (!empty($start_date) && !empty($end_date)) {
       
        $query = "SELECT * FROM `order` WHERE `useradmin_id` = '$useradmin_id' AND `date` BETWEEN '$start_date' AND '$end_date'";
    } else {
       
        $query = "SELECT * FROM `order` WHERE `useradmin_id` = '$useradmin_id'";
    }
    
    if ($result = $this->conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}
}