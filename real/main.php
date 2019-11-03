<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="reg.css">
</head>
<style>
img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
<body>
	<div class="header">
		<h2 style="color:white;">Welcome To Bet World</h2>
   
	</div>
	<div class="content">
        <?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
	if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<div class="profile_info">
        <a target="_blank" href="p.jpg">
			<img src="p.jpg"  >
            </a>

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>
                    <center>
    <br><br><br><h1 style="margin-left:50px;">Choose Your Category</h1>

    </center>
    
<h2 style="float:left;">Basketball</h2>
  
  <a href="basketball.php"><img src="b.jpg" alt="b"></a>

<h2 style="float:left;">Soccer</h2>
 
  <img src="s.jpg" alt="s">

<h2 style="float:left;">League of Legends Sports</h2>
   
  <img src="j.jpg" alt="j">

				<?php endif ?>
                
			</div>
		</div>
	</div>
    
</body>
</html>