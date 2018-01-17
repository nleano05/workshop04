<?php
if(!isset($_GET['name'])){
	die("Name parameter missing");
}else{
	$name = $_GET['name'];
}
if(isset($_POST['logout'])){
	header('location:index.php');
}
$err="";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'nick', 'hupab1ra');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['add'])){
	$make=htmlentities($_POST['make']);
	$year=htmlentities($_POST['year']);
	$mileage=htmlentities($_POST['mileage']);
	
	if($make==''){
		$err="Make is required";
	}else if((!is_numeric($year)) || (!is_numeric($mileage))){
		$err="Mileage and year must be numeric";
	}else{
		$stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)');
		$stmt->execute(array(
        ':mk' => $make,
        ':yr' => $year,
        ':mi' => $mileage)
		);
		$err="Record Inserted";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<title>Nicolas Leano - Autos Database</title>	
</head>
<body>
<div class="container">

	<h1>Tracking Autos for <?php echo $name;?></h1>
	<p><?php echo $err;?></p>
	<form method="POST">
	<p>Make:<input type="text" name="make" size="60"/></p>
	<p>Year:<input type="text" name="year"/></p>
	<p>Mileage:<input type="text" name="mileage"/></p>
	<input type="submit" name="add" value="Add">
	<input type="submit" name="logout" value="Logout">
	</form>

	<h2>Automobiles</h2>
	<ul>
		<?php 
		$stmt = $pdo->prepare("SELECT * from autos"); 
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		$rows = $stmt->fetchAll();
		foreach( $rows  as $row ) {
			echo "<li>";
			echo $row['year']." ".$row['make']."/".$row['mileage'];
			echo "</li>";
			
		}
		?>
	</ul>
</div>

</body>
</html>

