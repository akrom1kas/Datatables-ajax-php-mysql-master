<html>
	<head>
		<title>DataTables</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="container box">
			<h1 align="center">Data Tables</h1>
			<br />
			<div>
				<br />
				<div align="right">
                    <button <a href="editdata.php" type="button" id="add_button" data-toggle="modal" data-target="#userModal"  class="btn btn-info btn-lg">Add</button></a>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Vardas</th>
							<th>Epastas</th>
							<th>Zinute</th>
							<th>Ip</th>
							<th>Laikas</th>
                            <th>Edit</th>
                            <th>Delete</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</body>
</html>
<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
	});

	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST",
		},
		"columnDefs":[
			{

				"targets":[5,6 ],
				"orderable":false
			}
		]

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var vardas = $('#vardas').val();
		var zinute = $('#zinute').val();
		if(vardas != '' && zinute != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Both Fields are Required");
		}
	});

	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#vardas').val(data.vardas);
				$('#zinute').val(data.zinute);
                $('#epastas').val(data.epastas);
                $('#ip').val(data.ip);
                $('#laikas').val(data.laikas);


				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;
		}
	});


});
</script>