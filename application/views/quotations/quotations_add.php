<style type="text/css">
.ui-slider-range
{
background:green;
}
.ui-slider-horizontal .ui-slider-handle
{
top: -1px;
}
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Quotations <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>quotations">Quotations</a></li>
         <li class="active">Quotations Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add quotations</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>quotations" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Opportunity<span class="text-danger"> *</span></label>
                                 <select name="opportunities_id" class="form-control" onchange="getOpportunityProducts(this.value)">
                                    <option value="">Select opportunity</option>
                                    <?php
                                       foreach ($opportunities_result as $op_res) 
                                       {
                                          ?>
                                         <option value="<?php echo $op_res->opportunities_id; ?>"><?php echo $op_res->opportunity_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('opportunities_id','<span class="text-danger">','</span>'); ?>
                              </div>
                               <div class="col-md-6 col-sm-6 project">
                                 <label>Version</label>
                                  <input type="text" name="quotation_version" class="form-control">
                                 <?php echo form_error('quotation_version','<span class="text-danger">','</span>'); ?>
                              </div>                           
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">  
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                                 <select name="lead_status_id" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Dective</option>
                                 </select>
                                 <?php echo form_error('lead_status_id','<span class="text-danger">','</span>'); ?>             
                              </div>
                               <div class="col-md-6 col-sm-6">
                                 <label>Quotation Time From</label>
                                 <input type="text"  value="<?php echo set_value('quotation_time_from'); ?>" name="quotation_time_from" class="form-control">     
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">   
                              <div class="col-md-6 col-sm-6">
                                 <label>Budget</label><span class="text-danger"> *</span>
                                 <input type="text" name="quotation_budget" class="form-control"  value="<?php echo set_value('quotation_budget'); ?>">
                                 <?php echo form_error('quotation_budget','<span class="text-danger">','</span>'); ?>
                              </div>
                               <div class="col-md-6 col-sm-6">
                                 <label>Valid up to </label><span class="text-danger"> *</span>
                                 <input type="text" name="quotation_valid_up_to" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" class="form-control datepicker" value="<?php echo set_value('quotation_valid_up_to'); ?>" >
                                 <?php echo form_error('quotation_valid_up_to','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">                             
                              <div class="col-md-6 col-sm-6">
                                 <label>Quotation Repaly Date </label>
                                 <input autocomplete="off" type="text" name="quotation_repaly_date" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" class="form-control datepicker" value="">
                                 <?php echo form_error('quotation_repaly_date','<span class="text-danger">','</span>'); ?>
                              </div>
                                <div class="col-md-6 col-sm-6">
                                 <label>Attachment File</label>
                                 <input type="file" name="quotation_attachment">
                              </div>
                           </div>
                        </div> 
                      <div class="row" id="quotations_products" style="display: none;">
                        <h4>Select Product Details</h4>
                         <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                            <div id="opp_produsts"></div>
                              <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                               <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                            </div>
                          </div>
                      </div>                      
                      <div id="TextBoxesGroup"><br></div>   
                      <div class="row">                    
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Terms & Condition</label>
                                 <textarea class="form-control" rows="5" name="notes" ></textarea>
                              </div>
                            </div>
                      </div>
                </fieldset>
               <div class="row">
                 <div class="col-md-1">
                      <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                   </div>
                   <div class="col-md-1">
                      <button type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</button>
                 </div>
               </div>
            </form>
          </div>
        </div>
      </div>
    </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
    
  // Add Extra Contact Persons

  $(document).ready(function(){

    var counter = 0;
    $("#extra_contact").click(function () {
       $('#removeContact').show();       
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html(''); 

            newTextBoxDiv.appendTo("#TextBoxesGroup");        
            counter++;

        });
        $("#removeContact").click(function () {
          counter--;
          $("#TextBoxDiv" + counter).remove();         
          if(counter == 0){
          $('#removeContact').hide();
        }

        });
  });

 function getOpportunityProducts(opportunity_id)
 {
      var str = 'opportunity_id='+opportunity_id;
        var PAGE = '<?php echo base_url(); ?>quotations/getOpportunityProducts';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#quotations_products').show();
                    $('#opp_produsts').html(data);
                }
                else
                {
                   $('#quotations_products').show();
                }
            } 
        });
 }

$(document).ready(function()
 {

    var counter = 0;
    $("#add_produst_btn").click(function () {
       $('#removeButton').show();
       
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6">'+'<label>Product Details</label><textarea name="product_details[]" class="form-control"></textarea>'+'</div><div class="col-md-6 col-sm-6"><label style="margin-bottom: 10px;">Images/Attachment File</label><input type="file" multiple="multiple" name="product_img_file_'+counter+'[]"></div></div></div><p></p>');
            newTextBoxDiv.appendTo("#TextBoxesGroup");        
            counter++;

        });

        $("#removeButton").click(function () {
        counter--;
        $("#TextBoxDiv" + counter).remove();         
        if(counter == 0){
        $('#removeButton').hide();
        }


        });
});
</script>