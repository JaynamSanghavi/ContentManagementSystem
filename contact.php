<?php include_once("includes/db.php"); ?>
<?php $title="Contact Us" ?>

<?php 
	if(isset($_POST['submit'])){
		
		/*
			header jo format me hai wese hi hona chaiye
			from :- jo bhejega
			content-type :- udar konse type me present karna chaiye
			to :- kisko bhejna hai
			subject of the mail
			body of the mail
			
			mail(to,subject,body,header)
			
			for this you need a smtp server so we will have a s/w through which a virtual server will be created
		*/
		
		$header = 'MIME-VERSION: 1.0' . "\r\n";
		$header .= 'From: Jaynam Sanghavi <jaynam123@gmail.com>' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' ."\r\n";
		
		$to = $_POST['emailId'];
		$subject =$_POST['subject'];
		
		$body = $_POST[ 'comments' ];
		
		$sendStatus = mail($to, $subject,$body,$header);
		if( !$sendStatus ){
			echo error_get_last()['message'];
		}else{
			echo "sent";
		}
		
	}
?>

<html>
	<?php include_once("includes/header.php"); ?>
	<body>
			<? include_once("includes/navigation.php"); ?>
			<div class="col-md-6 col-md-offset-3">
				<form action=" " method="POST" role="form">
					<legend>Contact Us!</legend>
					<div class="form-group">
						<label for="emailId">Email Id</label>
						<input type="email" class="form-control" id="emailId" name="emailId" placeholder="Your Email">
					</div>
					<div class="form-group">
						<label for="subject">Subject</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Your Subject">
					</div>
					<div class="form-group">
						<label for="comments">Comments</label>
						<textarea name="comments" id="comments" rows="10" class="form-control" placeholder="Your Comments"></textarea>
					</div>
					<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
				</form>
			</div>
	</body>
</html>