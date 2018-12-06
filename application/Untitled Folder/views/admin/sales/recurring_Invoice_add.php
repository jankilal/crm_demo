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
      <h1>RecurringInvoice <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>sales/recurringInvoice">RecurringInvoice</a></li>
         <li class="active">RecurringInvoice Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading panel-heading-transparent">
            <strong>Add RecurringInvoice</strong>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url();?>sales/recurringInvoice" class="btn btn-teal btn-sm">Back</a>                           
            </div>
         </div>
     <div class="panel-body">
        <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
          <fieldset>
            <div class="row">
               <div class="form-group">
                  <div class="col-md-6 col-sm-6">
                     <label>Reference No<span class="text-danger"> *</span></label>
                     <input type="text" class="form-control" name="reference_no" value="">
                      <?php echo form_error('reference_no','<span class="text-danger">','</span>'); ?>
                  </div>
                  <div class="col-md-6 col-sm-6">
                     <label>Recur Every <span class="text-danger"></span></label>
                        <select name="recuring_frequency" class="form-control" required="" data-parsley-id="6">
                          <option value="7D">Week</option>
                          <option value="1M">Month</option>
                          <option value="3M">Quarter</option>
                          <option value="6M">Six Months</option>
                          <option value="1Y">One year</option>
                          <option value="2Y">Two year</option>
                          <option value="3Y">Three year</option>
                        </select>  
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group">
                  <div class="col-md-6 col-sm-6">
                     <label>Start Date<span class="text-danger"></span></label>
                         <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="recur_start_date" value="<?php echo date('y-m-d')?>" >
                  </div>
                 
                     <div class="col-md-6 col-sm-6">
                        <label>End Date<span class="text-danger"></span></label>
                         <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="recur_end_date" value="<?php echo date('y-m-d')?>" >
                     </div>
               
               </div>
            </div>
            <div class="row">
               <div class="form-group">
                  <div class="col-md-6 col-sm-6">
                     <label> Client  <span class="text-danger"> *</span></label>
                     <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="client_id" tabindex="-1" aria-hidden="true" >
                        <?php
                           foreach ($user_list as $uc_val) 
                           {
                              ?>
                        <option value="<?php echo $uc_val->user_id; ?>"><?php echo $uc_val->user_full_name.'  ('.$uc_val->user_type.')'; ?>)</option>
                        <?php 
                           }
                           ?>
                     </select>
                      <?php echo form_error('client_id','<span class="text-danger">','</span>'); ?>
                  </div>
                   <div class="col-md-6 col-sm-6">
                    <label>Due Date<span class="text-danger"></span></label>
                         <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="due_date" value="<?php echo date('y-m-d')?>" >
                  </div>
               </div>
            </div>
             <div class="row">
               <div class="form-group">
                  <div class="col-md-6 col-sm-6">
                     <label> Default Tax  <span class="text-danger"></span></label>
                     <input type="text" class="form-control" name="tax" value="">
                  </div>
                   <div class="col-md-6 col-sm-6">
                    <label>Discount<span class="text-danger"></span></label>
                     <input type="text" class="form-control" name="discount" value="">     
                  </div>
               </div>
            </div>
             <div class="row">
               <div class="form-group">
                  <div class="col-md-3 col-sm-3">
                     <label>Allow Paypal</label>
                    </div>
                     <div class="col-md-3 col-sm-3">
                    <label class="switch switch-success"><input type="checkbox" name="allow_paypal" checked=""><span class="switch-label" data-on="YES" data-off="NO"></span></label>
                    </div>
                    <div class="col-md-3 col-sm-3">
                     <label>Allow Stripe</label>
                    </div>
                     <div class="col-md-3 col-sm-3">
                    <label class="switch switch-success"><input type="checkbox" name="allow_stripe" checked=""> <span class="switch-label" data-on="YES" data-off="NO"></span></label>
                    </div>
               </div>
            </div>
             <div class="row">
               <div class="form-group">
                  <div class="col-md-3 col-sm-3">
                     <label>Allow 2Checkout</label>
                    </div>
                     <div class="col-md-3 col-sm-3">
                    <label class="switch switch-success"><input type="checkbox" name="allow_2checkout" checked=""> <span class="switch-label" data-on="YES" data-off="NO"></span></label>
                    </div>
                    <div class="col-md-3 col-sm-3">
                     <label>Allow Authorize.net</label>
                    </div>
                     <div class="col-md-3 col-sm-3">
                    <label class="switch switch-success"><input type="checkbox" name="allow_authorize" checked=""> <span class="switch-label" data-on="YES" data-off="NO"></span></label>
                    </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group">
                  <div class="col-md-3 col-sm-3">
                     <label>Allow CCAvenue</label>
                    </div>
                     <div class="col-md-3 col-sm-3">
                    <label class="switch switch-success"><input type="checkbox" name="allow_ccavenue" checked=""> <span class="switch-label" data-on="YES" data-off="NO"></span></label>
                    </div>
                    <div class="col-md-3 col-sm-3">
                     <label>Allow Braintree</label>
                    </div>
                     <div class="col-md-3 col-sm-3">
                    <label class="switch switch-success"><input type="checkbox" name="allow_braintree" checked=""> <span class="switch-label" data-on="YES" data-off="NO"></span></label>
                    </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                     <label>Notes</label><span class="text-danger"></span>
                     <textarea class="form-control" rows="5"  name="notes" ></textarea>           
                  </div>
               </div>
            </div>
               <div class="row">
                 <div class="form-group">
                  <div class="col-md-12 col-sm-12">
                     <label style="padding-top: 3px;">Assigned To  <span class="text-danger"> *</span></label><br>
                     <label class="radio">
                     <input type="radio" checked name="permission" value="1">
                     <i></i>&nbsp;<span>Everyone</span></label>
                     <i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="who have permission for this menu and all admin user."></i><br>
                     <label class="radio">
                     <input type="radio" name="permission" value="0">
                     <i></i>&nbsp;<span>Customize Permission</span>
                     </label><i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="Select a individual permission . individually edit delete action"></i>
                     <?php echo form_error('permission','<span class="text-danger">','</span>'); ?>
                     <div id="permission_user" >
                        <label for="field-1" class="control-label">Select Users <span class="text-danger">*</span></label>
                        <?php
                           foreach ($user_list as $usr_val) 
                           {
                           ?>
                        <div class="col-md-12">
                           <div class="row">
                              <div  class="col-md-5 checkbox c-checkbox needsclick">
                                 <label class="checkbox">
                                 <input type="checkbox" value="<?php echo $usr_val->user_id; ?>" name="assigned_to[]" class="needsclick" data-parsley-multiple="assigned_to" data-parsley-id="30"><i></i> &nbsp;&nbsp;&nbsp;<?php echo $usr_val->user_full_name.'  ('.$usr_val->user_type.')'; ?>
                                 </label>
                              </div>
                              <div class="action_<?php echo $usr_val->user_id; ?>" id="action_<?php echo $usr_val->user_id; ?>" style="display: none;">              
                                 <label class="checkbox">
                                 <input readonly="" name="view_<?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
                                 <i></i>Can View </label>
                                 <label class="checkbox">
                                 <input readonly="" name="edit_<?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
                                 <i></i>Can Edit </label>
                                 <label class="checkbox">
                                 <input readonly="" name="delete_<?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
                                 <i></i>Can Delete </label>
                              </div>
                           </div>
                        </div>
                        <?php
                           }
                           ?>
                     </div>
                     <div class="row">
                     <div class="col-md-1">
                     <button type="submit" name="Submit" value="Add" class="btn btn-teal">Submit</button>
                     </div>
                     <div class="col-md-1">
                     <button type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</button>
                     </div>
                     </div>
                     </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /MIDDLE -->

<script type="text/javascript">
   $(document).ready(function () {
       $('#permission_user').hide();
       $("div.action").hide();
       $("input[name$='permission']").click(function () {
           $("#permission_user").removeClass('show');
           if ($(this).attr("value") == "0") {
               $("#permission_user").show();
           } else {
             $('#permission_user').find('input[type=checkbox]:checked').removeAttr('checked');
               $("#permission_user").hide();
           }
       });
   
       $("input[name$='assigned_to[]']").click(function () {
           var user_id = $(this).val();           
           $("#action_"+user_id).removeClass('show');
           if (this.checked) {
               $("#action_"+user_id).show();
           } else {
               $("#action_"+user_id).hide();
           }
   
       });
   });
   
   
   function getStateList(country_id)
   {
       var str = 'country_id='+country_id;
       var PAGE = '<?php echo base_url(); ?>client/getStateList';
       
       jQuery.ajax({
           type :"POST",
           url  :PAGE,
           data : str,
           success:function(data)
           {           
               if(data != "")
               {
                   $('#state_id').html(data);
               }
               else
               {
                   $('#client_state_id').html('<option value=""></option>');
               }
           } 
       });
   }
   
   
   
</script>
<script type="text/javascript">
   $(document).ready(function()
   {
   
      var counter = 0;
      $("#add_produst_btn").click(function () {
         $('#removeButton').show();
         
              var newTextBoxDiv = $(document.createElement('div'))
              .attr("id", 'TextBoxDiv' + counter);
   
              newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label style="margin-bottom: 10px;">Attachment File</label><input type="file" multiple="multiple" name="attachement[]"><br></div></div></div>');
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
<script type="text/javascript">
   $(document).ready(function () {
       $('#permission_user').hide();
       $("div.action").hide();
       $("input[name$='permission']").click(function () {
           $("#permission_user").removeClass('show');
           if ($(this).attr("value") == "0") {
               $("#permission_user").show();
           } else {
             $('#permission_user').find('input[type=checkbox]:checked').removeAttr('checked');
               $("#permission_user").hide();
           }
       });
   
       $("input[name$='assigned_to[]']").click(function () {
           var user_id = $(this).val();           
           $("#action_"+user_id).removeClass('show');
           if (this.checked) {
               $("#action_"+user_id).show();
           } else {
               $("#action_"+user_id).hide();
           }
   
       });
   });
</script>