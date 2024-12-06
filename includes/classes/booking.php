<?php
// booking.php
class Booking{
    protected $db;
    protected $confirmation_num;
    protected $status;
    protected $vehicle_registration;
    protected $pickup_date;   
    protected $pickup_employee_email;
    protected $customer_id;
    protected $drop_date;
    protected $drop_employee_email;
    protected $pickup_branch_id;
    protected $drop_branch_id;
    protected $amount;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SING UP USER
    function bookingSubmission($reg_num, $p_date, $c_id, $d_date, $p_branch_id, $d_branch_id, $amt){
        try{
            $this->vehicle_registration = trim($reg_num);
            $this->pickup_date = trim($p_date);
            $this->customer_id = trim($c_id);
            $this->drop_date = trim($d_date);
            $this->pickup_branch_id = trim($p_branch_id);
            $this->drop_branch_id = trim($d_branch_id);
            $this->amount = trim($amt);
            if(!empty($this->vehicle_registration) && !empty($this->pickup_date) && !empty($this->customer_id) && !empty($this->drop_date) && !empty($this->pickup_branch_id) && !empty($this->drop_branch_id) && !empty($this->amount)){
                        $sql = "INSERT INTO `booking` (vehicle_registration, pickup_date, customer_id, drop_date, pickup_branch_id, drop_branch_id, amount) VALUES(:vehicle_registration, :pickup_date, :customer_id, :drop_date, :pickup_branch_id, :drop_branch_id, :amount)";
            
                        $booking_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $booking_stmt->bindValue(':vehicle_registration',htmlspecialchars($this->vehicle_registration), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':pickup_date',htmlspecialchars($this->pickup_date), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':customer_id',htmlspecialchars($this->customer_id), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':drop_date',htmlspecialchars($this->pickup_date), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':pickup_branch_id',$this->pickup_branch_id, PDO::PARAM_STR);
                        $booking_stmt->bindValue(':drop_branch_id',$this->drop_branch_id, PDO::PARAM_STR);
                        $booking_stmt->bindValue(':amount',$this->amount, PDO::PARAM_STR);
                        $booking_stmt->execute();
                        return ['successMessage' => 'Booking request submitted.'];                   
            }
            else{
                return ['errorMessage' => 'Please fill in all the required fields.'];
            } 
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // FIND BOOKING BY ID
    function find_booking_by_id($id){
        try{
            $find_booking = $this->db->prepare("SELECT * FROM `booking` WHERE confirmation_num = ?");
            $find_booking->execute([$id]);
            if($find_booking->rowCount() === 1){
                return $find_booking->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    function all_bookings($id){
        try{
            $get_bookings = $this->db->prepare("SELECT * FROM `bookings`");
            $get_bookings->execute([$id]);
            if($get_bookings->rowCount() > 0){
                return $get_bookings->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>