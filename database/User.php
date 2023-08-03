<?php
//Fetch User Data
class User
{

public $db = null;

public function __construct(DBcontroller $db)
{
    if(!isset($db->con)) return null;
    $this->db = $db;
}

    public function UsergetData($table = 'user'){
       $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        //fetch user data one by one
        while($item = mysqli_fetch_array($result,MYSQL_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

     //get user using user id
     public function getUser($user_id = null, $table = 'user'){
        if (isset($user_id)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id={$user_id}");

            $resultArray = array();

            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

}
?>