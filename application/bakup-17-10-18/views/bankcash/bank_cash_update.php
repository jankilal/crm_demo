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
      <h1>Bank&Cash <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>manageAccount">manageAccount</a></li>
         <li class="active">Bank&Cash Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Bank&Cash</strong>
               <div class="pull-right box-tools">
                  <a href="<?php echo base_url();?>manageAccount" class="btn btn-teal btn-sm">Back</a>                           
               </div>
            </div>
            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>
                  <?php
                     foreach ($edit_bankcash as $res) 
                     {
                     ?>
                  
                  <div class="row">
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                           <label>Account Name<span class="text-danger"> *</span></label>
                           <input  type="text" name="account_name" class="form-control" value="<?php echo $res->account_name; ?>"> 
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                           <label>Initial Balance<span class="text-danger"> *</span></label>
                            <input  type="text" name="total_balance" class="form-control" value="<?php echo $res->total_balance; ?>"> 
                        </div>
                     </div>
                  </div>
                  
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Description </label><span class="text-danger"> *</span>    
                                 <textarea class="form-control" rows="5"  name="description" ><?php echo $res->description; ?></textarea>       
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <button type="submit" class="btn btn-danger margin-top-30 margin-left-30">Cancel</button>
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