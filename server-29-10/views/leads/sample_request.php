<!-- CSS JQGRID TABLE -->
<link href="<?= base_url(); ?>webroot/css/layout-datatables.css" rel="stylesheet" type="text/css" />
<!-- HTML DATATABLE -->
<div>
        
    <h4>Add Sample Request</h4>
    <div class="row">
		<div class="form-group">
			<div class="col-md-6 col-sm-6">
				<label>Sample Details</label>
				<textarea name="product_details[]" class="form-control"></textarea>
			</div>
			<div class="col-md-4 col-sm-4">
				<label style="margin-bottom: 10px;">Images/Request File</label>
				<input type="file" multiple="multiple" name="product_img_file_0[]">
			</div>
			<div class="col-md-2 col-sm-2">
				<label class="checkbox">
				<input type="checkbox" name="sample_request_0" id="sample_request_0" value="1" onclick="sampleRequest('0')">
				<i></i>Sample Request</label>       
			</div>
		</div>
    </div>
    <div class="row" id="sample_req_dates_0" style="display: none;">
        <div class="form-group">                            
            <div class="col-md-6 col-sm-6">
				<label>Order Date</label>
				<input type="text" name="order_date_0" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>">
            </div> 
            <div class="col-md-6 col-sm-6">
				<label>Delivery Date</label>
				<input type="text" name="delivery_date_0" class="form-control datepicker" placeholder="<?php echo date('Y-m-d') ?>">
            </div>                             
        </div>
    </div> 
    <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
    <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
</div>