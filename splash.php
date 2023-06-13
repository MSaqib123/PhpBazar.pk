
<?PHP
    include "sidebar.php";
?>

<p id="success"></p>

<div class="text-center">
    <h1 class="h2 text-gray-900 mb-4"><b>Products Colors</b></h1>
</div>

<div class="text-center">
    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New User</span></a>
</div>

<br>
    
<div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
        <table class="table table-striped table-hover" id="color-table">
            <thead>
                <tr> <th>SL NO</th><th>NAME</th><th>SPLASH</th><th>SetImage</th><th>ACTION</th> </tr>
            </thead>
            <tbody>
            <?php
                $result = mysqli_query($con,"SELECT * FROM tblConfig where status in(0,1)");
                    $i=1;
                    while($row = mysqli_fetch_array($result)) {
                        $row["value"] = isset($row["value"]) ? "Photos/Splash/".$row["value"] : "img/No_Image.jpg"; 
                ?>
                <tr id="<?php echo $row["id"]; ?>">
                    <td width="10%">
                        <?php echo $i; ?>
                    </td>
                    <td  width="20%">
                        <?php echo $row["commonKey"]; ?>
                    </td>
                    <td  width="20%">
                        <img src="<?php echo $row["value"]?>" width="60px" height="60px"/>
                    </td>
                    <td  width="30%">
                        <?php echo $row["status"]==1 ? "<a class='actveBtn btn-sm btn-success' data-id='$row[id]'>Active</a>" : "<a class='btn-sm btn-danger actveBtn' data-id='$row[id]'>Off</a>"; ?>
                    </td>
                        <td  width="20%">
                        <a href="#editEmployeeModal" class="edit update btn-sm btn-primary" data-toggle="modal" data-id="<?php echo $row["id"]; ?>" data-name="<?php echo $row["commonKey"]; ?>" data-img="<?php echo $row["value"]?>">
                            Edit
                        </a> |
                        <a href="#" class="delete btn-sm btn-danger" data-id="<?php echo $row["id"]; ?>">
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
			<form id="user_form" enctype="multipart/form-data">
				<div class="modal-header">						
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>NAME</label>
						<input type="text" id="name" name="commonKey" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>SelectImage</label>
						<input type="file" id="image" name="value" class="form-control" required>
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
                        <br>
                        <img src="" width="100%" height="200px" id="img"/>
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
        //__________________ Active/off ______________
        
        $(document).on('click','.actveBtn',function(){
            var Id = $(this).attr('data-id');
            alert(Id);
            $.ajax({
                url: "splashrSaveUpdate.php",
                type: "POST",
                cache: false,
                data:{
                    type:4,
                    id: Id
                },
                success: function(response){
                    var jsonData = JSON.parse(response);
                    console.log(jsonData);
                    // alert(jsonData.statusCode);
                    if (jsonData.statusCode === 200) {
                        var rows = jsonData.rows;
                        var tableBody = $("#color-table tbody");
                        
                        var slno = 1;
                        var newRow = "";
                        debugger;
                        $.each(rows, function(index, row) {
                            newRow +=  `<tr id="${row.id}">
                                <td width="10%">${index}</td>
                                <td width="20%">${row.commonKey}</td>
                                <td width="20%"><img src="Photos/Splash/${row.value}" width="60px" height="60px"/></td>
                                <td width="30%">${row.status == 1 ? `<a class="btn-sm btn-success actveBtn" data-id="${row.id}">Active</a>` : `<a class="btn-sm btn-danger actveBtn" data-id="${row.id}">Off</a>`}</td>
                                <td width="20%">
                                    <a href="#editEmployeeModal" class="edit update btn-sm btn-primary" data-toggle="modal" data-id="${row.id}" data-name="${row.commonKey}">Edit</a> |
                                    <a href="#" class="delete btn-sm btn-danger" data-id="${row.id}">
                                        Delete
                                    </a>
                                </td>
                            </tr>`;
                        });
                        tableBody.html(newRow);
                        Swal.fire('Done','some Error','success')
                    } else {
                        Swal.fire('Fail!','some Error','error')
                    }
                },
                error:function(r){
                    Swal.fire('Fail!','some Error','error')
                }
            });        
        })

        //__________________ Add ______________
        $(document).on('click', '#btn_add', function(e) {
            e.preventDefault();
            var formData = new FormData($('#user_form')[0]);
            $.ajax({
                type: "POST",
                url: "splashrSaveUpdate.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $('#addEmployeeModal').modal('hide');
                        var newRow =
                            // '    <tr id="' + dataResult.id + '">' +
                            '<td width="10%">' + dataResult.slno + '</td>' +
                            '<td width="20%">' + dataResult.Name + '</td>' +
                            '<td width="20%">' + `<img src="Photos/Splash/${dataResult.Splash}" width="60px" height="60px"/>`  + '</td>' +
                            '<td width="30%">' + (dataResult.status == 1 ? '<a class="actveBtn btn-sm btn-success" data-id='+dataResult.id+'>Active</a>' : '<a class="actveBtn btn-sm btn-danger" data-id='+dataResult.id+'>Off</a>') + '</td>' +
                            '<td width="20%">' +
                                '<a href="#editEmployeeModal" class="edit update btn-sm btn-primary" data-toggle="modal" data-id="' + dataResult.id + '" data-name="' + dataResult.Name + '">Edit</a> | ' +
                                '<a href="#" class="delete btn-sm btn-danger" data-id="' + dataResult.id + '" data-toggle="modal">Delete</a>' +
                            '</td>' +
                            '</tr>';
                        $('#color-table tbody').append(newRow);
                    } else if (dataResult.statusCode == 201) {
                        alert(dataResult.message);
                    }
                }
            });
        });
    
        //__________________ Delete __________________
        $(document).on("click", ".delete", function(e) { 
            var Id=$(this).attr("data-id");
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
                        url: "splashrSaveUpdate.php",
                        type: "POST",
                        cache: false,
                        data:{
                            type:3,
                            id: Id
                        },
                        success: function(dataResult){
                            alert(dataResult);
                            if(dataResult == "403"){
                                Swal.fire(
                                    'Fail!',
                                    'Active Image can not be deleted?',
                                    'error'
                                )
                                alert();
                            }
                            else{
                                $("#"+dataResult).remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        },
                        error:function(r){
                            Swal.fire(
                                'Fail!',
                                'some Error',
                                'error'
                            )
                        }
                    });        
                }
            })
        });

        //__________________ Update Record __________________
        $(document).on('click','.update',function(e) {
            var id=$(this).attr("data-id");
            var name=$(this).attr("data-name");
            var img=$(this).attr("data-img");
            alert(img);
            $('#id_u'). val(id);
            $('#name_u').val(name);
            $('#img').attr('src',img);
            
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