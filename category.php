<?php
    
    include "sidebar.php";
?> 
    <!-- Page Heading -->
    <div class="text-center">
        <h1 class="h2 text-gray-900 mb-4">Category List</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                $query="select * from category";
                                $result = mysqli_query($con,$query);
                                
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        if($row['imgUrl'] != ""){
                                            echo "
                                            <img src='Photos/$row[imgUrl]' width='50' height='50'/>
                                            ";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['catId'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <!-- Edit , Delete -->
                                    <td>
                                        <a href="categoryAddUpdate.php?id=<?php echo $row['catId']; ?>" class="btn-sm btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn-sm btn-danger btn-circle" onclick="onDeletedRecord(<?php echo $row['catId'];?>)">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?Php }}else{ ?>
                                    <tr class='alert alert-danger'>
                                        <td colspan='9' class=' text-center'>
                                                No record Found
                                        </td>
                                </tr>
                            <?php } ?>

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
                    location.href = 'categoryDelete.php?id='+id;
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
        session_destroy();
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
        session_destroy();
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
        session_destroy();
    }
?>
<?php include "footer.php";?>