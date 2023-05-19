<?php 
    ob_start();
    include "hheader.php";
  
  if(isset($_SESSION['email'])){
    header("location: index.php");
  }
?>
<br><br>
<div class="row text-center">
    <div class="title-section mb-5 col-12">
        <h2 class="text-uppercase">Form Register</h2>
    </div>
</div>

<form method="post" enctype="multipart/form-data">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_fname" name="uName1">
                    </div>
                    <div class="col-md-6">
                        <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_lname" name="uName2">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="c_email" name="uEmail" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_subject" class="text-black">Password </label>
                        <input type="text" class="form-control" id="c_subject" name="uPassword">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="c_subject" class="text-black">Phone Number</label>
                        <input type="text" class="form-control" id="c_subject" name="uPhone">
                    </div>
                    <div class="col-md-6" style="margin-top:8px">
                        <label for="c_subject" class="text-black">Gender</label><br> 
                        <label><input type="radio" name="uGender" value="1"/> Male </label>
                        <label><input type="radio" name="uGender" value="0"/> Female</label>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="submit" name="registorUser" class="btn btn-primary btn-lg btn-block" value="Send Message">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="" class="text-black">Select Image</label>
                        <input type="file" id="c_fname" name="uImageUrl" >
                    </div>
                    <div class="col-md-12">
                        <img src="img/No_Image.jpg" class="" style="width:100%;height:250px" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<br><br>

<?php
if(isset($_POST["registorUser"])){
    $uName = $_POST["uName1"] . $_POST["uName2"];
    $uEmail = $_POST["uEmail"];
    $uPassword = $_POST["uPassword"];
    $uPhone = $_POST["uPhone"];
    $uGender = $_POST["uGender"];
    $uImageUrl = null;
    if(isset($_FILES["uImageUrl"])){
        $imagName =$_FILES["uImageUrl"]["name"]; 
        $tmpName =$_FILES["uImageUrl"]["tmp_name"]; 
        $img = time().$imagName;
        move_uploaded_file($tmpName , "Photos/User/".$img);
        $uImageUrl = $img;
    }

    $query = "insert into users values (null,'$uName','$uEmail','$uPassword','$uPhone',$uGender,'$uImageUrl',0)";

    $result = mysqli_query($con,$query);

    if($result){
        header("location: Login.php");
    }
}

?>


<?php include "hfooter.php" ?>