   <?php
    //i use $connection to gain access to the database - db
    global $connection; 

    global $update_good, $good_update, $error;
    
    //If it is not empty, then it is set to be equal to $key
    //use the $_GET[''] to key from the url
    if(!empty($_GET['key'])){
        $key = $_GET['key'];
    }else{
        $key = "";
    }
    
    
    if($key != ''){
        
        
        $sql = mysqli_query($connection, "SELECT * FROM signup WHERE activation_key = '$key' ");
        $count = mysqli_num_rows($sql);
        
       
        if($count == 1){
            while($row = mysqli_fetch_array($sql)){
                $is_active = $row['is_active'];
                
                if($is_active == 0){
                    
                    // the is_active is = 0 in the database, it chnages it to 1 which will make it active because its enum entity and is either a true or false value. 
                    
                    $update_sql = "UPDATE signup SET is_active = '1' WHERE activation_key = '$key' ";
                    $update_query = mysqli_query($connection, $update_sql);
                    
                    //alert message if the update query is successful
                    if($update_query){
                        $update_good = "<div class='alert alert-info email_alert'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                        Your Email Has Been Verified Successfully.</div>";
                    }
                }else{
                    //error handling, if the email is already activated then this alert will be displayed. 
                    $good_update = "<div class='alert alert-info email_alert'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                        Your Email Has Already Been verified.</div>";
                }
            }
        }else{// outside the loop and if any value is given besides 1 or 0 then there is an error and try again. 
            $error = "<div class='alert alert-danger email_alert'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                        Error Occured, Please Try Again</div>";
        }
        
    }

?>