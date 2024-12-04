<?php
// branch.php
class Branch{
    protected $db;
    protected $branch_id;
    protected $location;
    protected $name;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // FIND BRANCH BY ID
    function find_branch_by_id($id){
        try{
            $find_branch = $this->db->prepare("SELECT * FROM `branch` WHERE branch_id = ?");
            $find_branch->execute([$id]);
            if($find_branch->rowCount() === 1){
                return $find_branch->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // FETCH ALL BRANCHES
    function get_all_branches(){
        try{
            $get_branches = $this->db->prepare("SELECT * FROM `branch`;");
            $get_branches->execute();
            if($get_branches->rowCount() > 0){
                return $get_branches->fetchAll(PDO::FETCH_OBJ);
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