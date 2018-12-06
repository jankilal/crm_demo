<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Income Category <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>settings/incomeCategory">Income Category</a></li>
         <li class="active">Income Category Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Income Category</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>settings/incomeCategory" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                     <?php
                     foreach ($edit_income_category as $ic_val)
                     {
                     ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Income Category Name<span class="text-danger"> *</span></label>
                                 <input name="income_category" class="form-control" type="text" id="income_category" value="<?php echo $ic_val->income_category; ?>" />
                                 <?php echo form_error('income_category','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Status</label>
                               <select name="income_category_status" class="form-control">
                                 <option <?php if($ic_val->income_category_status == '1'){ echo 'selected'; } ?> value="1">Active</option>
                                 <option <?php if($ic_val->income_category_status == '0'){ echo 'selected'; } ?> value="0">Deactive</option>
                               </select>
                              </div>                             
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Description</label>
                                 <textarea class="form-control" name="description" rows="4"><?php echo $ic_val->description; ?></textarea>
                              </div>
                           </div>
                        </div>
                      <?php
                      }
                      ?>
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
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
   $(function () {
      
       $('#emp_dob_i').datetimepicker({
            format: 'Y-M-D'
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
                   $('#client_state_id').html(data);
               }
               else
               {
                   $('#client_state_id').html('<option value=""></option>');
               }
           } 
       });
   }
</script>