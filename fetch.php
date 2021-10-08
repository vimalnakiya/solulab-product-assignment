<?php
session_start();
include("connect.php");


$rs =mysqli_query($con,"SELECT * FROM product ");


$output = '

<h3>Product Details</h3> 
<table class="table table-striped table-bordered">
	<tr>
		<th>Product Name</th>
		<th>Quantity per Unit</th>
		<th>Unit Price</th>
		<th>Unit in stock</th>
		<th>Discontinued</th>
		<th>Category Name</th>
		<th>Veiw</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
';
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
		$output .= '
		<tr>
			<td width="20%">'.$ans["productname"].'</td>
			<td width="10%">'.$ans["qtyperunit"].'</td>
			<td width="10%" >'.$ans["unitprice"].'</td>
			<td width="10%" >'.$ans["unitinstock"].'</td>
			<td width="10%" >'.$ans["discontinued"].'</td>
			<td width="20%" >'.$cname.'</td>
			<td width="5%">
				<a href="viewproduct.php?productid='.$ans["productid"].'"><input type="button" name="view" value="View" class= "btn btn-primary btn-xs"></a>
			</td>
			<td width="5%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$ans["productid"].'">Edit</button>
			</td>
			<td width="5%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$ans["productid"].'">Delete</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="6" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>