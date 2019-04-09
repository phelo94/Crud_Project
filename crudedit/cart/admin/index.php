<!-- Restrict login to Admin -->
<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}
?>

<?php include 'inc/header.php'; ?> 


<html>
<!--<div class="close-btn fa fa-times"></div>
	
	<!-- Navigation  -->
<?php include "inc/nav.php"; ?> 
<!--<img src="../inc/nav.php"-->
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container align-center">
				<div class="row">
					<div class="page_header text-center">
					<br>
						<h2>Shopping Cart Admin</h2>
						<p>Welcome</p>
					</div>
					<br>
					<br>
					<br>

    

                    
					
	
	 
	<!-- FOOTER -->
<!-- include 'inc/footer.php'; ?>  -->
<?php include '../../user/footer.php'; ?> 