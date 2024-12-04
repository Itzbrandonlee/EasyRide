<?php
// employee.php
class Employee{
    protected $db;
    protected $employee_id;
    protected $employee_fname;
    protected $employee_lname;
    protected $employee_address;
    protected $employee_phonenum;
    protected $employee_email;
    protected $employee_password;
    protected $hash_pass;
    protected $branch_id;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SIGN UP EMPLOYEE
    function signUpEmployee($fname, $lname, $address, $phonenum, $email, $password, $branch){
        try{
            $this->employee_fname = trim($fname);
            $this->employee_lname = trim($lname);
            $this->employee_address = trim($address);
            $this->employee_phonenum = trim($phonenum);
            $this->employee_email = trim($email);
            $this->employee_password = trim($password);
            $this->branch_id = trim($branch);

            if(!empty($this->employee_fname) && !empty($this->employee_lname) && !empty($this->employee_address) && !empty($this->employee_phonenum) && !empty($this->employee_email) && !empty($this->employee_password) && !empty($this->branch_id)){

                if (filter_var($this->employee_email, FILTER_VALIDATE_EMAIL)) { 
                    $check_email = $this->db->prepare("SELECT * FROM `employee` WHERE employee_email = ?");
                    $check_email->execute([$this->employee_email]);

                    if($check_email->rowCount() > 0){
                        return ['errorMessage' => 'This Email Address is already registered. Please Try another.'];
                    }
                    else{
                        $this->hash_pass = password_hash($this->employee_password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `employee` (employee_fname, employee_lname, employee_address, employee_phonenum, employee_email, employee_password, branch_id) VALUES(:employee_fname, :employee_lname, :employee_address, :employee_phonenum, :employee_email, :employee_password, :branch_id)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':employee_fname',htmlspecialchars($this->employee_fname), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':employee_lname',htmlspecialchars($this->employee_lname), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':employee_address',htmlspecialchars($this->employee_address), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':employee_phonenum',htmlspecialchars($this->employee_phonenum), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':employee_email',$this->employee_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':employee_password',$this->hash_pass, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':branch_id', $this->branch_id, PDO::PARAM_STR);
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
            error_log($e->getMessage());
            return ['errorMessage' => 'An error occurred. Please try again later.'];
        }
    }

    // LOGIN EMPLOYEE
    function loginEmployee($email, $password){
        
        try{
            $this->employee_email = trim($email);
            $this->employee_password = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `employee` WHERE employee_email = ?");
            $find_email->execute([$this->employee_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->employee_password, $row['employee_password']);
                if($match_pass){
                    $_SESSION = [
                        'employee_id' => $row['employee_id'],
                        'email' => $row['employee_email']
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

    // FIND EMPLOYEE BY ID
    function find_employee_by_id($id){
        try{
            $find_employee = $this->db->prepare("SELECT * FROM `employee` WHERE employee_id = ?");
            $find_employee->execute([$id]);
            if($find_employee->rowCount() === 1){
                return $find_employee->fetch(PDO::FETCH_OBJ);
            }
            else{
                return null;
            }
        }
        catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
    
    // FETCH ALL EMPLOYEES
    function all_employees(){
        try{
            $get_employees = $this->db->prepare("SELECT employee_id, employee_fname, employee_lname, employee_address, employee_phonenum, branch_id FROM `employee`;");
            $get_employees->execute();
            return $get_employees->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            error_log($e->getMessage()); 
            return [];
        }
    }
}
?>