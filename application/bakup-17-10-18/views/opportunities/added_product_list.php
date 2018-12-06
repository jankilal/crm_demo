<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr class="info">

					<th>S.No.</th>
					<th>Title</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Action</th>
					<?php
					if(isset($actionType) && $actionType == 'update')
					{
						?>
						<th>Action</th>
						<?php
					}
					?>
				</tr>
			</thead>
			<tbody>
			<?php
			$opp_process_data = $this->session->userdata('opportunities_process');
			if(!empty($items_list))
			{
				$i =1;
				foreach ($items_list as $res) 
				{
					?>
					<tr>
						<td><?= $i ?></td>
						<!-- <td hidden> <?= $res->item_id?></td> -->
						<td><?= $res->item_name; ?></td>
						<td><?= $res->unit_cost; ?></td>
						<td><?= $res->item_desc; ?></td>
						<td><button class="btn btn-sm btn-danger" onclick="removeTempProduct(this , '<?= $res->item_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
						<?php
						if(isset($actionType) && $actionType == 'update')
						{
							?>
							<td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this)" data-id="<?= $res->item_id; ?>" type="button"><i class="fa fa-remove"></i></button></td>
							<?php
						}
						?>
					</tr>
					<?php
					$i++;
				}
			}
			?>
			</tbody>
		</table>
		<?php
		if(!isset($actionType))
		{
			?>
			<hr>
			<div class="pull-right">
				<button type="button" class="btn btn-3d btn-sm btn-reveal btn-teal onAddNewProduct"><i class="fa fa-plus"></i><span>Submit</span></button>&nbsp;&nbsp;
				<button type="button" class="btn btn-3d btn-sm btn-reveal btn-red onRmNewProduct"><i class="fa fa-remove"></i><span>Cancel</span></button>
			</div>
			<?php
		}
		?>
	</div>
</div>
<script type="text/javascript">
	<?php
	if(isset($new_item_id)){
		?>
			selected_product_array.push(<?= $new_item_id; ?>)
		<?php
	}
	?>
	function removeAddedProduct(obj, id)
	{
	  bootbox.confirm("Are you sure you want to delete product",function(confirmed){
	  	if(confirmed)
	    {
	      var data = 'lead_product_id='+id;
	      $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
	        if(res)
	        {
	           $(obj).parent('td').closest('tr').remove();
	        }
	      });
	    }
	  });
	}

	function removeTempProduct(obj , id)
	{
	  bootbox.confirm("Are you sure you want to delete product",function(confirmed){
	  	if(confirmed)
	    {
	    	for(var i = selected_product_array.length - 1; i >= 0; i--) {
			    console.log(selected_product_array[i]);
			    if(selected_product_array[i] == id) {
			       selected_product_array.splice(i, 1);
			    }
			}
			$(obj).parent('td').closest('tr').remove();
		}
	  });
	}

	$(document).on('click' , '.onAddNewProduct' , function(){
		if(selected_product_array.length > 0)
		{
			var postData = 'add_new_products='+'Add New products'+'&lead_id='+'<?= $opp_process_data['opportunities_id']; ?>'+'&ids_array='+JSON.stringify(selected_product_array);
			$.post('<?= base_url().'opportunities/addNewLeadProduct' ?>' , postData , function( res ){
				if(res){
					selected_product_array = [];
					$('#refreshLeadProduct').html(res);
					$('#load_added_product').html('');
					reloadQuoteProduct();
				}
			});
		}
		else
		{
			alert('Please selecte product first.');
			return false;
		}
	});

	$(document).on('click' , '.onRmNewProduct' , function(){
		bootbox.confirm("Are you sure you want to delete product",function(confirmed){
	  	if(confirmed)
	    {
			selected_product_array = [];
	    }
	  });
	});
</script>