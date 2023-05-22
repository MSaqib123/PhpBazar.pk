<?php include "hheader.php"; ?>

    <!-- <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
              class="text-black">Cart</strong></div>
        </div>
      </div>
    </div> -->
    
    <div class="site-section">
      <div class="container">
        <div class="title-section mb-5">
              <h2 class="text-uppercase"><span class="d-block">Carts  </span> My Products </h2>
        </div>

        <!-- ________ Total Cart ____________ -->
        <div class="row mb-5">
          <form class="col-md-12" method="post">  
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if(isset($_SESSION["cart"])){
                    // echo "<pre>";
                    // print_r($_SESSION["cart"]);
                    $cart = $_SESSION["cart"];
                    $SubtotalAmount = 0;

                    foreach ($cart as $key => $value) {
                      $totalAmount = $value["price"]*$value["quantity"];
                      $SubtotalAmount += $totalAmount;
                  ?>
                  <tr>
                      <td class="product-thumbnail">
                        <img src="Photos/Products/<?php echo $value["img"]?>" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $value["name"]?></h2>
                      </td>
                      <td><?php echo $value["price"]?> Rs</td>
                      <td>
                        <!-- <form method="post" action="cartUpdate.php"> -->
                            <div class="input-group mb-3" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <!-- <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button> -->
                                <a href="cartUpdate.php?decrement=<?php echo $key ?>"><button class="btn btn-outline-primary" type="button" name="decrement">&minus;</button></a>
                              </div>
                              <input type="text" class="form-control text-center" name="quantity[]" value="<?php echo $value["quantity"]?>" placeholder=""
                                aria-label="Example text with button addon" aria-describedby="button-addon1">
                              <div class="input-group-append">
                                <!-- <button class="btn btn-outline-primary js-btn-plus" type="butotn">&plus;</button> -->
                                <a href="cartUpdate.php?increment=<?php echo $key ?>"><button class="btn btn-outline-primary" type="button" name="increment">&plus;</button></a>
                              </div>
                            </div>
                        <!-- </form> -->
                      </td>
                      <td><?php echo $totalAmount ?> Rs</td>
                      <td><a href="cartUpdate.php?removePId=<?php echo $key ?>" class="btn btn-primary height-auto btn-sm">X</a></td>
                  </tr>
                  <?php } }else{?>
                      <tr class="bg-danger text-center">
                        <td colspan="6" style="color:white">
                          No Carts
                        </td>
                      </tr>
                  <?php  }?>
                  <!-- <tr>
                    <td class="product-thumbnail">
                      <img src="front/images/cloth_1.jpg" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black">Top Up T-Shirt</h2>
                    </td>
                    <td>$49.00</td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center" value="1" placeholder=""
                          aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>
                      </div>
                    </td>
                    <td>$49.00</td>
                    <td><a href="#" class="btn btn-primary height-auto btn-sm">X</a></td>
                  </tr>
                   -->
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <!-- ________ Total Bill ____________ -->
        <?php
        if(isset($_SESSION["cart"])){
        ?>
          <div class="row">
            <!-- _______________ Button + Coupon Cart ___________________ -->
            <div class="col-md-6">
              <!-- _______________ Total Amount ___________________ -->
              <div class="row mb-5">
                <div class="col-md-6 mb-3 mb-md-0">
                  <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                </div>
              </div>

              <!-- _______________ Coupon Code ___________________ -->
              <div class="row">
                <div class="col-md-12">
                  <label class="text-black h4" for="coupon">Coupon</label>
                  <p>Enter your coupon code if you have one.</p>
                </div>
                <div class="col-md-8 mb-3 mb-md-0">
                  <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary btn-sm px-4">Apply Coupon</button>
                </div>
              </div>
            </div>

            <!-- _______________ Total Amount ___________________ -->
            <div class="col-md-6 pl-5">
              <div class="row justify-content-end">
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-12 text-right border-bottom mb-5">
                      <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Sub Total</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black"><?php echo $SubtotalAmount ?> _RS</strong>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Service Charges</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black">200 _RS</strong>
                    </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <span class="text-black">Net Amount</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black"><?php echo $SubtotalAmount+200?> _Rs</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.html'">Proceed
                        To Checkout</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php }?>

      </div>
    </div>
    <script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 1000
        })
</script>
<?php
    if(isset($_SESSION["cartAction"])){
        if($_SESSION["cartAction"]=="Removed"){
            echo "
            <script>
              Toast.fire({
                icon: 'success',
                title: 'Cart Removed'
              })
            </script>
            ";
            unset($_SESSION['cartAction']);
        }
        if($_SESSION["cartAction"]=="Minus"){
            echo "
            <script>
              Toast.fire({
                icon: 'success',
                title: 'Cart Decresed'
              })
            </script>
            ";
            unset($_SESSION['cartAction']);
        }
        if($_SESSION["cartAction"]=="Add"){
            echo "
            <script>
              Toast.fire({
                icon: 'success',
                title: 'Cart Increased'
              })
            </script>
            ";
            unset($_SESSION['cartAction']);
        }
    }
    
    include 'hfooter.php'
 ?>