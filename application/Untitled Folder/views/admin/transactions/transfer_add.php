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
      <h1>Transfer <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>transactions/transfer">Transfer</a></li>
         <li class="active">Transfer Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Transfer</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>transactions/transfer" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>From Account <span class="text-danger"> *</span></label>
                                <select onchange="getTransferList(this.value)" class="form-control select_box select2-hidden-accessible" style="width: 100%" name="from_account_id"  tabindex="-1" aria-hidden="true">
                                <option>select account</option>
                                <?php
                                       foreach ($account_details as $ac_val) 
                                       {
                                          ?>
                                         <option value="<?php echo $ac_val->account_id; ?>"><?php echo $ac_val->account_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                </select> 
                                  <?php echo form_error('from_account_id','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-6 col-sm-6">
                              <label>To Account<span class="text-danger"> *</span></label>
                                <select class="form-control select_box select2-hidden-accessible" id="to_account_id" name="to_account_id" >
                                </select> 
                                  <?php echo form_error('to_account_id','<span class="text-danger">','</span>'); ?>
                            </div>
                         </div>
                      </div>
                        <div class="row">
                          <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Date <span class="text-danger"></span></label>
                                 <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="transfer_date" value="<?php echo date('y-m-d')?>" >    
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label> Amount <span class="text-danger"> *</span></label>
                              <input name="amount" class="form-control" type="text" value=""> 
                              <?php echo form_error('amount','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div> 
                       </div>
                       <div class="row">
                         <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Payment Method <span class="text-danger"></span></label>
                                    <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="payment_methods_id" tabindex="-1" aria-hidden="true" >
                                        <?php
                                       foreach ($payment_methode as $pc_val) 
                                       {
                                          ?>
                                         <option value="<?php echo $pc_val->payment_methods_id; ?>"><?php echo $pc_val->method_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                    </select>
                              </div>
                          
                             <div class="col-md-6 col-sm-6">
                                <label>Reference </label><span class="text-danger"</span>
                                <input type="text" class="form-control" name="reference" value="">           
                             </div>
                         </div>
                      </div>
               <div class="row">
                         <div class="form-group">
                             <div class="col-md-12 col-sm-12">
                                <label>Notes </label><span class="text-danger"></span>
                      <textarea class="form-control" rows="5"  name="notes" ></textarea>            
                             </div>
                         </div>
                      </div>
                    <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Attechment </label><span class="text-danger"></span>
                                 <input type="file" name="attachement[]">            
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                                 <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                              </div>
                           </div>
                        </div>
                        <div id="TextBoxesGroup"></div>
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
            <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
            </div>
            <div class="col-md-1">
            <a href="<?php echo base_url();?>transactions/transfer" type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</a>
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
   
   
   function getTransferList(from_account_id)
   {
       var str = 'from_account_id='+from_account_id;
       var PAGE = '<?php echo base_url(); ?>transactions/getTransferToaccountList';
       
       jQuery.ajax({
           type :"POST",
           url  :PAGE,
           data : str,
           success:function(data)
           {   
          // console.log(data)  ;return false;      
               if(data)
               {
                   $('#to_account_id').html(data);
               }
               else
               {
                   $('#to_account_id').html('<option value=""></option>');
               }
           } 
       });
   }
   
   // Add Extra Contact Persons
   
   $(document).ready(function()
   {
   
   var counter = 0;
   $("#extra_contact").click(function () {
      $('#removeContact').show();
      
           var newTextBoxDiv = $(document.createElement('div'))
           .attr("id", 'TextBoxDiv' + counter);
           newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Contact Name </label><span class="text-danger"></span>'+'<input required="required" type="text" name="other_contact_name[]" class="form-control"  value=""></div>'+'<div class="col-md-6 col-sm-6"><label>Email </label><span class="text-danger"> *</span><input required="required" type="text" name="other_email[]" class="form-control"  value=""></div></div></div>'+'<div class="row">'+'<div class="form-group"><div class="col-md-6 col-sm-6"><label>Designation</label><span class="text-danger"> *</span><input required="required" type="text" name="other_designation[]" class="form-control" value=""></div>'+'<div class="col-md-6 col-sm-6"><label>Mobile </label><span class="text-danger"> *</span><input required="required" type="text" name="other_mobile[]" class="form-control"></div></div></div><br>'); 
   
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
   
</script>

   
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