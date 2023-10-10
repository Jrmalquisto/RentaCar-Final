<?php

// include ('../header.php');
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

   

$com_id = $_SESSION["user_id"];

//   function dd($data) {
// 	echo "<pre>";
// 	print_r(var_dump($data));
// 	die;
// }

$result = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$com_id'");
if ($res = mysqli_fetch_array($result)) {
	
	$username = $res['user_name']  ?? '';
    $email = $res['email'] ?? '';
}

// $users = mysqli_query($con, "SELECT user.user_id FROM user 
//  								INNER JOIN messages ON user.user_id = messages.to_id
//  								WHERE to_id='$com_id' 
								 
// 								ORDER BY to_id DESC");

//Get data from recepients 
// $seller_mess = mysqli_query($con, "SELECT  * FROM messages 
//                                 INNER JOIN seller ON seller.email = messages.from_email
//                                 WHERE from_email='$email' 

//                                 ORDER BY to_email DESC");

// if ($res1 = mysqli_fetch_array($seller_mess)) {
	
// 	$username = $res1['user_name']  ?? '';
//     $shop_email = $res1['email'] ?? '';
// }
// $get = mysql_fetch_array($users);

// while ($res1 = mysqli_fetch_array($users)) {
// 	$shop_id[] = $res1['from_id'] ?? '';
// }

$users = mysqli_query($con, "SELECT  * FROM messages 
                                WHERE messages.to_email='$email' OR messages.email='$email'

                                ORDER BY messages.message_id DESC");
                                
//THIS IF STATEMENT LAST UNTIL END OF CODELINE


if ($users->num_rows != 0){
    while ($res1 = mysqli_fetch_array($users)) {
        $shop_id[] = $res1['message_id'] ?? $array;
        $shop_arr[] = $res1['to_email'] ?? $array;
    }
    


    $i = 0;
    
    $a = array_unique($shop_id)??$array;
    $a1 = array_unique($shop_arr)??$array;
   
    
    $shop_all = $shop_arr;
    
    
    
    while ($i < count($a)) {
        $b[$i] = array_values($a)[$i];
        $i++;
    }
    while ($i < count($a1)) {
        $all[$i] = array_values($a1)[$i];
        $i++;
    }
    // while ($i < count($b)){
    //     $all_user = mysqli_query($con, "SELECT  * FROM messages 
    //                 WHERE (messages.to_email='$b[$i]' OR messages.email='$all[$i]') OR (messages.email='$b[$i]' OR messages.to_email='$all[$i]')

    //                 ORDER BY messages.message_id DESC");
    //             while ($in = mysqli_fetch_array($all_user)) {
    //                 $lahat[] = $in['email'] ?? $array;
                   
    //             }
    //     $i++; 
    // }
    // foreach($b as $row){
    //     $get_email = mysqli_query($con, "SELECT * FROM messages WHERE message_id='$b[$i]' ");
    //     $all_user = mysqli_query($con, "SELECT  * FROM messages 
    //              WHERE (messages.to_email='$b[$i]' OR messages.email='$all[$i]') OR (messages.email='$b[$i]' OR messages.to_email='$all[$i]'");
    //     $i++;
    // }

    // $last = array_unique($lahat)??$array;
    // echo print_r($b);

    
    if (($key = array_search($email, $b)) !== false) {
        unset($b[$key]);
    }

    $m=0;

    if (count($b)==0){
        echo '<div class="no_message container-fluid side-nav">
                <ul class = "d-flex flex-column"style="list-style: none;">
                    <li class="text-s font-weight-bold mb-1 rounded">
                        <small class="preview text-muted text-truncate">No Messages</small>
                    </li>
                </ul>
            </div>';
        $c = array(0);
    } else {
        while ($m < count($b)) {
            $c[$m] = array_values($b)[$m];
            $m++;
        }
    }
    

  ?>

<?php


        include ('connection.php');

        $id=$_SESSION["user_id"];

        $findresult = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$id'");
        if($res = mysqli_fetch_array($findresult)) {
            
        $id = $res['user_id'];
        $fullname = $res['fullname'];
        $username =$res['user_name'];
        $oldusername =$res['user_name'];
        // $email = $res['email'];   
        $phonenumber = $res['contact_num'];  
        $image= $res['pic_ID'];
        }

?>



            <!-------sidebar--design- close----------->

            <!-- 
                <div class="d-flex flex-column align-items-center text-center p-3 py-1">
                    <?php if($image==NULL){
							echo '<img src="assets/user_profile/profile.png" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
						} else { 
							echo '<img src="images/'.$image.'" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
						}
						?>
                    <div class="row mt-1"></div>
                    <div class="row mt-2"></div>
                    <span class="font-weight-bold"><?php echo $fullname;?></span><span
                        class=><?php echo $email;?></span><span> </span>
                </div> -->
                <!-- <div class="side-nav navbar"> -->

                
                <div class="container-fluid side-nav ">
                    <ul class = "d-flex flex-column"style="list-style: none;">
                       
                        <input hidden id="cust_email" type="text" name="cust_email" value="<?= $email ?>">
                        
                <?php 
                
                $n = 0;
                

                while ($n < count($a)) {
                    
                    $seller = mysqli_query($con, "SELECT * FROM seller INNER JOIN messages 
                                                ON seller.email=messages.email OR seller.email=messages.to_email
                                                WHERE message_id = '$a[$n]'");
                                                
                    while ($emails = mysqli_fetch_array($seller)) {
                        $get_mail[] = $emails['email'] ?? $array;
                        $shop_arr1[] = $emails['to_email'] ?? $array;
                    }
                    $n++;
                }                         
                $all_mail = array_unique($shop_arr1)??$array;
                // echo print_r($a);
                $u=0;
                while ($u < count($all_mail)) {
                    $unique[$u] = array_values($all_mail)[$u];
                    $u++;
                }
                // echo print_r($unique);

                $t=0;
                    while ($t < count($unique)){

                    // if ($resu = mysqli_fetch_array($seller)) {
                    //     $s_email = $res['email'] ?? '';
                    // }
                    // echo print_r($rows1);
                    $seller = mysqli_query($con, "SELECT * FROM seller WHERE email = '$unique[$t]'");

                    foreach ($seller as $rows1){
                        $s_email = mysqli_real_escape_string($con, $rows1['email']);
                        $mess = mysqli_query($con, "SELECT * FROM messages WHERE (email = '$s_email' AND to_email = '$email') OR (to_email = '$s_email' AND email = '$email') ORDER BY message_id DESC"); 
                        $messages = mysqli_fetch_array($mess);

                        $message = mysqli_real_escape_string($con, $messages['message']);
                        $time = mysqli_real_escape_string($con, $messages['message_added']);
                        $dateTime = new DateTime($time);

                        // Format the date as you desire
                        $formattedDate = $dateTime->format('h:i a');
                        

                    // foreach ($messages as $message) {
                        
                ?>
                    
                                        <li class="text-s font-weight-bold mb-1 rounded">
                                            <a href="../messages.php?seller_id=<?=$rows1['seller_id']?>&email=<?=$rows1['email']?>"
                                            style="color:white;" class = ""> 
                                                <div class="container" style = "max-width:300px; padding: 5px; margin-bottom:1rem;">
                                                    <div class = "d-flex">
                                                        <div class = "flex-shrink-0">
                                                            <?php if($rows1["shop_logo"]==NULL){
                                                                echo '<img src="assets/user_profile/profile.png" style="height:45px; width: 45px; display:inline;" class="rounded-circle">';
                                                            } else { 
                                                                echo '<img src="images/shop/'.$rows1["shop_logo"].'" style="height:45px; width: 45px; display:inline;" class="rounded-circle">';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class = "flex-grow-1 ms-3">
                                                            <div class="container meta">
                                                                <p class="name text-truncate" style="margin-bottom:0;"><?php echo $rows1['shopname']?></p>
                                                                <small class="preview text-muted text-truncate"><?php echo $message?></small>
                                                            </div>
                                                        </div>
                                                        <div class = "flex-sm-{grow|shrink}-1 align-self-end">
                                                            <small class="preview text-muted "><?php echo $formattedDate?></small>

                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                <?php 
                        }
                    $t++;
                } 
                    

                ?>
                    </ul>
                </div>

                <?php 
            } else {
                    echo '<div class="no_message container-fluid side-nav">
                        <ul class = "d-flex flex-column"style="list-style: none;">
                            <li class="text-s font-weight-bold mb-1 rounded">
                                <small class="preview text-muted text-truncate">No Messages</small>
                            </li>
                        </ul>
                    </div>';
            }
                ?>
                    
                

            