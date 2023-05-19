
<?PHP
    include "sidebar.php";
?>


<p id="success"></p>

<div class="text-center">
    <h1 class="h2 text-gray-900 mb-4"><b>Products Colors</b></h1>
</div>

<div class="text-center">
    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New User</span></a>
    <!-- <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						 -->
</div>

<br>
    
<div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
        <table class="table table-striped table-hover" id="color-table">
            <thead>
                <tr>
                    <th>SL NO</th>
                    <th>NAME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
            $result = mysqli_query($con,"SELECT * FROM color");
                $i=1;
                while($row = mysqli_fetch_array($result)) {
            ?>
                <tr id="<?php echo $row["colorId"]; ?>">
                    <td width="10%">
                        <?php echo $i; ?>
                    </td>
                    <td  width="60%">
                        <?php echo $row["Name"]; ?>
                    </td>
                    
                    <td  width="20%">
                        <a href="#editEmployeeModal" class="edit update btn-sm btn-primary" data-toggle="modal" data-id="<?php echo $row["colorId"]; ?>" data-name="<?php echo $row["Name"]; ?>">
                            Edit
                        </a> |
                        <a href="#" class="delete btn-sm btn-danger" data-id="<?php echo $row["colorId"]; ?>" data-toggle="modal">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="user_form">
				<div class="modal-header">						
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>NAME</label>
						<input type="text" id="name" name="Name" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" value="1" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-success" id="btn_add">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form">
				<div class="modal-header">						
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
					<div class="form-group">
						<label>Name</label>
						<input type="text" id="name_u" name="Name" class="form-control" required>
					</div>				
				</div>
				<div class="modal-footer">
				    <input type="hidden" value="2" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-info" id="update">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
    $(document).ready(function(){
        
        //__________________ Add __________________
        $(document).on('click','#btn_add',function(e) {
            // alert();
            var data = $("#user_form").serialize();
            $.ajax({
                data: data,
                type: "post",
                url: "ColorSave.php",
                success: function(dataResult){
                    // alert(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){ 
                        // $('#addEmployeeModal').modal('hide');   
                        // alert('Data added successfully !'); 
                        // location.href = "Color.php";
                        $('#addEmployeeModal').modal('hide');   
                        // alert('Data added successfully !'); 

                        // Append new row to table
                        var newRow = '<tr id="'+ dataResult.colorId +'">' +
                                        '<td width="10%">' + dataResult.slno + '</td>' +
                                        '<td width="60%">' + dataResult.Name + '</td>' +
                                        '<td width="20%">' +
                                            '<a href="#editEmployeeModal" class="edit update btn-sm btn-primary" data-toggle="modal" data-id="'+ dataResult.colorId +'" data-name="'+ dataResult.Name +'">Edit</a> | ' +
                                            '<a href="#" class="delete btn-sm btn-danger" data-id="'+ dataResult.colorId +'" data-toggle="modal">Delete</a>' +
                                        '</td>' +
                                    '</tr>';
                        $('#color-table tbody').append(newRow);
                    }
                    else if(dataResult.statusCode==201){
                        alert(dataResult);
                    }
                }
            });
        });


        //__________________ Update __________________
        $(document).on('click','.update',function(e) {
            var id=$(this).attr("data-id");
            var name=$(this).attr("data-name");
            $('#id_u'). val(id);
            $('#name_u').val(name);
        });
        
        $(document).on('click','#update',function(e) {
            var data = $("#update_form").serialize();
            $.ajax({
                data: data,
                type: "post",
                url: "ColorSave.php",
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#editEmployeeModal').modal('hide');
                        // alert('Data updated successfully !'); 
                        // location.href = "Color.php";	
                        var rowId = dataResult.colorId;
                        $('#' + rowId + ' td:nth-child(2)').html(dataResult.Name);
                    }
                    else if(dataResult.statusCode==201){
                        alert(dataResult);
                    }
                }
            });
        });

        //__________________ Delete __________________
        $(document).on("click", ".delete", function(e) { 
            var cId=$(this).attr("data-id");
            // alert(cId);

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

                    $.ajax({
                        url: "ColorSave.php",
                        type: "POST",
                        cache: false,
                        data:{
                            type:3,
                            id: cId
                        },
                        success: function(dataResult){
                            $("#"+dataResult).remove();

                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });        
                }
            })

            
        });

    })

	

    

    

    // //__________________ Mutiple Delete __________________    
	// $(document).on("click", "#delete_multiple", function() {
	// 	var user = [];
	// 	$(".user_checkbox:checked").each(function() {
	// 		user.push($(this).data('user-id'));
	// 	});
	// 	if(user.length <=0) {
	// 		alert("Please select records."); 
	// 	} 
	// 	else { 
	// 		WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
	// 		var checked = confirm(WRN_PROFILE_DELETE);
	// 		if(checked == true) {
	// 			var selected_values = user.join(",");
	// 			console.log(selected_values);
	// 			$.ajax({
	// 				type: "POST",
	// 				url: "backend/save.php",
	// 				cache:false,
	// 				data:{
	// 					type: 4,						
	// 					id : selected_values
	// 				},
	// 				success: function(response) {
	// 					var ids = response.split(",");
	// 					for (var i=0; i <script ids.length; i++ ) {	
	// 						$("#"+ids[i]).remove(); 
	// 					}	
	// 				} 
	// 			}); 
	// 		}  
	// 	} 
	// });
	// $(document).ready(function(){
	// 	$('[data-toggle="tooltip"]').tooltip();
	// 	var checkbox = $('table tbody input[type="checkbox"]');
	// 	$("#selectAll").click(function(){
	// 		if(this.checked){
	// 			checkbox.each(function(){
	// 				this.checked = true;                        
	// 			});
	// 		} else{
	// 			checkbox.each(function(){
	// 				this.checked = false;                        
	// 			});
	// 		} 
	// 	});
	// 	checkbox.click(function(){
	// 		if(!this.checked){
	// 			$("#selectAll").prop("checked", false);
	// 		}
	// 	});
	// });
</script>




<?php
// include 'config.php';

// if(count($_POST)>0){
// 	if($_POST['type']==4){
// 		$id=$_POST['id'];
// 		$sql = "DELETE FROM crud WHERE id in ($id)";
// 		if (mysqli_query($conn, $sql)) {
// 			echo $id;
// 		} 
// 		else {
// 			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 		}
// 		mysqli_close($conn);
// 	}
// }

?>



<?PHP
    include "footer.php";
?>