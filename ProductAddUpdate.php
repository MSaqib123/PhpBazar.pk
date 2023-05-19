<?php
ob_start();
include 'sidebar.php'; 

$id = "";
$Name = "";
$shortDesc = "";
$longDesc = "";
$img = "";
$category = "";
$price = "";
$catId = "";
$colId = "";
$status = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "select *,category.Name catName ,color.Name colName,product.imgUrl pImg , product.featuredProduct featured from product INNER JOIN category on product.catId = category.catId inner join color on product.colorid = color.colorid WHERE pId = $id";

    // $query = "select * from category";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_assoc($result);

    $Name  = isset($row['Name']) ? $row['Name'] : "";
    $shortDesc = isset($row['shortDesc']) != null ? $row['shortDesc'] : "";
    $longDesc = isset($row['longDesc']) != null ? $row['longDesc'] : "";
    $img = isset($row['pImg']) != null ? $row['pImg'] : "";
    $price = isset($row['Price']) != null ? $row['Price'] : "";
    $catId = isset($row['catId']) != null ? $row['catId'] : "";
    $colId = isset($row['colorId']) != null ? $row['colorId'] : "";
    $status = isset($row['Status']) != null ? $row['Status'] : "";
    $featured = isset($row['featured']) != null ? $row['featured'] : 0;
}
?>

<div class="container">
    <div class="text-center">
        <h1 class="h2 text-gray-900 mb-4"><?php echo  isset($_GET['id']) ? "Update Product" : "Create Product";?> </h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-2">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <form class="user" action="" method="post" enctype="multipart/form-data">
                <input value="<?php echo $id ?>" hidden>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="text" class="form-control" name="Name"
                                        placeholder="Product Name" value="<?php echo $Name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="shortDesc" rows="2" class="form-control"
                                    placeholder="Short Description:"><?php echo $shortDesc ?></textarea>
                            </div>
                            <div class="form-group">
                                <textarea name="longDesc" rows="3" class="form-control"
                                    placeholder="Long Description:"><?php echo $longDesc ?></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="file" class="form-control" id="image_file" name="img">
                                </div>
                                <input type="hidden" name="oldimg" id="image_file" value="<?php echo $img?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="number" class="form-control" name="price"
                                        placeholder="Enter Price" value="<?php echo $price ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <select class="form-control form-select" name="category">
                                        <?php
                                            $query = "select * from category";
                                            $result = mysqli_query($con,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                                if($catId == $row['catId']){
                                                    echo "
                                                        <option value='$row[catId]' selected >$row[Name]</option>
                                                    ";
                                                }
                                                else{
                                                    echo "
                                                        <option value='$row[catId]' >$row[Name]</option>
                                                    ";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <select class="form-control form-select" name="color">
                                        <?php
                                            $query = "select * from color";
                                            $result = mysqli_query($con,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                                if($colId == $row['colorId']){
                                                    echo "
                                                        <option selected value='$row[colorId]'>$row[Name]</option>
                                                    ";
                                                }
                                                else{
                                                    echo "
                                                        <option value='$row[colorId]'>$row[Name]</option>
                                                    ";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <select name="status" class="form-control">
                                        <?php
                                            if($status != ""){
                                                if($status == 1){
                                                    echo "<option value='1' selected>Avalible</option>";
                                                    echo "<option value='0'>OutStock</option>";
                                                }
                                                else{
                                                    echo "<option value='1'>Avalible</option>";
                                                    echo "<option value='0' selected>OutStock</option>";
                                                }
                                            }
                                            else{
                                                echo "<option value='1'>Avalible</option>
                                                    <option value='0'>Out Stock</option>
                                                ";        
                                            }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <b>Featured : &nbsp;&nbsp;</b><input  type="checkbox" <?php echo $featured=1?"checked":"";?> value="<?php echo $featured?>" name="feature"/>
                                </div>
                            </div>
                            
                            <button type="submit" name="ButtonForm" class="btn btn-primary btn-user btn-block">
                                <?php echo  isset($_GET['id']) ? "Update" : "Create";?>
                            </button>
                            <hr>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="<?php echo $img !="" ? "Photos/Products/".$img :"img/No_Image.jpg"; ?>" class="" id="image_preview"/>
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

    if (isset($_POST['ButtonForm'])) {

        $Name = $_POST['Name'];
        $shortDesc = $_POST['shortDesc'];
        $longDesc = $_POST['longDesc'];
        $price = $_POST['price'];
        $catId = $_POST['category'];
        $colId = $_POST['color'];
        $status = $_POST['status'];
        $featuredProduct = $_POST['feature']=="checked" ?1:0;

        

        echo "<script>alert('$featuredProduct');</script>";

        $imgname = null; // initialize to null

        if (isset($_FILES['img']) && $_FILES['img']['size'] > 0) { // check if file is uploaded and has non-zero size
            $imgname = $_FILES['img']['name'];
            $tmpimg = $_FILES['img']['tmp_name'];
        
            $imgname = time() . "_" . $imgname;
        
            //_____ on Edit _____
            if(isset($_GET['id'])){
                unlink("Photos/Products/" . $_POST['oldimg']);
            }
        
            move_uploaded_file($tmpimg, "Photos/Products/" . $imgname);
        } elseif(isset($_GET['id'])) { 
            $imgname = $_POST['oldimg'];
        }

        if(isset($_GET['id'])){
            $query = "update  product set Name = '$Name', shortDesc = '$shortDesc', longDesc='$longDesc',imgUrl = '$imgname',Price = $price, catId = $catId, colorId = $colId, status = $status, featuredProduct = $featuredProduct where pId =". $_GET['id'];
        }
        else{
            $query = "insert into product (pId,Name,shortDesc,longDesc,imgUrl,Price,catId,colorId,STATUS,featuredProduct) values (null,'$Name','$shortDesc','$longDesc','$imgname',$price,$catId,$colId,$status,$featuredProduct)";
        }

        $result = mysqli_query($con, $query) or die("query expired");

        if ($result) {
            if(isset($_GET['id'])){
                $_SESSION["Update"] = "Upated";
                header("location: Product.php");
            }
            else{
                $_SESSION["Create"] = "Created";
                echo "
                <script>
                    location.href = 'Product.php';
                </script>
                ";
            }
        }
    }
?>
<?php include('footer.php') ?>