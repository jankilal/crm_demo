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
         <li class="active">Transfer Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Transfer</strong>
               <div class="pull-right box-tools">
                  <a href="<?php echo base_url();?>transactions/transfer" class="btn btn-teal btn-sm">Back</a>                           
               </div>
            </div>
            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>
                  <?php
                     foreach ($edit_transfer as $res) 
                     {
                     ?>
                 <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label> Form Accounts<span class="text-danger"> *</span></label>
                                <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="from_account_id"  tabindex="-1" aria-hidden="true">
                                <?php
                                       foreach ($account_details as $ac_val) 
                                       {
                                          ?>
                                         <option <?php if($ac_val->account_id == $res->from_account_id){ echo "selected"; } ?> value="<?php echo $ac_val->account_id; ?>"><?php echo $ac_val->account_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                </select> 
                                  <?php echo form_error('from_account_id','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-6 col-sm-6">
                              <label> To Accounts<span class="text-danger"> *</span></label>
                                <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="to_account_id"  tabindex="-1" aria-hidden="true">
                                <?php
                                       foreach ($account_details as $ac_val) 
                                       {
                                          ?>
                                         <option <?php if($ac_val->account_id == $res->to_account_id){ echo "selected"; } ?> value="<?php echo $ac_val->account_id; ?>"><?php echo $ac_val->account_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                </select> 
                                  <?php echo form_error('to_account_id','<span class="text-danger">','</span>'); ?>
                           </div>
                            </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Date <span class="text-danger"> *</span></label>
                                 <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="transfer_date" value="<?php echo $res->transfer_date; ?>" >    
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label> Amount <span class="text-danger"> *</span></label>
                              <input name="amount" class="form-control" type="text" value="<?php echo $res->amount; ?>"> 
                              <?php echo form_error('amount','<span class="text-danger">','</span>'); ?>
                           </div>
                            </div>
                      </div>
                           <div class="row">
                             <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Payment Method <span class="text-danger"> *</span></label>
                                    <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="payment_methods_id" tabindex="-1" aria-hidden="true" >
                                        <?php
                                       foreach ($payment_methode as $pc_val) 
                                       {
                                          ?>
                                         <option  <?php if($pc_val->payment_methods_id == $res->payment_methods_id){ echo "selected"; } ?> value="<?php echo $pc_val->payment_methods_id; ?>"><?php echo $pc_val->method_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                    </select>
                              </div>
                             <div class="col-md-6 col-sm-6">
                                <label>Reference </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" name="reference" value="<?php echo $res->reference; ?>"">           
                             </div>
                         </div>
                      </div>
               <div class="row">
                         <div class="form-group">
                             <div class="col-md-12 col-sm-12">
                                <label>Notes </label><span class="text-danger"> *</span>
                      <textarea class="form-control" rows="5"  name="notes" ><?php echo $res->notes; ?>"</textarea>            
                             </div>
                         </div>
                      </div>
                      <div class="row">
                           <div class="form-group">
                               <div class="col-md-12 col-sm-12">
                                 <label>Attechment </label><span class="text-danger"> *</span>
                                 <input type="file" name="attachement" >            
                              </div>
                         </div>
                      </div>

                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                          <a href="<?php echo base_url();?>transactions/transfer" type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</a>
                        </div>
                     </div>
                     <?php
                        }
                        ?>
                  </fieldset>
                </form>
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