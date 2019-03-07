<?php include("../config/db.php"); ?>


<?php
    global $connection, $count;
    global $firstname, $lastname, $email, $gender, $intro, $user_image, $quote;

    $query_select = "SELECT * FROM profile WHERE user_id = {$_SESSION['id']} ";
    $query = mysqli_query($connection, $query_select);
    $count = mysqli_num_rows($query);

//else statement to fetch the db data 
//make them global, thats why there is an error on line 14 and add <?php include("../config/db.php");
    while($row = mysqli_fetch_array($query)){
        $user_id = $row['user_id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $gender = $row['gender'];
        $intro = $row['intro'];
        //$quote = $row['quote'];
        $user_image = $row['image'];
    }
//image not saving in the database 
    function profile_image(){
        global $count, $user_image;
        
        //if the data is still the placeholder then the update should fail,, else then find the source image and add the image 
        if($count <= 0){
            echo "<img src='http://placehold.it/250x250' style='margin-left: 40px;>";
        }else{
            echo "
            <div class='thumbnail' style='border:none; padding-top:5px;'>
                <a href'#'>
                    <img src='../images/$user_image' style='margin-left: 40px;'>
                </a>
            </div>";
            
        }
    }

    function profile_data(){
        global $count, $firstname, $lastname, $email, $intro, $gender;
        
        if($count <= 0){
            echo "<div class='alert alert-info email_alert text-center' style='margin: 0px 10px 20px 0px;'>
                First Name Hasnt Been Updated
                </div>";
            
            echo "<div class='alert alert-info email_alert text-center' style='margin: 0px 10px 20px 0px;'>
                Last Name Has Not Been Updated
                </div>";
            
            echo "<div class='alert alert-info email_alert text-center' style='margin: 0px 10px 20px 0px;'>
                Email Has Not Been Updated
                </div>";
            
            echo "<div class='alert alert-info email_alert text-center' style='margin: 0px 10px 20px 0px;'>
                Gender Has Not Been Updated
                </div>";
        
            echo "<div class='alert alert-info email_alert text-center' style='margin: 0px 10px 20px 0px;'>
                Description Has Not Been Updated
                </div>";
        }else{
            echo "<label class='control-label col-sm-3'>Firstname:</label>
                <div class='col-sm-9'>$firstname</div><br><br>";
            
            echo "<label class='control-label col-sm-3'>Lastname:</label>
                    <div class='col-sm-9'>$lastname</div><br><br>";
            
            echo "<label class='control-label col-sm-3'>Email:</label>
                    <div class='col-sm-9'>$email</div><br><br>";
            
            echo "<label class='control-label col-sm-3'>Gender:</label>
                    <div class='col-sm-9'>$gender</div><br><br>";
            
            echo "<label class='control-label col-sm-3'>About Me:</label>
                    <div class='col-sm-9'>$intro</div><br><br>";
            
        }
        
    }

?>