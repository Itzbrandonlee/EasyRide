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
            $find_vehicle = $this->db->prepare("SELECT c_name, car_type_name, model_year, manufacturer, seat_capacity, mileage, rate, fuel_type_name, description, color, registration_num, branch_name, vehicle_branch_id
                                                FROM `vehicle_details` as vd
                                                LEFT JOIN `vehicle` as v ON v.car_id=vd.car_id 
                                                LEFT JOIN `car_type` as ct ON ct.type_car_id=vd.type_car_id
                                                LEFT JOIN `fuel_type` as ft ON ft.fuel_type_id=vd.fuel_type_id
                                                LEFT JOIN `branch` as b ON b.branch_id=vd.vehicle_branch_id
                                                HAVING registration_num = ?");
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
            $get_vehicles = $this->db->prepare("SELECT c_name, car_type_name, model_year, manufacturer, seat_capacity, mileage, rate, fuel_type_name, description, color, registration_num, branch_name
                                                FROM `vehicle_details` as vd
                                                LEFT JOIN `vehicle` as v ON v.car_id=vd.car_id 
                                                LEFT JOIN `car_type` as ct ON ct.type_car_id=vd.type_car_id
                                                LEFT JOIN `fuel_type` as ft ON ft.fuel_type_id=vd.fuel_type_id
                                                LEFT JOIN `branch` as b ON b.branch_id=vd.vehicle_branch_id");
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