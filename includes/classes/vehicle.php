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
            $find_vehicle = $this->db->prepare("SELECT c_name, car_type_name, model_year, manufacturer, seat_capacity, mileage, rate, fuel_type_name, description, color, registration_num, branch_name
                                                FROM `vehicle_details` as vd
                                                LEFT JOIN `vehicle` as v ON v.car_id=vd.car_id 
                                                LEFT JOIN `car_type` as ct ON ct.type_car_id=vd.type_car_id
                                                LEFT JOIN `fuel_type` as ft ON ft.fuel_type_id=vd.fuel_type_id
                                                LEFT JOIN `branch` as b ON b.branch_id=vd.branch_id
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
                                                LEFT JOIN `branch` as b ON b.branch_id=vd.branch_id");
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

    function search_vehicle($branch, $start_date, $end_date){
        try {
            if(!empty($branch) && !empty($start_date) && !empty($end_date)){
                $search_vehicles = $this->db->prepare("SELECT ")
            } else if(!empty($branch)){
                $search_vehicles = $this->db->prepare("SELECT 
    v.car_id, 
    v.c_name, 
    v.description, 
    v.model_year, 
    v.manufacturer, 
    v.color, 
    vd.registration_num, 
    vd.seat_capacity, 
    vd.mileage, 
    vd.rate, 
    ft.fuel_type_name, 
    ct.car_type_name, 
    br.location
FROM 
    vehicle AS v
JOIN 
    vehicle_details AS vd ON v.car_id = vd.car_id
JOIN 
    fuel_type AS ft ON vd.fuel_type_id = ft.fuel_type_id
JOIN 
    car_type AS ct ON vd.type_car_id = ct.type_car_id
JOIN 
    branch AS br ON br.branch_id = vd.branch_id
LEFT JOIN 
    booking AS b ON vd.registration_num = b.vehicle_registration
    AND NOT (
        b.drop_date <  OR b.pickup_date > '2024-11-10'
    )
WHERE 
    br.branch_id = 1
    AND b.vehicle_registration IS NULL;);
                $search_vehicles->execute();
                if($search_vehicles->rowCount() > 0){
                    return $search_vehicles->fetchAll(PDO::FETCH_OBJ);
                }
                else{
                    return false;
                }
        } catch {
            error_log($e->getMessage());
            return null;
        }
    }
}
?>