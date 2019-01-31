<?php include("./scripts/login.php"); ?> 

<!--This form is displayed inside the login tab in the index.php page-->

<div class="container">
    <div class="row" style="text-align:center;">
        <h3>USER LOGIN</h3>
    </div>
    
    <div class="row sub_msg">
        <p>Please Login Below</p>
    </div>
    
    <div class="row signup">
        <div class="row">
            <h3>Welcome, Please Login</h3>
        </div>
        
        
        <!--This is the login form for the user-->
       
        <form action="" method="post" class=".form-horizontal"> 
    
            <!-- The echo variables are global and can be called here-->        
            <?php echo $error1; ?>
            <?php echo $error2; ?>
            <?php echo $error3; ?>
            <?php echo $error4; ?>
            <?php echo $error5; ?>
            <?php echo $error6; ?>
            
           <div class="row form-group input_group">
               <label for="" class="col-sm-2">Email:</label>
               <div class="col-sm-10">
                  <input type="text" name="email_login" id="email_login" class="form-control"> 
                  <span id="error_Email"></span> 
                  
                  <!-- This brings up an error that has to be made in the login.js to warn the user the email address isnt correct-->
               </div>
           </div>
           
           <div class="row form-group input_group">
               <label for="" class="col-sm-2">Password:</label>
               <div class="col-sm-10">
                  <input type="password" name="password_login" id="password_login" class="form-control"> 
                  <span id="error_Password"></span>
               </div>
           </div>
           
           <div class="row form-group" style="margin: 0px 10px 20px 10px;">
               <div class="col-xs-12">
                  <input type="submit" name="login" id="log_in" class="form-control" value="LOGIN"> 
               </div>
           </div>
            
        </form>
        
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="./user/forgot_password.php">Reset Password</a>
            </div>
        </div>
        
        <!--down
        <div class="row form-group" style="margin: 0px 10px 20px 10px;">
               <div class="col-xs-12">
                  <input type="submit" name="Reset" id="reset" class="form-control" value="Reset Password"> 
               </div>
           </div>
           
           --up-->
        
    </div>
    
</div>