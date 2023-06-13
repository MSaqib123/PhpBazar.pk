<?php
include 'config.php';

//_____________ Insert image __________________
if (count($_POST) > 0) {
    if ($_POST['type'] == 1) {
        $Name = $_POST['commonKey'];
        
        $fileName = $_FILES['value']['name'];
        $targetFilePath = time() . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Check file size (optional)
        // if ($_FILES['value']['size'] > 500000) {
        //     $response = array("statusCode" => 201, "message" => "File size exceeds the limit.");
        //     echo json_encode($response);
        //     exit;
        // }
        
        // Allow only certain file formats (you can customize this as per your requirements)
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($fileType, $allowedFormats)) {
            $response = array("statusCode" => 201, "message" => "Only JPG, JPEG, PNG, and GIF files are allowed.");
            echo json_encode($response);
            exit;
        }
        
        if (move_uploaded_file($_FILES['value']['tmp_name'], 'Photos/Splash/'.$fileName)) {
            $sql = "INSERT INTO tblConfig (commonKey, value, status) VALUES ('$Name', '$fileName', 0)";
            if (mysqli_query($con, $sql)) {
                $Id = mysqli_insert_id($con);
                $slno = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tblConfig"));
                $response = array("statusCode" => 200, "id" => $Id, "slno" => $slno, "Name" => $Name, "Splash" => $fileName, "status" => 0);
            } else {
                $response = array("statusCode" => 201, "message" => "Error: " . $sql . "<br>" . mysqli_error($con));
            }
        } else {
            $response = array("statusCode" => 201, "message" => "Error uploading the file.");
        }
        
        mysqli_close($con);
        echo json_encode($response);
    }
}

//______________ Delete Image ____________________
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$result = mysqli_query($con, "SELECT * FROM tblConfig WHERE id=$id");
        $row = mysqli_fetch_array($result);    
        if ($row && $row['status'] == 0) {
            $sql = "DELETE FROM tblConfig WHERE id=$id";
            if (mysqli_query($con, $sql)) {
                echo $id;
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "403";
        }
		mysqli_close($con);
	}
}


//______________ Active splash ____________________
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "UPDATE tblconfig
            SET status = CASE
                WHEN id=$id THEN 1
                ELSE 0
            END;
            ";
		if (mysqli_query($con, $sql)) {
			 // Update was successful
             $query = "SELECT * FROM tblconfig";
             $result = mysqli_query($con, $query);
             if ($result) {
                 // Fetch all rows and return as a response
                 $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
                 $response = array("statusCode" => 200, "rows" => $rows);
                 
                 echo json_encode($response);
             } else {
                 // Failed to fetch rows
                 $response = array("statusCode" => 500, "message" => "Failed to fetch rows");
                 echo json_encode($response);
             }
		} 
		else {
			$colorId = $id;
            $response = array("statusCode" => 200, "colorId" => $colorId,"Name" => $name);
			echo json_encode($response);
		}
		// mysqli_close($con);
		// echo json_encode($response);
	}
}



//______________ Update Image ____________________
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
?>


