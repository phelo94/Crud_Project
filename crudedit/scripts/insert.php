<?php include("./lib/swift_required.php"); ?>
   

<?php
    global $connection;
    global $error1, $error2, $error3, $error4, $error5;
    global $info, $fail;

    $f_name = $l_name = $email = $password = "";

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass_word = $_POST['password'];
        
        $sql_query = mysqli_query($connection, "SELECT email FROM signup WHERE email = '{$email}' ");
        $count = mysqli_num_rows($sql_query);
        
        
        //salting the password in the database 
        $sql_salt = mysqli_query($connection, "SELECT randSaltPass FROM signup");
        $row = mysqli_fetch_array($sql_salt);
        $salt = $row['randSaltPass'];
        
        //salting the pass_word the user created
        $password = crypt($pass_word, $salt);
        
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($pass_word)){
            
            if($count > 0){
                $error1 = "<div class='alert alert-danger'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  User With Email Already Exists.
                </div>";
            }else{
                
                $f_name = ucwords(mysqli_real_escape_string($connection, $firstname));
                $l_name = ucwords(mysqli_real_escape_string($connection, $lastname));
                $email = mysqli_real_escape_string($connection, $email);
                $password = mysqli_real_escape_string($connection, $password);
                
                
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error2 = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Email is Invalid.</div>";
                }
                
                if(!preg_match("/^[a-zA-Z ]*$/", $f_name)){
                    $error3 = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Only Letters are Allowed For Firstname</div>";
                }
                
                if(!preg_match("/^[a-zA-Z ]*$/", $l_name)){
                    $error4 = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Only Letters are Allowed For Lastname</div>";
                }
                
                if(!preg_match('/^\S*(?=\S{5,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass_word)){
                    $error5 = "<div class='alert alert-danger email_alert'>;
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Password Must Be Between 5 and 15 Characters and Must Contain At Least One Lowercase Letter One Uppercase Letter and One Digit.</div>";
                }
                
                //preg match validation 
                if((preg_match("/^[a-zA-Z ]*$/", $f_name)) && (preg_match("/^[a-zA-Z ]*$/", $l_name)) &&
                   (filter_var($email, FILTER_VALIDATE_EMAIL)) && (preg_match('/^\S*(?=\S{7,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass_word))){
                    
                    //activation key is encrypted with md5 and randomised 
                    $user_activation_key = md5(rand().time());
                    
                    //is_active has to be 0 since its an enum
                    $sql = "INSERT INTO signup(email, firstname, lastname, password, activation_key, is_active, date_time) VALUES('{$email}', '{$f_name}', '{$l_name}', '{$password}', '{$user_activation_key}', '0', now()) ";
                    $query = mysqli_query($connection, $sql);
                    
                    if(!$query){
                        die("QUERY FAILED " . mysqli_error($connection));
                    }
                    
                    if($query){
                        
                        $msg = "Please activate your account using this link: <a href='http://localhost:8080/crud/user/user_activation.php?key=".$user_activation_key."'>http://localhost:8080/crud/user/user_activation.php?key=".$user_activation_key."</a>
                        </br>
                        If the Link Does not work, copy and paste it.";
                        
                        // Create the Transport that call setUsername() and setPassword()
                        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                        ->setUsername('waterfordfcactivation@gmail.com')
                        ->setPassword('Waterford1234');
 
                        $mailer = Swift_Mailer::newInstance($transport);
                        // Create the message
                        $message = Swift_Message::newInstance('Test')
                        // Give the message a subject
                        ->setSubject('Verify Your Email Address')
                        // Set the From address with an associative array
                        ->setFrom(array('waterfordfcactivation@gmail.com' => 'Waterford FC'))
                        // Set the To addresses with an associative array
                        ->setTo(array($email))
                        // Give it a body
                        ->setBody('Body Message')
                        // And optionally an alternative body
                        ->addPart($msg, 'text/html');
                        // Optionally add any attachments
                        $result = $mailer->send($message);
                        
                        if(!$result){
                            $fail = "<div class='alert alert-danger email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Failed To Send Verification Email.</div>";
                        }else{
                            $info = "<div class='alert alert-info email_alert'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                Verification Email Has Been Sent.</div>";
                        }
                        
                    }
                    
                }
                
            }
            
            
        }else{
            if(empty($firstname)){
                $error3 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Firstname Field Cannot Be Empty.</div>";
            }
            
            if(empty($lastname)){
                $error4 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Lastname Field Cannot Be Empty.</div>";
            }
            
            if(empty($email)){
                $error2 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Email Field Cannot Be Empty.</div>";
            }
            
            if(empty($pass_word)){
                $error5 = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Password Field Cannot Be Empty.</div>";
            }
        }
    }


?>