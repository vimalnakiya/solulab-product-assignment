<?php
session_start();


include('connect.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		
		$query = "
		INSERT INTO product set productname='".$_POST["productname"]."', qtyperunit=".$_POST["qtyperunit"].", unitprice=".$_POST["unitprice"].",unitinstock=".$_POST["unitinstock"].",discontinued='".$_POST["discontinued"]."', categoryid=".$_POST["categoryid"]." ";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Product Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$qr=mysqli_query($con,"SELECT * FROM product WHERE productid = ".$_POST["id"]." ");
		
		while($up=mysqli_fetch_array($qr))
		{
			$output["productname"]=$up["productname"];
			$output['qtyperunit'] = $up['qtyperunit'];
			$output['unitprice'] = $up['unitprice'];
			$output['unitinstock']=$up["unitinstock"];
			$output['discontinued'] = $up['discontinued'];
			$output['categoryid'] = $up['categoryid'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE product 
		SET
		 productname='".$_POST["productname"]."', 
		qtyperunit = ".$_POST["qtyperunit"].", 
		unitprice = ".$_POST["unitprice"]." ,
		unitinstock = ".$_POST["unitinstock"].",
		discontinued='".$_POST["discontinued"]."' ,
		categoryid = ".$_POST["categoryid"]."
		WHERE productid = '".$_POST["hidden_id"]."'
		";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM product WHERE productid = '".$_POST["id"]."'";
		$statement = $con->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>