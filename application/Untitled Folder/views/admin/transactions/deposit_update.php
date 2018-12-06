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
      <h1>Deposit <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>transactions/deposit">Deposit</a></li>
         <li class="active">Deposit Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Deposit</strong>
               <div class="pull-right box-tools">
                  <a href="<?php echo base_url();?>transactions/deposit" class="btn btn-teal btn-sm">Back</a>                           
               </div>
            </div>
            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>
                  <?php
                     foreach ($edit_deposit as $res) 
                     {
                     ?>
                 <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Accounts<span class="text-danger"> *</span></label>
                                <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="account_id" required="" tabindex="-1" aria-hidden="true">
                                <?php
                                       foreach ($account_details as $ec_val) 
                                       {
                                          ?>
                                         <option <?php if($ec_val->account_id == $res->account_id){ echo "selected"; } ?> value="<?php echo $ec_val->account_id; ?>"><?php echo $ec_val->account_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                </select> 
                                  <?php echo form_error('account_id','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label>Date <span class="text-danger"> *</span></label>
                                 <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false" name="date" value="<?php echo $res->date; ?>" >    
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label> Amount <span class="text-danger"> *</span></label>
                              <input name="amount" class="form-control" type="text" value="<?php echo $res->amount; ?>"> 
                              <?php echo form_error('amount','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Category <span class="text-danger"> *</span></label>
                                    <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="income_category_id" tabindex="-1" aria-hidden="true" >
                                       <?php
                                       foreach ($income_category as $ic_val) 
                                       {
                                          ?>
                                         <option <?php if($ic_val->income_category_id == $res->category_id){ echo "selected"; } ?> value="<?php echo $ic_val->income_category_id; ?>"><?php echo $ic_val->income_category; ?></option>
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
                                    <option value="">Select a Payer</option>
                                    <?php
                                       foreach ($user_list as $u_val) 
                                       {
                                          ?>
                                         <option <?php if($u_val->user_id == $res->paid_by){ echo "selected"; } ?> value="<?php echo $u_val->user_id; ?>"><?php echo $u_val->user_full_name.'  ('.$u_val->user_type.')'; ?></option>
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
                                         <option  <?php if($pc_val->payment_methods_id == $res->payment_methods_id){ echo "selected"; } ?> value="<?php echo $pc_val->payment_methods_id; ?>"><?php echo $pc_val->method_name; ?></option>
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
                           <a href="<?php echo base_url();?>transactions/deposit"type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</a>
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