<?php
include 'config.php';

if(count($_POST)>0){
	if($_POST['type']==1){
		$Name=$_POST['Name'];
		$sql = "INSERT INTO color  VALUES (Null,'$Name')";
		if (mysqli_query($con, $sql)) {
			$colorId = mysqli_insert_id($con);
            $slno = mysqli_num_rows(mysqli_query($con, "SELECT * FROM color"));
            $response = array("statusCode" => 200, "colorId" => $colorId, "slno" => $slno, "Name" => $Name);
		} 
		else {
			$response = array("statusCode" => 201, "message" => "Error: " . $sql . "<br>" . mysqli_error($con));
		}
		mysqli_close($con);
		echo json_encode($response);
	}
}


if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$name=$_POST['Name'];
		$sql = "UPDATE color SET `Name`='$name' WHERE ColorId=$id";
		if (mysqli_query($con, $sql)) {
			$colorId = $id;	
            $response = array("statusCode" => 200, "colorId" => $colorId,"Name" => $name);
		} 
		else {
			$colorId = $id;
            $response = array("statusCode" => 200, "colorId" => $colorId,"Name" => $name);
			echo json_encode($response);
		}
		mysqli_close($con);
		echo json_encode($response);
	}
}

if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `color` WHERE colorId=$id ";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		mysqli_close($con);
	}
}



?>