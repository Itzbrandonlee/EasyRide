<?php
// vehicle.php
class Vehicle{
    protected $db;
    protected $registration_num;
    protected $seat_capacity;
    protected $mileage;
    protected $rate;
    protected $type_car_id;
    protected $fuel_type_id;
    protected $branch_id;
    protected $car_id;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // FIND USER BY ID
    function find_vehicle_by_id($id){
        try{
            $find_vehicle = $this->db->prepare("SELECT * FROM `vehicle_details` WHERE registration_num = ?");
            $find_vehicle->execute([$id]);
            if($find_vehicle->rowCount() === 1){
                return $find_vehicle->fetch(PDO::FETCH_OBJ);
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
    function all_vehicles(){
        try{
            $get_vehicles = $this->db->prepare("SELECT * FROM `vehicle_details`");
            $get_vehicles->execute();
            if($get_vehicles->rowCount() > 0){
                return $get_vehicles->fetchAll(PDO::FETCH_OBJ);
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