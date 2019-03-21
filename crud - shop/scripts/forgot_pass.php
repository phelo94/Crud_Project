<?php include("../config/db.php"); ?>
<?php include("../lib/swift_required.php"); ?>


<?php

    global $connection;
//call all scripting variables globally
    global $error, $fail, $info;
//forgot is the reset button called
    if(isset($_POST['forgot'])){
        $email = $_POST['email'];
        
        $email = mysqli_real_escape_string($connection, $email);
        //retrieving the activated email in the DB 
        $query_sql = "SELECT * FROM signup WHERE email = '{$email}' ";
        $query = mysqli_query($connection, $query_sql);
        $user_row = mysqli_num_rows($query);
        //if email is not empty ,,if the row in the DB is empty, then return email doesnt excists ,, so do <== 0)
        if(!empty($email)){
            if($user_row <= 0){
                $error = "<div class='alert alert-danger email_alert'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            Email Does Not Exist</div>";
                //making sure email and the email address is activated,,, pass the activation so it matches the key in The DB so they can update their password 
            }else{
                while($row = mysqli_fetch_array($query)){
                    $user_email = $row['email'];
                    $user_key = $row['activation_key'];
                }
                
                $msg = "Please follow this link to reset your password <a href='http://localhost:8080/crud/user/reset_password.php?key=".$user_key."'>http://localhost:8080/crud/user/reset_password.php?key=".$user_key."</a>";
                
                //Same swift processs as done in the insert.php during the sign up phase 
                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                    //check if i can hide these details 
                ->setUsername('waterfordfcactivation@gmail.com')
                ->setPassword('Waterford1234');

                $mailer = Swift_Mailer::newInstance($transport);
                // Create the message
                $message = Swift_Message::newInstance('Test')
                // Give the message a subject
                ->setSubject('Reset Your Password')
                // Set the From address with an associative array
                ->setFrom(array('waterfordfcactivation@gmail.com' => 'Waterford FC Activation'))
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
                        Failed To Send Reset Email.</div>";
                }else{
                    $info = "<div class='alert alert-info email_alert'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                        An Email To Reset Your Password Has been Sent.</div>";
                }

            }
        }
        
    }

?>