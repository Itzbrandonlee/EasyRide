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

    // SUBMIT BOOKING
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
    function all_bookings(){
        try{
            $get_bookings = $this->db->prepare("SELECT confirmation_num, status, manufacturer, c_name, model_year, seat_capacity, pickup_date, drop_date, b1.branch_name as b1_branch_name, b2.branch_name as b2_branch_name, customer_id
                                                FROM `booking` as bo
                                                LEFT JOIN `vehicle_details` as vd ON 
                                                vd.registration_num=bo.vehicle_registration
                                                LEFT JOIN `vehicle` as v ON v.car_id=vd.car_id
                                                LEFT JOIN `branch` as b1 ON b1.branch_id=bo.pickup_branch_id
                                                LEFT JOIN `branch` as b2 ON b2.branch_id=bo.drop_branch_id");
            $get_bookings->execute();
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

        // SUBMIT BOOKING
    function bookingUpdate($conf_num, $p_date, $d_date, $d_branch_id, $b_status){
        try{
            $this->confirmation_num = trim($conf_num);
            $this->pickup_date = trim($p_date);
            $this->drop_date = trim($d_date);
            $this->drop_branch_id = trim($d_branch_id);
            $this->status = trim($b_status);

            if(!empty($this->confirmation_num) && !empty($this->pickup_date) && !empty($this->drop_date) && !empty($this->status)){
                        $sql = "UPDATE `booking` 
                                SET
                                    drop_branch_id = :drop_branch_id,
                                    pickup_date = :pickup_date,
                                    drop_date = :drop_date,
                                    status = :status
                                WHERE confirmation_num = :confirmation_num";
            
                        $booking_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $booking_stmt->bindValue(':confirmation_num',htmlspecialchars($this->confirmation_num), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':pickup_date',htmlspecialchars($this->pickup_date), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':drop_date',htmlspecialchars($this->drop_date), PDO::PARAM_STR);
                        $booking_stmt->bindValue(':drop_branch_id',$this->drop_branch_id, PDO::PARAM_STR);
                        $booking_stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
                        $booking_stmt->execute();
                        return ['successMessage' => 'Booking update submitted.'];                   
            }
            else{
                return ['errorMessage' => 'Please fill in all the required fields.'];
            } 
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function get_all_statuses(){
        try{
            $get_statuses = $this->db->prepare("SELECT * FROM `status_type`;");
            $get_statuses->execute();
            if($get_statuses->rowCount() > 0){
                return $get_statuses->fetchAll(PDO::FETCH_OBJ);
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