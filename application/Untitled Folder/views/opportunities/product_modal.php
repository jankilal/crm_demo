<!-- CSS JQGRID TABLE -->
<link href="<?= base_url(); ?>webroot/css/layout-datatables.css" rel="stylesheet" type="text/css" />
<div id="content" class="padding-20">
	<!-- HTML DATATABLE -->
<table class="table table-striped table-bordered table-hover" id="productDatatable">
	<thead>
		<tr>
			<th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#productDatatable .checkboxes"/>
			</th>
			<th>S.No.</th>
			<th>Title</th>
			<th>Amount</th>
			<th>Description</th>
			
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
	if(!empty($items_list))
	{
		$i =1;
		foreach ($items_list as $res) 
		{
			?>
			<tr class="odd gradeX">
				<td>
					<input type="checkbox" class="checkboxes" name="selected_products[]" value="<?= $res->item_id; ?>"/>
				</td>
				<td><?= $i ?></td>
				<td><?= $res->item_name; ?></td>
				<td><?= $res->unit_cost; ?></td>
				<td><?= $res->item_desc; ?></td>
				

				<?php
				if(isset($actionType) && $actionType == 'update')
				{
					?>
					<td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct('<?= $res->item_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
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
</div>

<script type="text/javascript">

	if (jQuery().dataTable) {

			var table = jQuery('#productDatatable');
			table.dataTable({
				
				"lengthMenu": [
					[5, 15, 20, -1],
					[5, 15, 20, "All"] // change per page values here
				],
				// set the initial value
				"pageLength": 15,            
				"pagingType": "bootstrap_full_number",
				"language": {
					"lengthMenu": "  _MENU_ records",
					"paginate": {
						"previous":"Prev",
						"next": "Next",
						"last": "Last",
						"first": "First"
					}
				},
				"columnDefs": [{  // set default column settings
					'orderable': false,
					'targets': [0]
				}, {
					"searchable": false,
					"targets": [0]
				}],
				"order": [
					[1, "asc"]
				] // set first column as a default sort by asc
			});

			var tableWrapper = jQuery('#productDatatable_wrapper');

			table.find('.group-checkable').change(function () {
				var set = jQuery(this).attr("data-set");
				var checked = jQuery(this).is(":checked");
				jQuery(set).each(function () {
					if (checked) {
						jQuery(this).prop('checked',true);
						jQuery(this).parents('tr').addClass("active");
					} else {
						jQuery(this).prop('checked',false);
						jQuery(this).parents('tr').removeClass("active");
					}
					checked ? jQuery('#product_submit').show() : jQuery('#product_submit').hide();
				});
			});

			table.on('change', 'tbody tr .checkboxes', function () {
				jQuery(this).parents('tr').toggleClass("active");
				jQuery('.checkboxes:checked').length ? jQuery('#product_submit').show() : jQuery('#product_submit').hide();
				jQuery('.checkboxes:checked').length == jQuery('.checkboxes').length ? jQuery('.group-checkable').prop('checked',true) : jQuery('.group-checkable').prop('checked',false);
			});
			tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	jQuery('#product_submit').on('click' , function (){
		$(".checkboxes:checked").map(function(){
			if(temp_added_item_arr !== undefined) {
				if($.inArray($(this).val(), temp_added_item_arr) === -1){
					selected_product_array.push($(this).val());
				}
			}else{
				if($.inArray($(this).val(), selected_product_array) === -1){
					selected_product_array.push($(this).val());
				}
	     	}
	    }).get();
		if(selected_product_array.length > 0)
		{
		 var str = 'action_get_product_by_ids='+'Get Product By Ids' + '&ids_array='+JSON.stringify(selected_product_array);
		 var PAGE = '<?php echo base_url(); ?>opportunities/getLeadProductsById';
		 jQuery.ajax({
		     type :"POST",
		     url  :PAGE,
		     data : str,
		     success:function(response)
		     {
		     	$('#load_added_product').html(response);
		        $('#productModal').modal('hide');
		        setNotificationMsg('Product Added Successfully!' , 'success');
		     }
		 });
		}
		else
		{
			alert('Products already added');
			return false;
		}
	});
</script>
