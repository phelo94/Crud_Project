<!--First we start a session using the session_start() method-->



<?php session_start(); ?>



<?php
    $_SESSION['id'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['email'] = null;
    $_SESSION['activation_key'] = null;

//$_SESSION['activation_key'] = not null;
//$_SESSION['password'] = not null;
//$_SESSION['pass_word'] =  null;

    //The the user should be redirected to the index.php page and shown the login tab
    header("Location: ../index.php#login");

?>