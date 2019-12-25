
<div class="col-md-12 col-sm-12">
	<div style="margin-top: 1px;">

		<div class="jumbotron" style="padding: 2rem 4rem !important;">
			<div class="toast toast-error" data-autohide="false" style="max-width: 100%;">
		    	<div class="toast-body">
		      		<span></span>
		      		<!-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button> -->
		    	</div>
		  	</div>
		  	<div class="toast toast-success" data-autohide="false" style="max-width: 100%;">
		    	<div class="toast-body">
		      		<span></span>
		      		<!-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button> -->
		    	</div>
		  	</div>
			<form method="POST" id="expenses-form">
				<input type="hidden" name="add_item_detail" value="add_item_detail">
			<div class="main-content">
				<h3 class="text-center">
					<span>Add Today's Expenses Detail</span>
				</h3>
				<br>
				<div class="row form-group">
					<label for="email" class="col-md-3">Select User</label>
			    	
			    	<select class="form-control col-md-6" name="user_id" id="user-id">
					    <option value="">Select User</option>
			    		<?php  
			    			foreach ($db->get('users') as $user):
			    			echo '<option value="'.$user['id'].'">'.$user['first_name'].'</option>';
			    			endforeach;
			    		?>
					    
					</select>
			  	</div>
			  	<div class="row form-group">
					<label for="email" class="col-md-3">Item and Price</label>
			    	<input type="text" class="col-md-4 form-control item-name" placeholder="Item Name" name="item[]" required autofocus>
			    	<input type="text" class="col-md-1 offset-md-1 form-control item-price" value="0"  placeholder="Price" name="price[]" onblur="checkPrice(this);" required>
			    	<button type="button" class="offset-md-1 btn btn-success btn-sm" onclick="addRow(this);">  &nbsp;&nbsp;+&nbsp;&nbsp;</button>
			  	</div>
			  	<div id="add-more-fields">
			  		
			  	</div>
			  	<br>
			  	<div class="row form-group">
					<label for="total-price" class="col-md-1 offset-md-5">Total</label>
			    	<input type="text" class="col-md-2 offset-md-1 form-control" placeholder="Total Price" id="total-price" name="total_price" readonly>
			  	</div>
			  	<div class="row form-group">
					<button type="button" onclick="saveData(this)"class="btn btn-success offset-md-7 col-md-2"> Save</button>
			  	</div>
			</div>
			</form>
		</div>
	</div>
</div>