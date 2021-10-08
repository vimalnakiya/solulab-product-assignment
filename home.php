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
    <body>  
        <div class="container">
	
		<div align="right" style="margin-bottom:5px;">
			<button type="button" name="add" id="add" class="btn btn-success">Add Product</button>
		</div>
		<div class="table-responsive" id="data">
		</div>
		</div>
		<div id="dialog" title="Product Details">
			<form method="post" id="form">
		
				<div class="form-group">
					<label>Enter Product Name</label>
					<input type="text" name="productname" id="productname" class="form-control" />
					<span id="error_productname" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Quantity per Unit</label>
					<input type="number" name="qtyperunit" id="qtyperunit" class="form-control" />
					<span id="error_qtyperunit" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Unit Price</label>
					<input type="number" name="unitprice" id="unitprice" class="form-control" />
					<span id="error_unitprice" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Unit In Stock</label>
					<input type="number" name="unitinstock" id="unitinstock" class="form-control" />
					<span id="error_unitinstock" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Select Discontinued</label>
					Yes <input type="radio" name="discontinued" value="Yes"  />
					No <input type="radio" name="discontinued" value="No" checked />
					<span id="error_discontinued" class="text-danger"></span>
				</div>
				

				<div class="form-group">

					<label>Select Category</label><a href="register.php" style="color: blue;" target="_blank">Add Category</a>
					<select name="categoryid" id="categoryid" class="form-control">
						<?php 
						$rs = mysqli_query($con, "Select * from category");
						while($ar = mysqli_fetch_array($rs))
						{
							echo "<option value=".$ar["categoryid"].">".$ar["categoryname"]."</option>";
						}
		
						?>
				</select>
					
					
					
				</div>
				
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>

		</div>
		
		<div id="action_alert" title="Action">

			
		</div>
		
		<div id="delete_confirmation" title="Confirmation">
		<p>Are you sure you want to Delete this data?</p>
		</div>

		</body></html>


	<script>  
$(document).ready(function(){  

	load_data();
    
	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#data').html(data);
			}
		});
	}
	
	$("#dialog").dialog({
		autoOpen:false,
		width:400
	});
	
	$('#add').click(function(){
		$('#dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#dialog").dialog('open');
	});
	
	$('#form').on('submit', function(event){
		event.preventDefault();
		var error_productname = '';
		var error_qtyperunit='';
		var error_unitinstock = '';
		var error_unitprice = '';
		var error_discontinued = '';
		var error_categoryid = '';
		if($('#productname').val() == '')
		{ 
			error_productname = 'Product Name is required';
			$('#error_productname').text(error_productname);
			$('#productname').css('border-color', '#cc0000');
		}
		else
		{
			error_productname = '';
			$('#error_productname').text(error_productname);
			$('#productname').css('border-color', '');
		}
		
		if($('#qtyperunit').val() == '')
		{
			error_qtyperunit = 'Quantity is required';
			$('#error_qtyperunit').text(error_qtyperunit);
			$('#qtyperunit').css('border-color', '#cc0000');
		}
		else
		{
			error_qtyperunit = '';
			$('#error_qtyperunit').text(error_qtyperunit);
			$('#qtyperunit').css('border-color', '');
		}
		if($('#unitinstock').val() == '')
		{
			error_unitinstock = 'Unit In Stock is required';
			$('#error_unitinstock').text(error_unitinstock);
			$('#unitinstock').css('border-color', '#cc0000');
		}
		else
		{
			error_unitinstock = '';
			$('#error_unitinstock').text(error_unitinstock);
			$('#unitinstock').css('border-color', '');
		}
		if($('#unitprice').val() == '')
		{
			error_unitprice = 'Price is required';
			$('#error_unitprice').text(error_unitprice);
			$('#unitprice').css('border-color', '#cc0000');
		}
		else
		{
			error_unitprice = '';
			$('#error_unitprice').text(error_unitprice);
			$('#unitprice').css('border-color', '');
		}
		if($('#categoryid').val() == '')
		{
			error_categoryid = 'Category ID is required';
			$('#error_categoryid').text(error_categoryid);
			$('#categoryid').css('border-color', '#cc0000');
		}
		else
		{
			error_categoryid = '';
			$('#error_categoryid').text(error_categoryid);
			$('#categoryid').css('border-color', '');
		}
		if(error_productname != '' || error_qtyperunit != '' || error_unitprice != '' || error_unitinstock != '' || error_discontinued != '' || error_categoryid != '' )
		{
			return false;
		}
		else
		{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}
		
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	});


	
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#productname').val(data.productname);
				$('#qtyperunit').val(data.qtyperunit);
				$('#unitprice').val(data.unitprice);
				$('#unitinstock').val(data.unitinstock);
				$('#discontinued').val(data.discontinued);
				$('#categoryid').val(data.categoryid);
				$('#dialog').attr('title', 'Edit Data');
				$('#action').val('update');
				$('#hidden_id').val(id);
				$('#form_action').val('Update');
				$('#dialog').dialog('open');
			}
		});
	});
	
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action},
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});
	
});  
</script>