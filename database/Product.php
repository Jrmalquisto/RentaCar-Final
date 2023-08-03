<?php


class Product
{
    public $db = null;

    public function __construct(DBController $db){
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

  //fetch product data using getData Method
    public function getData($table = 'cart'){
            $userid = $_SESSION["user_id"];
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id={$userid}");
            // WHERE user_id={$userid}
            $resultArray = array();

            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        
    }
    public function getProdData(){
        // $userid = $_SESSION["user_id"];
        // $result = $this->db->con->query("SELECT * FROM {$table} WHERE status = '0' ");
        // // WHERE user_id={$userid}
        // $resultArray = array();

        // //fetch product data one by one
        // while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //     $resultArray[] = $item;
        // }

        // return $resultArray;

        $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

        return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

    }

public function getProds($table = 'product'){
    $userid = $_SESSION["user_id"];
    $result = $this->db->con->query("SELECT * FROM {$table} WHERE status = 0");
    // WHERE user_id={$userid}
    $resultArray = array();

    //fetch product data one by one
    while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $resultArray[] = $item;
    }

    return $resultArray;

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

}
public function getProdSeller($table = 'product'){
    $userid = $_SESSION["user_id"];
    $result = $this->db->con->query("SELECT * FROM {$table} WHERE status = '0' ");
    // WHERE user_id={$userid} 
    $resultArray = array();

    //fetch product data one by one
    while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $resultArray[] = $item;
    }

    return $resultArray;

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

}
public function getProdCount($id_seller = null){
    if (isset($id_seller)){
        $userid = $_SESSION["user_id"];
        $result = $this->db->con->query("SELECT * FROM product WHERE seller_id = {$id_seller} AND status = '0' ");
        // WHERE user_id={$userid} 
        $resultArray = array();

        //fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

}


public function getSeller($id_seller = null){

    if (isset($id_seller)){
    
        $result = $this->db->con->query("SELECT * FROM seller WHERE seller_id = {$id_seller}");
        // WHERE user_id={$userid}
        $resultArray = array();

        //fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
}
public function getSellerAllCount($table = 'seller'){

   
    
        $result = $this->db->con->query("SELECT COUNT(*) FROM {$table}");
        // WHERE user_id={$userid}
        

        //fetch product data one by one
        $item = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return $item;
    

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
   
}
public function getSellerCount($table = 'seller'){

    
    
        $result = $this->db->con->query("SELECT * FROM {$table}");
        // WHERE user_id={$userid}
        $resultArray = array();

        //fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
}

public function getSellerItem($table = null){

    
    
    $result = $this->db->con->query("SELECT * FROM seller WHERE item_id = ");
    // WHERE user_id={$userid}
    $resultArray = array();

    //fetch product data one by one
    while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $resultArray[] = $item;
    }

    return $resultArray;


// $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

// return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

}


    // public function getData($table = 'product'){
    //     $userid = $_SESSION["user_id"];
        
    //         $result = $this->db->con->query("SELECT * FROM {$table}");

    //         $resultArray = array();

    //         //fetch product data one by one
    //         while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    //             $resultArray[] = $item;
    //         }

    //         return $resultArray;
        
    // }
    //get product using item id
    public function getProduct($item_id = null, $table = 'cart'){

        if (isset($item_id)){
            $userid = $_SESSION["user_id"];
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id} AND user_id={$userid}");

            $resultArray = array();

            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }
    public function getOnProduct($item_id = null){

        if (isset($item_id)){
            $userid = $_SESSION["user_id"];
            $result = $this->db->con->query("SELECT * FROM product WHERE item_id={$item_id}");

            $resultArray = array();

            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }
   


    public function getReservation($item_id = null, $table = 'reservation'){

    
    
        if (isset($item_id)){
            $userid = $_SESSION["user_id"];
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id} AND user_id={$userid}");

            $resultArray = array();

            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    }

    public function getDriver($driver = null, $table = 'drivers'){

    
    
        if (isset($driver)){
            $userid = $_SESSION["user_id"];
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE driver_id={$driver}");

            $resultArray = array();

            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }

    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    }

    public function getReserveCount(){
        
            $userid = $_SESSION["user_id"];
            $result = $this->db->con->query("SELECT * FROM reservation WHERE user_id = {$userid}  AND status= 'Pending' OR status= 'Reserved'");
            // WHERE user_id={$userid} 
            $resultArray = array();
    
            //fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
    
            return $resultArray;
        
        // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");
    
        // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
        
    }

    public function getInUseCount(){
        
        $userid = $_SESSION["user_id"];
        $result = $this->db->con->query("SELECT * FROM reservation WHERE user_id = {$userid}  AND status= 'In Use'");
        // WHERE user_id={$userid} 
        $resultArray = array();

        //fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    
    // $result = mysqli_query($this->db->con,"SELECT * FROM product WHERE status = '0' ");

    // return $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

    
}
}
?>