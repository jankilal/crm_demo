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
      <h1>Answerd <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>tickets/Closed">Answerd</a></li>
         <li class="active">Answerd Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Answerd</strong>
               <div class="pull-right box-tools">
                  <a href="<?php echo base_url();?>tickets/Closed" class="btn btn-teal btn-sm">Back</a>                           
               </div>
            </div>
            <div class="panel-body">
               <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>
                  <?php
                     foreach ($edit_closed as $res) 
                     {
                     ?>
                 
                 <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Ticket Code<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="ticket_code" value="<?php echo $res->ticket_code; ?>">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Subject <span class="text-danger"> *</span></label>
                                 <input type="text" class="form-control" name="subject" value="<?php echo $res->subject; ?>" >    
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label> Reporter  <span class="text-danger"> *</span></label>
                                 <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="reporter" tabindex="-1" aria-hidden="true" >
                                    <?php
                                       foreach ($user_list as $uc_val) 
                                       {
                                          ?>
                                          <option <?php if($uc_val->user_id == $res->reporter){ echo "selected"; } ?> value="<?php echo $uc_val->user_id; ?>"><?php echo $uc_val->user_full_name.'  ('.$uc_val->user_type.')'; ?></option>
                                        <?php 
                                         
                                       }
                                       ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-6 col-sm-6">
                                    <label>Priority<span class="text-danger"> *</span></label>
                                        <select name="priority" class="form-control">
                                          <option value="High">High</option>
                                          <option value="medium">Medium</option>
                                          <option value="low">Low</option>
                                        </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label> Department  <span class="text-danger"> *</span></label>
                                 <select class="form-control select_box select2-hidden-accessible" style="width: 100%" name="departments_id" tabindex="-1" aria-hidden="true" >
                                    <?php
                                       foreach ($department_list as $dp_val) 
                                       {
                                          ?>
                                           <option <?php if($dp_val->departments_id == $res->departments_id){ echo "selected"; } ?> value="<?php echo $dp_val->departments_id; ?>"><?php echo $dp_val->deptname; ?></option>
                                          <?php 
                                       }
                                       ?>
                                 </select>
                              </div>
                            </div>
                        </div>
                         <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                <label>Ticket Message </label><span class="text-danger"> *</span>
                                 <textarea class="form-control" rows="5"  name="comment" ><?php echo $res->comment; ?></textarea>           
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