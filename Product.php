<?php
    include "sidebar.php";
?> 
    <!-- Page Heading -->
    <div class="text-center">
        <h1 class="h2 text-gray-900 mb-4">Category List</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card sh adow mb-4">
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Short Description</th>
                            <th>Long Description</th>
                            <!-- <th>Image</th> -->
                            <th>Price</th>
                            <th>Category</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody style="">
                        <?php
                        $query = "
                        select *,category.Name catName ,color.Name colName from product INNER JOIN category on product.catId = category.catId inner join color on product.colorid = color.colorid";
                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['pId']?></td>
                                <td><?php echo $row['Name']?></td>
                                <td style="width: 10%;"><?php echo $row['shortDesc']?> </td>
                                <td  style="width: 20%;"><?php echo $row['longDesc']?> </td>
                                <!-- <td><img src="productimg/<?php echo $row['pimg']?>" width="100px" /></td> -->
                                <td >$<?php echo $row['Price']?> </td>
                                <td ><?php echo $row['catName']?> </td>
                                <td ><?php echo $row['colName']?> </td>
                                <td ><?php 
                                    if($row['Status'] == 0){
                                        echo "<span class='btn-sm btn-danger'>Out Stock</span>";
                                    }
                                    else{
                                        echo "<span class='btn-sm btn-success'>Avalible</span>";
                                    }
                                    ?> </td>
                                <td ><?php echo $row['featuredProduct']==1?"Featured":"Normal"?> </td>
                                <td>
                                    <a href="ProductAddUpdate.php?id=<?php echo $row['pId']; ?>" class="btn-sm btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn-sm btn-danger btn-circle" onclick="onDeletedRecord(<?php echo $row['pId'];?>)">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>    


        </div>
    </div>
    <script>
        function onDeletedRecord(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = 'ProductDelete.php?id='+id;
                }
            })
            
        }

    </script>
<?php
    
    if(isset($_SESSION["Create"])){
        echo "
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'success',
            title: 'Created successfully'
          })
        </script>
        ";
        // session_destroy();
        unset($_SESSION['Create']);
    }
    if(isset($_SESSION["Update"])){
        echo "
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          
          Toast.fire({
            icon: 'success',
            title: 'Updated successfully'
          })
        </script>
        ";
        // session_destroy();
        unset($_SESSION["Update"]);
    }
    if(isset($_SESSION["Delete"])){
        echo "
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
        </script>
        ";
        unset($_SESSION["Delete"]);
    }
?>
<?php include "footer.php";?>