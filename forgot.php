<?php 
	include_once("includes/db.php");
	include_once("admin/functions.php");
?>
<?php $title="Forgot Password" ?>
<?php 
	
	
	/*if(!isset($_GET['forget'])){
		header("Location: index.php");
	}*/
	if($_SERVER['REQUEST_METHOD'] == 'POST' ){
		if(isset($_POST[ 'email' ])){
			$email = $_POST['email'];
			$length= 50;
			$token = bin2hex(openssl_random_pseudo_bytes($length));
			
			//check if the email exists or not 
			
			$query = "SELECT * FROM users WHERE user_email = '$email ' ";
			$user = mysqli_query($connection , $query);
			if(mysqli_num_rows($user) == 1){
				//email exists
				//now update the token
				$query = "UPDATE users SET token = '$token' WHERE user_email ='$email'";
				$updateToken = mysqli_query($connection , $query);
				confirmQuery($updateToken);
				
				$header = 'MIME-VERSION: 1.0' . "\r\n";
				$header .= 'From: Jaynam Sanghavi <jaynam123@gmail.com>' . "\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' ."\r\n";

				$to = $email;
				$subject ="Blog Change Password ";

				$body = " Please Click the below link to reset the password :<br/>
				<a href='http://localhost/blog/reset.php?email=$email&token=$token</a>";
				
				echo "http://localhost/blog/reset.php?email=$email&token=$token";

				$sendStatus = mail($to, $subject,$body,$header);
				if( !$sendStatus ){
					echo error_get_last()['message'];
				}else{
					echo "sent";
				}	
			}else{
				echo "Some issue with email id ! or No such user found";
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
									<h2 class="text-center">Forgot Passowrd</h2>
									<p>You can reset your password here</p>
									<div class="panel-body">
										<form method="post" action="" role="form" id="forget-password">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
													<input class="form-control" type="email" id=email name="email" placeholder="Enter your email id"> 
												</div>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-lg btn-primary btn-block" name="reset-submit" value="submit">
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