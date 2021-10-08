<?php
session_start();
include"connect.php";
?>
<html>  
    <head>  
    	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,900" rel="stylesheet">
  		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="styles/custom-responsive-styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
  		<script type="text/javascript" src="scripts/all-plugins.js"></script>
  		<script type="text/javascript" src="scripts/plugins-activate.js"></script>
		<link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
		<script src="jquery.min.js"></script>  
		<script src="jquery-ui.js"></script>
	
    </head>  
<h3>Product Details</h3> 
<table class="table table-striped table-bordered">
	<tr>
		<th>Product Name</th>
		<th>Quantity per Unit</th>
		<th>Unit Price</th>
		<th>Unit in stock</th>
		<th>Discontinued</th>
		<th>Category Name</th>
	</tr>
<?php
$productid=$_REQUEST["productid"];

$rs=mysqli_query($con,"select * from product where productid='".$productid."'");

if(mysqli_num_rows($rs)>=1)
{
	while($ans=mysqli_fetch_array($rs))
	{
		$cat=$ans["categoryid"];
		$cc=mysqli_query($con,"SELECT * from category where categoryid=".$cat."");
		if(mysqli_num_rows($cc)>=1)
		{
		
		$ar = mysqli_fetch_array($cc);
			$cname=$ar["categoryname"];
	}
	else
	{
			$cname = 'No Category Found';
	}
		
		echo "<tr>
			<td width=20%>".$ans["productname"]."</td>
			<td width=10%>".$ans["qtyperunit"]."</td>
			<td width=10% >".$ans["unitprice"]."</td>
			<td width=10% >".$ans["unitinstock"]."</td>
			<td width=10% >".$ans["discontinued"]."</td>
			<td width=20% >".$cname."</td>";
		}
	}
	?>
</table>
	<br>
<p align="center"><a href="home.php"><input type="button" name="home" value="Home" class= 'btn btn-primary'></a></p>