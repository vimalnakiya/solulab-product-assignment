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
<body>
		<h1 align="center">Add Category Details </h1>
 <form  method="post">
      

<table width="80%" align="center" class="table table-sm table-bordered"  border="2" >
	<tr>
		<td align="center"><label> <b>Category ID :</b></label></td><div class="form-group">	

		<td colspan="3">
	  <div>
	  	<b style="color: red;font-size: 20px;">*</b>
	 	<input type="text" name="categoryid" required id="categoryid" >
	    
	  </div>
	</td>
<div class="form-group">  

</div>
</tr>
<tr>
    <td align="center"><label> <b>Category Name :</b></label></td><div class="form-group">  

    <td>
    <div>
      <b style="color: red;font-size: 20px;">*</b>
    <input type="text" name="categoryname" required id="categoryname" >
      
    </div>
  </td>
<div class="form-group">  

</div>
</tr>


	 <tr>
	 	<td colspan="2" align="center"> 
	  <div>
	 	<input type="submit" name="submit" id="reg_btn" class="btn btn-primary "  >
	  </div>
	</td>
	
</tr>
</div>
</table>
	</form>
</body>
</html>
<?php
include 'connect.php';
if(!isset($_REQUEST["submit"]))
exit;
$cid=$_REQUEST["categoryid"];
$cname=$_REQUEST["categoryname"];
$ans= mysqli_query($con, "insert into category set categoryid=".$cid.", categoryname='".$cname."'");
if($ans==1)
{
  echo "Category Inserted";
}
else{
  echo "Not Inserted :";

echo mysqli_error($con);
}
?>
