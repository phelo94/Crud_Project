<?php include("../config/db.php"); ?>


<?php
    global $connection;
    global $error, $update_good, $fail_update, $empty_update, $confirm_error;
//from reset button been pressed, then post to db 
    if(isset($_POST['reset'])){
        //get the key from the global values in the db 
        if(!empty($_GET['key'])){
            $key = $_GET['key'];
        }else{
            $key = '';
        }
        //getting hashed password
        if($key != ''){
            $pass_word = $_POST['password'];
            $cpass_word = $_POST['cpassword'];
            
            $pass = mysqli_real_escape_string($connection, $pass_word);
            //$cpass = mysqli_real_escape_string($connection, $cpass_word);
            
            //get the randsal key from the db that hashed the password and then re hash the new password
            $salt_query = mysqli_query($connection, "SELECT randSaltPass FROM signup");
            $row = mysqli_fetch_array($salt_query);
            $salt = $row['randSaltPass'];
            
            //re crypting password again fromm the pass value and will be encrypted again when entering the DB 
            $password = crypt($pass, $salt);
            
            //check if the db has the activation key ,, issue with the activation key not opening in the forgot_pass
            $sql = mysqli_query($connection, "SELECT * FROM signup WHERE activation_key = '$key' ");
            $count = mysqli_num_rows($sql);
            
            //pass_word not password
            if(!empty($pass_word)){
                //if it exists, we need validation again on the user's side
                if($count == 1){
                    
                    if(!preg_match('/^\S*(?=\S{5,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass_word)){
                        $error = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Password Must Be Between 5 and 15 Characters and Must Contain At Least One Lowercase Letter One Uppercase Letter and One Digit.</div>";
                    }else{
                        
                        if($pass_word !== $cpass_word){
                            $confirm_error = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Passwords Do Not Match</div>";
                            //setting the new password entered after completing validation, password has been encrypted at this stage and the password is only updated on the activation key 
                        }else{
                           $update_sql = "UPDATE signup SET password ='{$password}' WHERE activation_key = '$key' ";
                            $update_query = mysqli_query($connection, $update_sql);

                            if($update_query){
                                $update_good = "<div class='alert alert-success email_alert'>
                                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                    Your Password Has Been Resetted.</div>";
                            } 
                        }
                        
                        
                    }
                    
                }else{
                    $fail_update = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                No Data Found</div>";
                }
            }else{
                $empty_update = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Password Field Cannot be Empty, You Must Enter a Password.</div>";
            }
            //no more validation required as of yet on rest password 
        }
    }

?>