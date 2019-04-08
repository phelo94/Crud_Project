<?php
    
//add the connection to the database 
    global $connection;
    global $error1, $error2, $error3, $error4, $error5, $error6;

    if(isset($_POST['login'])){
        $email_login = $_POST['email_login'];
        
        //password feild 
        $pass_login = $_POST['password_login']; //Plain text
        
        $email = filter_var($email_login, FILTER_SANITIZE_EMAIL);
        $pass = mysqli_real_escape_string($connection, $pass_login);
        
        
        //querying the database to see if that email is in the database 
        $sql_query = "SELECT * FROM signup WHERE email = '{$email_login}' ";
        $query = mysqli_query($connection, $sql_query);
        $count = mysqli_num_rows($query);
        
        if(!$query){
            die("QUERY FAILED. " . mysqli_error($connection));
        }
        
        
        if(!empty($email_login) && !empty($pass_login)){
            
            //if the user puts in a password that doest match the criteria of 1 String and having 1 Upper case letter and lower case letter and 7-15 characters,  the password must be found in the database as well 
            if(!preg_match('/^\S*(?=\S{7,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass_login)){
                $error1 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Password is Incorrect</div>";
                
                // add more server side validation,, copy above code and add a different $error and saying that the password doesnt match 
                
                $error2 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Password Must Be Between 7 and 15 Characters and Must Contain At Least One Lowercase Letter One Uppercase Letter and One Digit.</div>";
            }
            
            // if the database doesnt have anything in it from what the user adds 
            if($count <= 0){
                $error3 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            User Not Found</div>";
                
                //if the details put in are correct then use the fetch array that matches the login details in the database
            }else{
                while($row = mysqli_fetch_array($query)){
                    //specif id is stored in a session 
                    $id = $row['id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $user_email = $row['email'];
                    //encrypted password
                    $user_password = $row['password']; 
                    $activation_key = $row['activation_key'];
                    $is_active = $row['is_active'];
                }
                //takes the password from the login form $pass_login, and $user_password = $row['password']; been retrieved from the database//then sends the encrypted password to the database 
                $password = crypt($pass, $user_password);
                
                //if the users details match the db then they will be taken to the logged in home page
                if($is_active == '1'){
                    if($email == $user_email && $password == $user_password){
                        header("Location: ./user/home.php");

                        $_SESSION['id'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['email'] = $email;
                        $_SESSION['activation_key'] = $activation_key;
                        
                    }else{
                        $error3 = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Account Not Found</div>";
                    }
                }else{
                    $error6 = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                You Must Verify Your Email Address Before You Can Login.</div>";
                }
                
                
            }
            
        }else{// if the email login is empty and doesnt match the characters 
            if(empty($email_login)){
                $error4 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Email Field Cannot Be Empty.</div>";
            }
            
            if(empty($pass_login)){
                $error5 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Password Field Cannot Be Empty.</div>";
            }
        }
        
    }

?>