<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM mindaugas 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["vardas"] = $row["vardas"];
		$output["epastas"] = $row["epastas"];
        $output["zinute"] = $row["zinute"];
        $output["ip"] = $row["ip"];
        $output["laikas"] = $row["laikas"];
        $output["id"] = $row["id"];

	}
	echo json_encode($output);
}
?>

