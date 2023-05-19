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
        <h2 class="text-uppercase">Form Login</h2>
    </div>
</div>

<div class="row justify-content-center">
<div class="col-md-7">
    <form method="post">
        <div class="p-3 p-lg-5 border">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="c_email" name="uEmail" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="c_subject" class="text-black">Password</label>
                    <input type="text" class="form-control" id="c_subject" name="uPassword">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login" name="login">
                </div>
            </div>
        </div>
    </form>
</div>

</div>
<?php
    if(isset($_POST["login"])){
        $uEmail = $_POST["uEmail"];
        $uPassword = $_POST["uPassword"];
        $query = "select * from users where uEmail = '$uEmail' and uPassword = '$uPassword' ";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['email'] = $uEmail;
            $_SESSION['image'] = $row["uImageUrl"];
            $_SESSION['role'] = $row["uRole"];
            header("location: index.php");
        }
        else{
            echo "
            <script>
                alert('Fail');
            </script>
            ";
        }
    }
    
?>
<br>
<br>
<?php include "hfooter.php" ?>