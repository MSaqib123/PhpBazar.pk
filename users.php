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
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>active</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody style="">
                        <?php
                        $query = "select * from users";
                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['uId']?></td>
                                <td>
                                    <?php
                                        $row['uImageUrl'] = (isset($row['uImageUrl'])) ? "Photos/User/".$row['uImageUrl']: "img/No_Image.jpg";
                                    ?>
                                    <img src="<?php echo $row['uImageUrl'] ?>" width="50px" height="50px" class="rounded-circle"/>    
                                </td>
                                <td><?php echo $row['uName']?></td>
                                <td><?php echo $row['uEmail']?></td>
                                <td><?php echo $row['uPassword']?></td>
                                <td><?php echo $row['uPhone']?></td>
                                <td><?php echo $row['uGender']?></td>
                                <td><?php echo $row['uRole']==1?"Admin":"User";?></td>
                                <td><?php echo $row['uStatus']==0?"Active":"Off"?></td>
                                <td>
                                    <a class="btn-sm btn-danger btn-circle" onclick="onDeletedRecord(<?php echo $row['uId'];?>)">
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