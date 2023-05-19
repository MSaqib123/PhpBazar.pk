<?php
ob_start();
include 'sidebar.php'; 
$catname = "";
$catdesc = "";
$catimg = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "Select * from category WHERE catid = $id";

    // $query = "select * from category";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_assoc($result);

    $catname = $row['Name'] != null ? $row['Name'] : "";
    $catdesc = $row['description'] != null ? $row['description'] : "";
    $catimg = $row['imgUrl'] != null ? $row['imgUrl'] : "";
}
?>

<div class="container">
    <div class="text-center">
        <h1 class="h2 text-gray-900 mb-4"><?php echo  isset($_GET['id']) ? "Update Category" : "Create Category";?> </h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-2">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <form class="user" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="text" class="form-control" name="catname"
                                        placeholder="Enter Category Name" value="<?php echo $catname ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="catdesc" rows="5" class="form-control"
                                    placeholder="Description:"><?php echo $catdesc ?></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="file" class="form-control" id="image_file" name="catimg">
                                </div>
                                <input type="hidden" name="oldimg" id="image_file" value="<?php echo $catimg?>">
                            </div>
                            <button type="submit" name="update" class="btn btn-primary btn-user btn-block">
                                Update
                            </button>
                            <hr>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="<?php echo $catimg!="" ? "Photos/".$catimg :"img/No_Image.jpg"; ?>" class="" id="image_preview"/>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            // Get image URL from input file
                            $("#image_file").change(function() {
                                var file = $(this)[0].files[0];
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    alert("sdf");
                                    $("#image_preview").attr("src", e.target.result);
                                }
                                reader.readAsDataURL(file);
                            });
                        });
                        
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

    if (isset($_POST['update'])) {

        $catname = $_POST['catname'];
        $catdesc = $_POST['catdesc'];

        $imgname = null; // initialize to null

        if (isset($_FILES['catimg']) && $_FILES['catimg']['size'] > 0) { // check if file is uploaded and has non-zero size
            $imgname = $_FILES['catimg']['name'];
            $tmpimg = $_FILES['catimg']['tmp_name'];
        
            $imgname = time() . "_" . $imgname;
        
            //_____ on Edit _____
            if(isset($_GET['id'])){
                unlink("Photos/" . $_POST['oldimg']);
            }
        
            move_uploaded_file($tmpimg, "Photos/" . $imgname);
        } elseif(isset($_GET['id'])) { // on edit, keep the old image if no new image is selected
            $imgname = $_POST['oldimg'];
        }

        if(isset($_GET['id'])){
            $query = "update  category set Name = '$catname', description = '$catdesc', imgUrl = '$imgname' where catid = " . $_GET['id'];
        }
        else{
            $query = "insert into category(Name,description,imgUrl) values('$catname','$catdesc','$imgname')";
        }

        $result = mysqli_query($con, $query) or die("query expired");

        if ($result) {
            if(isset($_GET['id'])){
                $_SESSION["Update"] = "Upated";
                header("location: category.php");
            }
            else{
                $_SESSION["Create"] = "Created";
                echo "
                <script>
                    location.href = 'category.php';
                </script>
                ";
            }
        }
    }
?>
<?php include('footer.php') ?>