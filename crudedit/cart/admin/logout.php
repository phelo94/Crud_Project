<!-- https://stackoverflow.com/questions/6395228/how-to-terminate-the-user-session-in-php --> 
<?php
session_start();
session_destroy();
header('location: login.php')
?>