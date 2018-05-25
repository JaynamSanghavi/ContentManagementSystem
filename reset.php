<?php 
	include_once("includes/db.php");
	include_once("admin/functions.php");
?>
<?php $title="Reset Password" ?>
<?php 
	if(!isset($_GET['token'])  || !isset($_GET['token']) ){
		header("Location: index.php");
	}else{
		$token = $_GET['token'];
		$email=$_GET['email'];
		$query = "SELECT * FROM users WHERE token=  '$token' ";
		$updatePasswordUser = mysqli_query($connection , $query);
		if(mysqli_num_rows($updatePasswordUser) == 0 ){
			header("Location: index.php");
		}
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['password'])  && isset($_POST['confirmPassword']) ){
			$pass = $_POST['password'];
			$confPass = $_POST['confirmPassword'];
			if($pass === $confPass){
				$hashedPassword = password_hash($pass , PASSWORD_BCRYPT);
				
				$query = "UPDATE users SET token=' ', user_password='$hashedPassword' WHERE token= '$token' and user_email= '$email'";
				$updatePassword = mysqli_query($connection , $query);
				confirmQuery($updatePassword);
				echo "Changed";
			}else{
				echo "Both must be same";
			}
		}
	}
?>
<html>
	<?php include_once("includes/header.php"); ?>
	<body>
			<? include_once("includes/navigation.php"); ?>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="text-center">
									<h3><i class="fa fa-lock fa-4x"></i></h3>
									<h2 class="text-center">Reset Passowrd</h2>
									<p>You can reset your password here</p>
									<div class="panel-body">
										<form method="post" action="" role="form" id="forget-password">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
													<input class="form-control" type="password" id="pass" name="password" placeholder="Enter your new password"> 
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
													<input class="form-control" type="password" id="confirmPass" name="confirmPassword" placeholder="Confirm your new password"> 
												</div>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="submit">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</body>
</html>