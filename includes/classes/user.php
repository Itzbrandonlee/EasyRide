<?php
// user.php
class User{
    protected $db;
    protected $customer_fname;
    protected $customer_lname;
    protected $customer_address;
    protected $customer_phone;
    protected $customer_email;
    protected $customer_pass;
    protected $hash_pass;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SING UP USER
    function signUpUser($fname, $lname, $address, $phonenum, $email, $password){
        try{
            $this->customer_fname = trim($fname);
            $this->customer_lname = trim($lname);
            $this->customer_address = trim($address);
            $this->customer_phone = trim($phonenum);
            $this->customer_email = trim($email);
            $this->customer_pass = trim($password);
            if(!empty($this->customer_fname) && !empty($this->customer_lname) && !empty($this->customer_address) && !empty($this->customer_phone) && !empty($this->customer_email) && !empty($this->customer_pass)){

                if (filter_var($this->customer_email, FILTER_VALIDATE_EMAIL)) { 
                    $check_email = $this->db->prepare("SELECT * FROM `customers` WHERE customer_email = ?");
                    $check_email->execute([$this->customer_email]);

                    if($check_email->rowCount() > 0){
                        return ['errorMessage' => 'This Email Address is already registered. Please Try another.'];
                    }
                    else{
                        $this->hash_pass = password_hash($this->customer_pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `customers` (customer_fname, customer_lname, customer_address, customer_phonenum, customer_email, customer_password) VALUES(:customer_fname, :customer_lname, :customer_address, :customer_phone, :customer_email, :customer_pass)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':customer_fname',htmlspecialchars($this->customer_fname), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':customer_lname',htmlspecialchars($this->customer_lname), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':customer_address',htmlspecialchars($this->customer_address), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':customer_phone',htmlspecialchars($this->customer_phone), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':customer_email',$this->customer_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':customer_pass',$this->hash_pass, PDO::PARAM_STR);
                        $sign_up_stmt->execute();
                        return ['successMessage' => 'You have signed up successfully.'];                   
                    }
                }
                else{
                    return ['errorMessage' => 'Invalid email address!'];
                }    
            }
            else{
                return ['errorMessage' => 'Please fill in all the required fields.'];
            } 
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // LOGIN USER
    function loginUser($email, $password){
        
        try{
            $this->customer_email = trim($email);
            $this->customer_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `customers` WHERE customer_email = ?");
            $find_email->execute([$this->customer_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->customer_pass, $row['customer_password']);
                if($match_pass){
                    $_SESSION = [
                        'customer_id' => $row['customer_id'],
                        'email' => $row['customer_email']
                    ];
                    header('Location: profile.php');
                }
                else{
                    return ['errorMessage' => 'Invalid password'];
                }
                
            }
            else{
                return ['errorMessage' => 'Invalid email address!'];
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // FIND USER BY ID
    function find_user_by_id($id){
        try{
            $find_user = $this->db->prepare("SELECT * FROM `customers` WHERE customer_id = ?");
            $find_user->execute([$id]);
            if($find_user->rowCount() === 1){
                return $find_user->fetch(PDO::FETCH_OBJ);
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
    function all_users($id){
        try{
            $get_users = $this->db->prepare("SELECT customer_id, customer_fname, customer_lname, customer_address, customer_phonenum 
                                            FROM `customers`
                                            WHERE customer_id != ?");
            $get_users->execute([$id]);
            if($get_users->rowCount() > 0){
                return $get_users->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function all_user_bookings($id){
        try{
            $get_bookings = $this->db->prepare("SELECT confirmation_num, status, manufacturer, c_name, model_year, seat_capacity, pickup_date, drop_date, b1.branch_name as b1_branch_name, b2.branch_name as b2_branch_name, customer_id
                                                FROM `booking` as bo
                                                LEFT JOIN `vehicle_details` as vd ON 
                                                vd.registration_num=bo.vehicle_registration
                                                LEFT JOIN `vehicle` as v ON v.car_id=vd.car_id
                                                LEFT JOIN `branch` as b1 ON b1.branch_id=bo.pickup_branch_id
                                                LEFT JOIN `branch` as b2 ON b2.branch_id=bo.drop_branch_id
                                                HAVING customer_id = ?");
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