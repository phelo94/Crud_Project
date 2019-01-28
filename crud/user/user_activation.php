<?php include("../config/db.php"); ?>
<?php include("../scripts/activate.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USER ACTIVATION</title>
    
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/custom.css">

</head>
<body>
   
<nav class="navbar" style="background-color: #19aff5;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand crud" href="../user/home.php">Waterford FC</a>
      <p><img src="../images/Waterford_FC_Crest.png" width="116" height="125" alt=""/> </p>
    </div>
    
  </div>
</nav>
  
  
  
   
<div class="container">
   <div class=" sub_msg">
    <h2>Your Email Has Been Verified</h2>
    <div class="row" style="margin-bottom:20px;">
    </div>
   
    
    <div class="row text=center" >
       <?php echo $update_good; ?>
       <?php echo $good_update; ?>
       <?php echo $error; ?>
   </div>
   
    <div class="row sub_msg">
        <p>Click on the button to go to the login page.</p>
    </div>
    
    
    <div class="row signup">
       <div class="row" style="margin-bottom:10px;">
           <h3><a href="../index.php" class="btn btn-primary">Click Here To Login</a></h3>
       </div>
        
    </div>
    
</div>
</div>
    
</body>
</html>