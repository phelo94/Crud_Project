<?php include("../config/db.php") ?>
<?php include("../scripts/view_profile.php") ?>


<!--This is the page that displats the search result-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index Page</title>
    
    <!-- simular to last page -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/custom.css">

</head>

<script>

$(document).ready(function(){
    
    $("#search").click(function(){
        
        var search = $("#search_input").val();
        
        
        $.ajax({
            url: '../scripts/search.php',
            type: 'POST',
            data: {search: search},
            success: function(data){}
        });
    });
});    
    
</script>


<body>
<nav class="navbar" style="background-color: #19aff5;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand crud" href="home.php">Waterford FC</a>
    </div>
    
    <form action="result.php" method="post" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" name="search" id="search_input" class="form-control" placeholder="Search">
        </div>
        <button type="submit" name="submit" id="search" class="btn btn-default">Search</button>
    </form>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
<?php


if($count <= 0){

$profile_links = <<<DELIMETER
<a href="#" style="color: white; background-color:#19aff5;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{$_SESSION['firstname']} <span class="caret"></span>
</a>
    <ul class="dropdown-menu">
        <li><a href="../users/profile.php?firstname={$_SESSION['firstname']}">View Profile</a></li>
        <li><a href="../users/complete-profile.php?firstname={$_SESSION['firstname']}">Complete Profile</a></li>
        <li><a href="../users/edit.php?firstname={$_SESSION['firstname']}">Edit Profile</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
DELIMETER;
echo $profile_links;    
    
}else{
$profile_links2 = <<<DELIMETER

<a href="#" style="color: white; background-color:#19aff5;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{$_SESSION['firstname']} <span class="caret"></span>
</a>
    <ul class="dropdown-menu">
        <li><a href="../users/profile.php?firstname={$_SESSION['firstname']}">View Profile</a></li>
        <li><a href="../users/edit.php?firstname={$_SESSION['firstname']}">Edit Profile</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

DELIMETER;
echo $profile_links2;
}
          
?>      
        </li>
        
      </ul>
    </div>
    
  </div>
</nav>

<div class="container">
    <div class="row">
        
        <div class="col-md-3">
            <?php
            
                if($count <= 0){
                    echo "<div class='col-sm-10 col-md-10 col-lg-10'>
                                <center class='thumbnail' style='border:none'>
                                
                                    <h3 style='font-weight:bold;'>$firstname $lastname</h3>


                                    <a href='../users/profile.php?id=$firstname&&$lastname'>
                                        <span class='fa fa-user fa-5x' style='font-size:10em;' aria-hidden='true'></span>
                                    </a>
                                </center><br>
                                <a href='../users/complete-profile.php' class='btn btn-block btn-primary'>Complete Your Profile</a>
                            </div>";
                }else{
                    //But if count > 0 the user should see this
                    
                    // <h3 style='font-weight:bold;'>$user_firstname $user_lastname</h3>
                    // original       <a href='../users/profile.php?id=$user_id&&$firstname&&$lastname'>
                    echo "<div class='col-sm-10 col-md-10 col-lg-10 clearfix'>
                                <center class='thumbnail' style='border:none'>
                                    <h3 style='padding-left:; font-weight:bold;'>Hi, $firstname $lastname</h3>
                                    <a href='../users/profile.php?id=$user_id&&$firstname&&$lastname''>
                                        <img class='thumbnail_img' src='../images/$user_image' />
                                    </a>
                                </center><br>
                                <a href='../users/profile.php' class='btn btn-block btn-primary'>View Your Profile</a>
                            </div>";
                }
            
            ?>
        </div>
        
                
                <div class="row">
<!--                  The search result is displayed here because of this search.php file included here,, add the search script -->
                   <?php include("../scripts/search.php"); ?>
                </div>
            
            
        </div>
        
    </div>
    
  


</body>
</html>