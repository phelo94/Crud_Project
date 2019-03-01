<?php
function count_values($tbl){
    global $connection;
    
    $query = mysqli_query($connection, "SELECT * FROM $tbl");
    $count = mysqli_num_rows($query);
    echo "<div style='font-size:25px;'>{$count}</div>";
}

function not_values($tbl){
    global $connection;
    
    $query = mysqli_query($connection, "SELECT * FROM $tbl WHERE is_active = '0'");
    $count = mysqli_num_rows($query);
    echo "<div style='font-size:25px;'>{$count}</div>";
}

?> 

<!-- <i class="fas fa-tachometer-alt"></i> -->



<div class="row content">
        
    <div class="col-md-2 admin-links">
       <h3 class="text-center">Admin Dashboard</h3>
        <ul class="">
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt" aria-hidden="true"></i>   Dashboard</a></li>
            <li><a href="./admin_scripts/view.php"><i class="fas fa-users" aria-hidden="true"></i>   View All Users</a></li>
            <li><a href="./admin_scripts/verified.php"><i class="fas fa-check" aria-hidden="true"></i>   Verified Users</a></li>
            <li><a href="./admin_scripts/not_verified.php"><i class="far fa-times-circle" aria-hidden="true"></i>  Not Verified Users</a></li>
            <!--<li><a href="./admin_scripts/not_verified.php"><i class="fab fa-php"></i>   Test</a></li> -->
        </ul>
    </div>

    <div class="col-md-10">

        <div class="row rowDiv">
            <div class="col-lg-4 col-md-6">
               <!-- color -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fas fa-users fa-4x"></i>
                            </div>
                            
                            <div class="col-xs-9 text-right">
                               <?php count_values("signup"); ?>
                                <div style='font-weight:bold;'>Users</div>
                            </div>
                        </div>
                        
                        <a href="./admin_scripts/view.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <!--  <i class="fas fa-users"></i> -->
                    </div>
                </div>
                
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-check fa-4x font_awesome"></i>
                            </div>
                            
                            <div class="col-xs-9 text-right" style="color: #ffffff;">
                               <?php count_values("profile"); ?>
                                <div style='font-weight:bold;'>Verified Users</div>
                            </div>
                        </div>
                        
                        <a href="./admin_scripts/verified.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        
                    </div>
                </div>
                
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="far fa-times-circle fa-4x font_awesome"></i>
                            </div>
                            
                            <div class="col-xs-9 text-right" style="color: #ffffff;">
                               <?php not_values("signup"); ?>
                                <div style='font-weight:bold;'>Not Verified Users</div>
                            </div>
                        </div>
                        
                        <a href="./admin_scripts/not_verified.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fas fa-arrow-alt-circle-right" aria-hidden="true"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        
                        <!--   far fa-times-circle ,,,,,,,   <i class="fas fa-arrow-alt-circle-right"></i>-->
                    </div>
                </div>
                
            </div>
        </div>
        
        <!--include chart here -->
        <?php include("./admin_scripts/admin_chart.php"); ?>
        <div id="columnchart_material" style="width: 80%; height: 500px; margin:0 auto;"></div>
        
    </div><!-- col-md-10 End -->


</div>


</div>
