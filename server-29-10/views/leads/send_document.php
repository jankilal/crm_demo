<!-- CSS JQGRID TABLE -->
<link href="<?= base_url(); ?>webroot/css/layout-datatables.css" rel="stylesheet" type="text/css" />
<!-- HTML DATATABLE -->
<table class="table table-striped table-bordered table-hover" id="docDatatable">
	<thead>
		<tr>
			<th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#docDatatable .docCheckbox"/>
			</th>
			<th>S.No.</th>
			<th>Product Name</th>
			<th>Description</th>
			<!-- <th>Document</th> -->
		</tr>
	</thead>
	<tbody>
	<?php
	if(!empty($document_list))
	{
		$i =1;
		foreach ($document_list as $res) 
		{
			?>
			<tr class="odd gradeX">
				<td>
					<input type="checkbox" class="docCheckbox" name="selected_documents[]" value="<?= $res->item_doc_id; ?>"/>
				</td>
				<td><?= $i ?></td>
				<td><?= $res->product_name; ?></td>
				<td><?= $res->item_description; ?></td>
				<!-- <td><a target="_blank" href="<?= base_url().$res->item_attachment; ?>"><?= $res->item_attachment; ?></a></td> -->
			</tr>
			<?php
			$i++;
		}
	}
	?>
	</tbody>
</table>
<div class="row">
	<div class="col-md-12">
		<button type="button" class="btn btn-info pull-right editSendDoc">Send</button>
		<button type="button" class="btn btn-danger pull-right closeSendDoc">Cancel</button>
		<div id="edit_popup"></div>
	</div>
</div><!--  value="<?php $email->email?>" -->
<hr>

 <!-- Modal -->
<div class="modal fade" id="Doc_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Email</h4>
			</div>
        	<?php

	     if(!empty($email))
	     {
	     		?>
				<div class="modal-body">
					<table>
						<tr>
							<td>
								<p>Are you sure you want to send documents to this email <b><?= $email; ?></b></p>
							</td>
						</tr>
					</table>
				</div>
		   	<?php
		    }
	      else
	      {
	      	?>
		     	<div class="modal-body">
		     		<p>Please enter Email</p>
		     		<input type="email" class="form-control" name="sendDocemail" id="sendDocemail" placeholder="Enter Your Email">
		     		<span id="errorMail" style="color: red; font-weight: bold;"></span>
		     		
		     	</div>
   			<?php
   		 } ?>
		   <div class="modal-footer">
		      	<button type="button" class="btn btn-default sendMail" id="confirmSend">Confirm</button>
		      	<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
      </div>
   </div>
</div>
<script type="text/javascript">

	if (jQuery().dataTable) {

		var table = jQuery('#docDatatable');
		table.dataTable({
			 "paging": false,
			 "searching": false
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

		table.on('change', 'tbody tr .docCheckbox', function () {
			jQuery(this).parents('tr').toggleClass("active");
			jQuery('.docCheckbox:checked').length == jQuery('.docCheckbox').length ? jQuery('.group-checkable').prop('checked',true) : jQuery('.group-checkable').prop('checked',false);
		});
		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	jQuery('#confirmSend').on('click' , function (){

		var selected_doc_array = [];
		if ('<?= $email; ?>' != '')
		{
			var email_id = '<?= $email; ?>';
		} 
		else
		{
			if ($('#sendDocemail').val()== '') 
			{
				$('#errorMail').html('Please Enter Your Email');
				$('#sendDocemail').focus();
				return false;
			}
			else
			{
				$('#errorMail').html('');
				var email_id = $('#sendDocemail').val();
			}
		}
		$(".docCheckbox:checked").map(function()
			{
				selected_doc_array.push($(this).val());
			}).get();

			var str = 'action_send_documents='+'Send Documnets' + '&ids_array='+JSON.stringify(selected_doc_array);
			str += '&lead_id='+'<?= $lead_id;?>'+'&email_id='+email_id;
			var PAGE = '<?php echo base_url(); ?>leads/sendConfirmDocument';
			jQuery.ajax({
				type :"POST",
				url  :PAGE,
				data : str,
				success:function(response)
				{    
					// console.log(response); return false;
		   			$('#Doc_modal').modal('hide');
		   			$('#product_documents').slideUp();
					setNotificationMsg('Documents Sent Successfully!' , 'success');
				}
			});
	});

	$('.closeSendDoc').on('click', function(){
		$('#load_data').html('');
	   	$('#product_documents').slideUp();

	});

	$('.editSendDoc').on('click', function(){
		
	    if($(".docCheckbox:checked").length > 0)
		{
	   		$('#Doc_modal').modal('show');	
		}
		else
		{
			alert('Please check documemt');
			return false;
		}
	});	
</script>