<?php
	$err='';
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$pword=$_POST['pword'];
		if(($username=='')||($pword=='')){
			$err="Email and password are required";	
		}else if  (strpos($username, '@') ==0) {
			 $err="Email must have an at-sign (@)";
		}else if($pword!="php123"){
			$err="Incorrect password";
			error_log("Login fail ".$_POST['username']);
		}else{
			error_log("Login success ".$_POST['username']);
			header('location:autos.php?name='.$username);
		}
					
		
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Nicolas Leano Login Page</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1>Please Log In</h1>
			<p style="color:red"><?php echo $err;?></p>
			<form method="POST">
				<label for="username">User Name</label>
				<input type="text" name="username" id="username"><br/>
				<label for="pword">Password</label>
				<input type="text" name="pword" id="pword"><br/>
				<input type="submit" name ="submit" value="Log In">
				<input type="submit" name="cancel" value="Cancel">
			</form>
			<p>
			For a password hint, view source and find a password hint
			in the HTML comments.
			<!-- Hint: The password is the three character name of the 
			programming language used in this class (all lower case) 
			followed by 123. -->
			</p>
	</div>
</body>
</html>