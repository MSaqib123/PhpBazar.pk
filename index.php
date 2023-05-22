<?php include "hheader.php";?>    
<div class="site-blocks-cover" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
              <h2 class="sub-title">#New Summer Collection 2019</h2>
              <h1>Arrivals Sales</h1>
              <p><a href="#" class="btn btn-black rounded-0">Shop Now</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="front/images/model_5.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <!-- ____________ Discover Total Collection __________________ -->
    <?php
    $query = "SELECT c.catId, c.Name, c.description, c.imgUrl, (SELECT COUNT(*) FROM product p WHERE p.catId = c.catId) AS total_products FROM category c LIMIT 3;";
    $result = mysqli_query($con,$query);


    $catId = array();
    $catName = array();
    $catImage = array();
    $totalProdcts = array();
  
    if($result){
      while ($row = mysqli_fetch_assoc($result)) {
        $catId[] = $row["catId"];
        $catName[] = $row["Name"];
        $catImage[] = $row["imgUrl"];
        $totalProdcts[] = $row["total_products"];
      }
    }
    else {
      // Handle query error
      echo "Error: " . mysqli_error($con);
    }
    
    mysqli_free_result($result);
     $catImage[0] = isset($catImage[0]) && $catImage[0] != "" ? "Photos/$catImage[0]" :"img/No_Image.jpg";
     echo "<br>";
     $catImage[1] =  isset($catImage[1]) && $catImage[1] != "" ? "Photos/$catImage[1]" :"img/No_Image.jpg";
     $catImage[2] =  isset($catImage[2]) &&  $catImage[2] != "" ? "Photos/$catImage[2]" :"img/No_Image.jpg";
    ?>
    <div class="site-section">
      <div class="container">
        <div class="title-section mb-5">
          <h2 class="text-uppercase"><span class="d-block">Discover</span> The Collections</h2>
        </div>
        <div class="row align-items-stretch">
          <div class="col-lg-8">
            <div class="product-item sm-height full-height bg-gray">
            <a href="shop.php?id=<?php echo $catId[0]?>" class="product-category"><?php echo "$catName[0]"?> <span  class="text-danger">( <?php echo "$totalProdcts[0]"?> _ items)</span></a>
              <img src="<?php echo $catImage[0];?>" alt="Image" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="product-item sm-height bg-gray mb-4">
              <a href="shop.php?id=<?php echo $catId[1]?>" class="product-category"><?php echo "$catName[1]"?> <span  class="text-danger">( <?php echo "$totalProdcts[1]"?> _ items)</span></a>
              <img src="<?php echo $catImage[1];?>" alt="Image" class="img-fluid">
            </div>
            <div class="product-item sm-height bg-gray">
              <?php
              ?>
              <a href="shop.php?id=<?php echo $catId[2]?>" class="product-category"><?php echo isset($catName[2]) ? "$catName[2]" : "No"?> <span  class="text-danger">( <?php echo isset($totalProdcts[2]) ? "$totalProdcts[2]" : "0" ?> _ items)</span></a>
              <img src="<?php echo $catImage[2]?>" alt="Image" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>


    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section mb-5 col-12">
            <h2 class="text-uppercase">Popular Products</h2>
          </div>
        </div>
        <div class="row">
          <!-- __________________ Feature Products _____________________ -->
        <?php
            $query = "SELECT * from Product where featuredProduct = 1 LIMIT 6";
            $result = mysqli_query($con,$query);

            if($result){
              while ($row = mysqli_fetch_assoc($result)) {
                  
                ?>
                <div class="col-lg-4 col-md-6 item-entry mb-4">
                    <a href="productdetail.php?pId=<?php echo $row["pId"] ?>" class="product-item md-height bg-gray d-block">
                      <img src="<?php echo $row["imgUrl"]!="" ? "Photos/Products/$row[imgUrl]":"img/No_Image.jpg"?>" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#"><?PHP echo $row["Name"] ?></a></h2>
                    <strong class="item-price">RS : <?PHP echo $row["Price"] ?></strong>
                  </div>
          
            <?php
                }
              }
              else {
                // Handle query error
                echo "Error: " . mysqli_error($con);
              }?>
          
        </div>
      </div>
    </div>


      <!-- <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="title-section text-center mb-5 col-12">
              <h2 class="text-uppercase">Most Rated</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 block-3">
              <div class="nonloop-block-3 owl-carousel">
                <div class="item">
                  <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">
                      <img src="front/images/model_1.png" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#">Smooth Cloth</a></h2>
                    <strong class="item-price"><del>$46.00</del> $28.00</strong>
                    <div class="star-rating">
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">
                      <img src="front/images/prod_3.png" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#">Blue Shoe High Heels</a></h2>
                    <strong class="item-price"><del>$46.00</del> $28.00</strong>
                    <div class="star-rating">
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">
                      <img src="front/images/model_5.png" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#">Denim Jacket</a></h2>
                    <strong class="item-price"><del>$46.00</del> $28.00</strong>
                    <div class="star-rating">
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">
                      <img src="front/images/prod_1.png" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#">Leather Green Bag</a></h2>
                    <strong class="item-price"><del>$46.00</del> $28.00</strong>
                    <div class="star-rating">
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">
                      <img src="front/images/model_7.png" alt="Image" class="img-fluid">
                    </a>
                    <h2 class="item-title"><a href="#">Yellow Jacket</a></h2>
                    <strong class="item-price">$58.00</strong>
                    <div class="star-rating">
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                      <span class="icon-star2 text-warning"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    <!-- <div class="site-blocks-cover inner-page py-5" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
              <h2 class="sub-title">#New Summer Collection 2019</h2>
              <h1>New Shoes</h1>
              <p><a href="#" class="btn btn-black rounded-0">Shop Now</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="front/images/model_6.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div> -->
<?php include "hfooter.php";?>