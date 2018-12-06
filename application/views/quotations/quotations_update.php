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
      <h1>leads <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>leads">leads</a></li>
         <li class="active">leads Edit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Edit leads</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>leads" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                     <?php
                     foreach ($edit_leads as $res) 
                     {
                     ?>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>leads Title<span class="text-danger"> *</span></label>
                                 <input name="leads_name" class="form-control" type="text" id="leads_name" value="<?php echo $res->lead_name; ?>" />
                                 <?php echo form_error('leads_name','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Client<span class="text-danger"> *</span></label>
                                 <select name="client_id" class="form-control">
                                    <option value="">Select client</option>
                                    <?php
                                       foreach ($client_list as $cl_val) 
                                       {
                                        ?>
                                        <option <?php if($cl_val->user_id == $res->client_id){ echo "selected"; } ?> value="<?php echo $cl_val->user_id; ?>"><?php echo $cl_val->user_full_name; ?></option>
                                        <?php 
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('client_id','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6 project">
                                 <label>Leads Source</label>
                                 <select name="lead_source_id" class="form-control">
                                    <option value="">Select source</option>
                                    <?php
                                       foreach ($leads_source as $lso_val) 
                                       {
                                          ?>
                                         <option <?php if($lso_val->lead_source_id == $res->lead_source_id){ echo "selected"; } ?> value="<?php echo $lso_val->lead_source_id; ?>"><?php echo $lso_val->lead_source; ?></option>
                                        <?php 
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('lead_source_id','<span class="text-danger">','</span>'); ?>             
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Leads Status</label>
                                 <select name="lead_status_id" class="form-control">
                                    <option value="">Select status</option>
                                    <?php
                                       foreach ($lead_status as $lst_val) 
                                       {
                                          ?>
                                          <option <?php if($lst_val->lead_status_id == $res->lead_status_id){ echo "selected"; } ?> value="<?php echo $lst_val->lead_status_id; ?>"><?php echo $lst_val->lead_status.' ('.$lst_val->lead_type.')'; ?></option>
                                          <?php 
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('lead_status_id','<span class="text-danger">','</span>'); ?>             
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Organization </label>
                                 <input type="text"  value="<?php echo $res->organization; ?>" name="organization" class="form-control">     
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Contact Name </label><span class="text-danger"> *</span>
                                 <input type="text" name="contact_name" class="form-control"  value="<?php echo $res->contact_name; ?>">
                                 <?php echo form_error('contact_name','<span class="text-danger">','</span>'); ?>             
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Email </label><span class="text-danger"> *</span>
                                 <input type="text" name="email" class="form-control"  value="<?php echo $res->email; ?>">
                                 <?php echo form_error('email','<span class="text-danger">','</span>'); ?>                          
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Phone </label><span class="text-danger"> *</span>
                                 <input type="text" name="phone" class="form-control" value="<?php echo $res->phone; ?>">
                                 <?php echo form_error('phone','<span class="text-danger">','</span>'); ?>                               
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Mobile </label><span class="text-danger"> *</span>
                                 <input type="text" name="mobile" class="form-control" value="<?php echo $res->mobile; ?>" >
                                 <?php echo form_error('mobile','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>City </label><span class="text-danger"> *</span>
                                 <input type="text" name="city" class="form-control" value="<?php echo $res->city; ?>" >
                                 <?php echo form_error('city','<span class="text-danger">','</span>'); ?> 
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Country </label>
                                 <select class="form-control"  name="country_id" id="country_id" onchange="getStateList(this.value)">
                                    <option value=""></option>
                                    <?php 
                                       foreach ($country_list as $c_list)
                                       {
                                           ?>
                                        <option <?php if($res->country == $c_list->country_id){ echo "selected"; }?> value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                       <?php
                                       }
                                       ?>
                                 </select>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>State</label>
                                 <select class="form-control"  name="state_id" id="state_id">
                                    <option value=""></option>
                                     <option value=""></option> 
                                    <?php 
                                        foreach ($state_list as $s_list)
                                        {
                                            ?>
                                            <option value="<?php echo $s_list->state_id; ?>" <?php if($res->state == $s_list->state_id){ echo "selected"; }?> ><?php echo $s_list->state_name; ?></option>
                                            <?php
                                        }
                                    ?>        
                                 </select>
                                 <?php echo form_error('state_id','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                         <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Address </label>
                                 <textarea name="address" class="form-control"><?php echo $res->address; ?></textarea>
                                 <?php echo form_error('address','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Facebook URL </label>
                                 <input type="text" name="facebook" class="form-control" value="<?php echo $res->facebook; ?>">
                                 <?php echo form_error('facebook','<span class="text-danger">','</span>'); ?> 
                              </div>
                           </div>
                        </div>     

                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Skype id </label>
                                 <input type="text" name="skype" class="form-control" value="<?php echo $res->skype; ?>">
                                 <?php echo form_error('skype','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Twitter URL </label>
                                 <input type="text" name="skype" class="form-control" value="<?php echo $res->twitter; ?>">
                                 <?php echo form_error('twitter','<span class="text-danger">','</span>'); ?> 
                              </div>
                           </div>
                        </div>

                           <div class="row">
                           <div class="form-group">   
                              <div class="col-md-12 col-sm-12">
                                 <label style="padding-top: 3px;">Assigned To  <span class="text-danger"> *</span></label><br>
                                 <label class="radio">
                                 <input type="radio" <?php if($res->permission == '1'){ echo "checked"; } ?> name="permission" value="1">
                                 <i></i>&nbsp;<span>Everyone</span></label>
                                 <i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="who have permission for this menu and all admin user."></i><br>
                                 <label class="radio">
                                 <input type="radio" name="permission" value="0" <?php if($res->permission == '0'){ echo "checked"; } ?> >
                                 <i></i>&nbsp;<span>Customize Permission</span>
                                 </label><i title="" class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" data-original-title="Select a individual permission . individually edit delete action"></i>
                                 <?php echo form_error('permission','<span class="text-danger">','</span>'); ?>
                                  <div id="permission_user" >
                                     <label for="field-1" class="control-label">Select Users <span class="text-danger">*</span></label>
                                     <?php
                                     foreach ($all_users_list as $usr_val) 
                                     {
                                     ?>
                                     <div class="col-md-12">
                                     <div class="row">
                                         <div  class="col-md-5 checkbox c-checkbox needsclick">
                                          <label class="checkbox">
                                             <input type="checkbox" value="<?php echo $usr_val->user_id; ?>" name="assigned_to[]" class="needsclick" data-parsley-multiple="assigned_to" data-parsley-id="30"><i></i> &nbsp;&nbsp;&nbsp;<?php echo $usr_val->user_full_name.'  ('.$usr_val->user_type.') -> '; ?>
                                            </label>
                                         </div>
                                         <div class="action_<?php echo $usr_val->user_id; ?>" id="action_<?php echo $usr_val->user_id; ?>" style="display: none;">              
                                            <label class="checkbox">
                                            <input readonly="" name="view_?php echo $usr_val->user_id; ?>" type="checkbox" value="1">
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
                                </div>
                              </div>
                           </div>
                           <div class="row">
                            <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Short Note</label>
                                 <textarea class="form-control" rows="5" name="notes" ><?php echo $res->notes; ?></textarea>
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