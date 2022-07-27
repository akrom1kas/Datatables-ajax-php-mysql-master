<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM mindaugas ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE vardas LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR epastas LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR zinute LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["vardas"];
	$sub_array[] = $row["epastas"];
    $sub_array[] = $row["zinute"];
    $sub_array[] = $row["ip"];
    $sub_array[] = $row["laikas"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-xs update"> <i class="glyphicon glyphicon-pencil">&nbsp;</i>Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>