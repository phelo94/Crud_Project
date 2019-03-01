<?php
    global $connection;

    $query = mysqli_query($connection, "SELECT * FROM signup");
    $user_count = mysqli_num_rows($query);

    $query = mysqli_query($connection, "SELECT * FROM profile");
    $verified_users = mysqli_num_rows($query);

//where activation = active,, which is is_active = '0'
    $query = mysqli_query($connection, "SELECT * FROM signup WHERE is_active = '0'");
    $not_verified_users = mysqli_num_rows($query);


?>
     

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Players'],
            //the text and data displayed in the bar 
            <?php
                $text = ['Total Users', 'Verified Users', 'Not Verified Users'];
                $numbers = [$user_count, $verified_users, $not_verified_users];
            
            //looping from 0 to count the data and keep going through an array 
            //stackoverflow 
                for($i=0; $i < count($numbers); $i++){
                    echo "['{$text[$i]}'" . "," . "{$numbers[$i]}], ";
                }
            
            ?>
            
          
        ]);

        var options = {
          chart: {
            title: 'Graph of Verified Players',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
</script>