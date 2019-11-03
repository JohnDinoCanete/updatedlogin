<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="reg.css">
</head>
<style>
body{
    background-image: url("basketball.jfif");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
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
		<h2 style="color:white;">BasketBall Category</h2>
   
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


				<?php endif ?>
                
			</div>
		</div>
	</div>
  
    <form method="post" action="basketball.php">

<?php echo display_error(); ?>

<div class="input-group">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
</div>
<div class="input-group">
    <label>Team</label>
    <input type="text" name="team">
</div>
<div class="input-group">
    <label>Bet</label>
    <input type="text " name="bet">
</div>
<div class="input-group">
    <center><button type="submit" class="btn" name="bet">Proceed</button></center>
</div>
</form>
</body>
</html>