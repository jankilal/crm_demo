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
      <h1>TransactionsReports <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>transactions/transactionsReport">TransactionsReports</a></li>
         <li class="active">TransactionsReports Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add TransactionsReports</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>transactions/transactionsReport" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Accounts<span class="text-danger"> *</span></label>
                                <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="account_id" required="" tabindex="-1" aria-hidden="true">
                                <?php
                                       foreach ($account_details as $ac_val) 
                                       {
                                          ?>
                                         <option value="<?php echo $ac_val->account_id; ?>"><?php echo $ac_val->account_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                </select> 
                                  <?php echo form_error('account_id','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label>Date <span class="text-danger"> *</span></label>
                                 <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="date" >    
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label> Amount <span class="text-danger"> *</span></label>
                              <input name="amount" class="form-control" type="text" value=""> 
                              <?php echo form_error('amount','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Category <span class="text-danger"> *</span></label>
                                    <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="income_category_id" tabindex="-1" aria-hidden="true" >
                                       <?php
                                       foreach ($income_category as $ec_val) 
                                       {
                                          ?>
                                         <option value="<?php echo $ec_val->income_category_id; ?>"><?php echo $ec_val->income_category; ?></option>
                                        <?php 
                                       }
                                       ?>
                                    </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label> Paid By <span class="text-danger"> *</span></label>
                                  <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="paid_by" tabindex="-1" aria-hidden="true" >
                                    <?php
                                       foreach ($user_list as $uc_val) 
                                       {
                                          ?>
                                         <option value="<?php echo $uc_val->user_id; ?>"><?php echo $uc_val->user_full_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                  </select>
                           </div>
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Payment Method <span class="text-danger"> *</span></label>
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
                           </div>
                        </div>
                     </div>
                      <div class="row">
                         <div class="form-group">
                             <div class="col-md-12 col-sm-12">
                                <label>Reference </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" name="reference" value="">           
                             </div>
                         </div>
                      </div>
               <div class="row">
                         <div class="form-group">
                             <div class="col-md-12 col-sm-12">
                                <label>Notes </label><span class="text-danger"> *</span>
                      <textarea class="form-control" rows="5"  name="notes" ></textarea>            
                             </div>
                         </div>
                      </div>
                      <div class="row">
                           <div class="form-group">
                               <div class="col-md-12 col-sm-12">
                                 <label>Attechment </label><span class="text-danger"> *</span>
                                 <input type="file" name="attachement[]">            
                              </div>
                         </div>     
                     </div>
                 <button id="add_produst_btn" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add More</button>
                        <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                             <div id="TextBoxesGroup"></div></div>                  
            <div class="row">
            <div class="col-md-1">
            <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
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

<script type="text/javascript">
 $(document).ready(function()
 {

    var counter = 0;
    $("#add_produst_btn").click(function () {
       $('#removeButton').show();
       
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);

            newTextBoxDiv.after().html('<div class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label style="margin-bottom: 10px;">Attachment File</label><br><br><br></div></div><div class="form-group"><div class="col-md-6 col-sm-6"><input type="file" multiple="multiple" name="attachement'+counter+'[]"></div></div></div>');
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