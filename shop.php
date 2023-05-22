<?php include "hheader.php";?>    
<div class="site-section">
        <div class="container">
        <div class="row mb-5">
          <div class="col-md-9 order-1">
            <div class="row align">
              <div class="title-section mb-5">
                  <h2 class="text-uppercase">Products</h2>
              </div>
              <div class="col-md-12 mb-5">
                <div class="float-md-left">
                    <!-- <div class="search-wrap">
                      <div class="container">
                        <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                        <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                        <form action="#" method="post">
                          <input type="text" class="form-control" name="search" onkeyup="this.form.submit()" value="" placeholder="Search keyword and hit enter...">
                        </form>
                      </div>
                    </div> -->
                </div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto btn-group">
                    <!-- <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a> -->
                    <form action="">
                      <?php
                        $search = $_GET["search"] ?? "";
                      ?>
                      <input type="text" class="form-control" name="search" onblur="this.form.submit()" value="<?php if($search){echo $_GET['search'];}?>" placeholder="Search Products">
                    </form>
                    <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" id="dropdownMenuReference"
                      data-toggle="dropdown">Reference</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <a class="dropdown-item" href="shop.php?filter=0">Name, A to Z</a>
                        <a class="dropdown-item" href="shop.php?filter=1">Name, Z to A</a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5">
      <?php

          //____ category fileter ______
          $categoryId = isset($_GET['id']) ? $categoryId = $_GET['id']:0;

          $query = "SELECT * from Product";
          // Add condition for category filtering
          if ($categoryId != 0) {
            $query .= " WHERE catId = $categoryId";
          }

          if(isset($_GET["search"])){
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $query = "SELECT * FROM Product p WHERE p.Name  LIKE '%".$search."%'";
          }

          // //____ sorting filter ______
          $sorting = isset($_GET['filter']) ? $_GET['filter'] : 0;
          // if ($sorting == 0) {
          //   $query .= " ORDER BY Name ASC"; // Sort A to Z
          // } else {
          //   $query .= " ORDER BY Name DESC"; // Sort Z to A
          // }
          

          // //____ Price sorting filter ______
          // Add price range filtering condition
          // $minPrice = $_GET['minPrice'] ?? null; 
          // $maxPrice = $_GET['maxPrice'] ?? null; 

          // if ($minPrice !== null && $maxPrice !== null) {
          //   $minPrice = (float)$minPrice; // Convert to float
          //   $maxPrice = (float)$maxPrice; // Convert to float

          //   // Add the price range condition to the query
          //   $query .= " AND Price >= $minPrice AND Price <= $maxPrice";
          // }



          $result = mysqli_query($con,$query);
          // if($result){
          //     while ($row = mysqli_fetch_assoc($result)) {
            
          if ($result) {
            // Fetch all products into an array
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Apply sorting based on the selected option
            if ($sorting == 0) {
              usort($products, function ($a, $b) {
                return strcmp($a['Name'], $b['Name']); // Sort A to Z
              });
            } else {
              usort($products, function ($a, $b) {
                return strcmp($b['Name'], $a['Name']); // Sort Z to A
              });
            }

            foreach ($products as $row) {
              ?>
                <div class="col-lg-6 col-md-6 item-entry mb-4">
                  <a href="productdetail.php?pId=<?php echo $row["pId"] ?>" class="product-item md-height bg-gray d-block">
                    <img src="<?php echo $row["imgUrl"]!="" ? "Photos/Products/$row[imgUrl]":"img/No_Image.jpg"?>"  alt="Image" class="img-fluid">
                  </a>
                  <h2 class="item-title"><a href="#"><?PHP echo $row["Name"] ?></a></h2>
                  <div class="container">
                      <div class="row d-flex justify-content-between">
                        <div class="col-9">
                          <strong class="item-price"><del>RS : <?PHP echo $row["Price"] ?></del> RS : <?PHP echo $row["Price"]-100 ?></strong>
                          <div class="star-rating">
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                          </div>
                        </div>
                        <div class="col-2 mr-4">
                            <div class="row">
                              <a href="cartAdd.php?id=<?php echo $row["pId"] ?>" class="btn-sm btn-primary">Add to Cart</a>
                            </div>
                        </div>
                      </div>
                  </div>
                  
                  
                  
                </div>

              <?php
                }
              }
              else {
                // Handle query error
                echo "Error: " . mysqli_error($con);
              }?>
            
            </div>
            <!-- ________________ Pagination bar ______________ -->
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&gt;</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- ________________ Filter bar ______________ -->
          <div class="col-md-3 order-2 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <a href="shop.php?id=0" class="d-flex">
                    <b class="text-black border-bottom" style="font-weight: bolder;">Clear</b> 
                  </a>
                <?Php
                    $query = "SELECT c.catId, c.Name, c.description, c.imgUrl, (SELECT COUNT(*)  FROM product p WHERE p.catId = c.catId) AS total_products FROM category c;";
                    $result = mysqli_query($con,$query);
                
                    if($result){
                      while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <li class="mb-1">
                  <a href="shop.php?id=<?php echo $row["catId"]?>" class="d-flex">
                    <span><?php echo $row["Name"]?></span> 
                    <span class="text-black ml-auto">(<?php echo $row["total_products"]?>)</span>
                  </a>
                </li>
                <?php
                      }
                    }
                    else {
                      // Handle query error
                      echo "Error: " . mysqli_error($con);
                    }
                ?>
              </ul>
            </div>

            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
              </div>
              <script>
                $(function() {
                    var minPrice = <?php echo $minPrice; ?>; // Replace with your minimum price value from the database
                    var maxPrice = <?php echo $maxPrice; ?>; // Replace with your maximum price value from the database

                    $("#slider-range").slider({
                      range: true,
                      min: minPrice,
                      max: maxPrice,
                      values: [minPrice, maxPrice],
                      slide: function(event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                      }
                    });

                    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
                  });
              </script>
              <!-- <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                <label for="s_sm" class="d-flex">
                  <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
                </label>
                <label for="s_md" class="d-flex">
                  <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
                </label>
                <label for="s_lg" class="d-flex">
                  <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
                </label>
              </div> -->
              <!-- <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                <a href="#" class="d-flex color-item align-items-center">
                  <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red
                    (2,429)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center">
                  <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span
                    class="text-black">Green (2,298)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center">
                  <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue
                    (1,075)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center">
                  <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span
                    class="text-black">Purple (1,075)</span>
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?php
if(isset($_SESSION["cAdd"])){
  echo "
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 1000
          })
          
          Toast.fire({
            icon: 'success',
            title: 'Added To Car'
          })
        </script>
        ";
        unset($_SESSION['cAdd']);
}

include "hfooter.php";

?> 