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
            $get_vehicles = $this->db->prepare("SELECT c_name, car_type_name, model_year, manufacturer, seat_capacity, mileage, rate, fuel_type_name, description, color, registration_num, branch_name, location
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

    function search_vehicle($branch, $start_date, $end_date){
        try {
                $search_vehicles = $this->db->prepare("SELECT v.car_id, v.c_name, v.description, v.model_year, v.manufacturer, v.color, 
                                                    vd.registration_num, vd.seat_capacity, vd.mileage, vd.rate, ft.fuel_type_name, ct.car_type_name, br.location
                                                    FROM vehicle AS v
                                                    JOIN vehicle_details AS vd ON v.car_id = vd.car_id
                                                    JOIN fuel_type AS ft ON vd.fuel_type_id = ft.fuel_type_id
                                                    JOIN car_type AS ct ON vd.type_car_id = ct.type_car_id
                                                    JOIN branch AS br ON br.branch_id = vd.vehicle_branch_id
                                                    LEFT JOIN booking AS b ON vd.registration_num = b.vehicle_registration
                                                    AND NOT (b.drop_date < ? OR b.pickup_date > ?)
                                                    WHERE br.branch_id = ? AND b.vehicle_registration IS NULL OR b.status = 'canceled';");

                $search_vehicles->execute([$start_date, $end_date, $branch]);
                if($search_vehicles->rowCount() > 0){
                    return $search_vehicles->fetchAll(PDO::FETCH_OBJ);
                }
                else{
                    return false;
                }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

// DELETE VEHICLE
function deleteVehicle($reg_num){
    $this->registration_num = trim($reg_num);
    try{
                    $sql = "DELETE FROM vehicle_details
                            WHERE registration_num = :registration_num";
        
                    $delete_stmt = $this->db->prepare($sql);
                    $delete_stmt->bindValue(':registration_num',htmlspecialchars($this->registration_num), PDO::PARAM_STR);
                    $delete_stmt->execute();
                    return ['successMessage' => 'Delete request submitted.'];                    
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
}

    function popular_rentals() {
        try {
            $freq_rentals = $this->db->prepare("SELECT * from popular_cars");
            $freq_rentals->execute();
            if($freq_rentals->rowCount() > 0){
                return $freq_rentals->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>