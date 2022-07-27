<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO mindaugas (vardas, epastas, zinute,ip, laikas) 
			VALUES (:vardas, :epastas, :zinute, :ip, :laikas)
		");
		$result = $statement->execute(
			array(
				':vardas'	=>	$_POST["vardas"],
				':epastas'	=>	$_POST["epastas"],
                ':zinute'	=>	$_POST["zinute"],
                ':ip'	=>	$_POST["ip"],
                ':laikas'	=>	$_POST["laikas"],

			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE mindaugas 
			SET vardas = :vardas, epastas = :epastas, zinute = :zinute
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
                ':vardas'	=>	$_POST["vardas"],
                ':epastas'	=>	$_POST["epastas"],
                ':zinute'	=>	$_POST["zinute"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>

