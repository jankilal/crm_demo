<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Company <small>Control panel</small></h1>
      <ol class="breadcrumb">
        <br>
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>company">Company</a></li>
        <li class="active">Company Edit</li>
      </ol>
</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Company</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>company" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>
            <div class="panel-body">
               <form method="post" onsubmit="return checkCompanyUpdate()" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>   
                  <?php
                  foreach ($edit_company as $comp_res) 
                  {
                  ?>
                      <!-- <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Select Role<span class="text-danger"> *</span></label>
                                <select class="form-control" name="role_id" id="role_id">
                                  <option value="">Select Role</option>
                                  <?php
                                  foreach ($role_list as $rl_res) 
                                  {
                                    ?>
                                    <option <?php echo ($comp_res->user_role_id == $rl_res->role_id) ? 'selected' : ''; ?> value="<?= $rl_res->role_id; ?>"><?= $rl_res->role_name; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                                <?php echo form_error('role_id','<span class="text-danger">','</span>'); ?>
                           </div> 
                        </div>
                    </div> -->
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Company Name<span class="text-danger"> *</span></label>
                                <input name="company_name" class="form-control" type="text" id="company_name" value="<?php echo $comp_res->user_full_name; ?>" />
                                <?php echo form_error('company_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-4 col-sm-4">
                              <label>Company Email<span class="text-danger"> *</span></label>
                                <input name="company_email" class="form-control" onchange="check_email_address(this.value)" type="text" id="company_email" value="<?php echo $comp_res->user_email; ?>" />
                               <span style="color: red;" id="error_email"></span>
                                 <input type="hidden" id="validate_email">
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Company Phone<span class="text-danger"> *</span></label>
                                <input name="company_phone" class="form-control" type="text" id="company_phone" value="<?php echo $comp_res->user_phone; ?>" />
                                <?php echo form_error('company_phone','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                         </div>
                       </div>
                       <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Company Budget<span class="text-danger"> *</span></label>
                                <input name="company_budget" class="form-control" placeholder="0.00" type="text" id="company_budget" value="<?php echo $comp_res->company_budget; ?>" />
                                <?php echo form_error('company_budget','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>Leads Per Employee<span class="text-danger"> *</span></label>
                                <input name="quote_per_employee" placeholder="0.00" onchange="checkCompanyAddForm()" class="form-control" type="text" id="quote_per_employee" value="<?php echo $comp_res->quote_per_employee; ?>" />
                                <?php echo form_error('quote_per_employee','<span class="text-danger">','</span>'); ?>
                                 <span style="color: red;" id="error_quote_employee"></span>
                           </div>
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                              <label>Company Image<span class="text-danger"></span></label>
                                <div class="fancy-file-upload fancy-file-primary">
                                  <i class="fa fa-upload"></i>
                                  <input type="file" class="form-control" name="company_img" onchange="jQuery(this).next('input').val(this.value);">
                                  <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                  <span class="button">Choose File</span>
                                </div>                                
                            </div> 
                        
                          <div class="col-md-4 col-sm-4">
                            <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control"  name="company_country_id" id="company_country_id" onchange="getStateList(this.value)">
                                    <option value=""></option>
                                    <?php 
                                        foreach ($country_list as $c_list)
                                        {
                                            ?>
                                            <option <?php if($comp_res->user_country_id == $c_list->country_id){ echo "selected"; } ?> value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>                
                             </div>
                             <div class="col-md-4 col-sm-4">
                               <label>State<span class="text-danger">*</span></label>
                                <select class="form-control"  name="company_state_id" id="company_state_id">
                                    <option value=""></option> 
                                    <?php 
                                        foreach ($state_list as $s_list)
                                        {
                                            ?>
                                            <option value="<?php echo $s_list->state_id; ?>" <?php if($comp_res->user_state_id == $s_list->state_id){ echo "selected"; }?>><?php echo $s_list->state_name; ?></option>
                                            <?php
                                        }
                                    ?>                                 
                                </select>
                                <?php echo form_error('company_state_id','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                       </div>                      
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                             <label>City<span class="text-danger"> *</span></label>
                                <input name="company_city" class="form-control" type="text" id="company_city" value="<?php echo $comp_res->user_city; ?>" />
                                <?php echo form_error('company_city','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_zip_code" value="<?php echo  $comp_res->user_zip_code; ?>"  >
                                <?php echo form_error('company_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Address<span class="text-danger">*</span></label>
                               <textarea name="company_address" class="form-control"><?php echo $comp_res->user_address; ?></textarea>
                                <?php echo form_error('company_address','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                        </div> 
                        </div>
                      <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                              <label>Company Website<span class="text-danger"></span></label>
                                <input type="text" name="company_website" placeholder="http://yourcompanysite.com" value="<?php echo $comp_res->user_website; ?>" class="form-control">
                                <?php echo form_error('company_website','<span class="text-danger">','</span>'); ?>
                            </div>
                             <div class="col-md-4 col-sm-4">
                              <label>Currency type</label>
                             <select name="company_currency_type" class="form-control" data-currency="EUR">                             
                                <option <?php if($comp_res->user_currency_type == 'INR'){ echo "selected"; } ?> value="INR">INR</option>
                              </select>
                            </div>
                             <div class="col-md-4 col-sm-4">
                               <label>Fax Number</label>
                                <input name="company_fax" class="form-control" type="text" id="company_fax" value="<?php echo $comp_res->user_fax; ?>" />
                                  <?php echo form_error('company_fax','<span class="text-danger">','</span>'); ?>             
                            </div> 
                           
                         </div>
                      </div>                     
                        <div class="row">
                         <div class="form-group">
                             
                            <div class="col-md-4 col-sm-4">
                             <label>Company Status<span class="text-danger">*</span></label>
                                <select name="company_status" id="company_status" class="form-control">
                                    <option <?php if($comp_res->user_status == '1'){ echo "selected";} ?> value="1">Active</option>
                                    <option value="0" <?php if($comp_res->user_status == '0'){ echo "selected";} ?>>Inactive</option>
                                </select>
                                <?php echo form_error('company_status','<span class="text-danger">','</span>'); ?>
                           </div>                           
                          </div>
                         </div>
                         <div class="col-md-12">
                         <div class="alert alert-warning">
                        <h4>Company Social Details</h4>
                        </div>                          
                         </div>
                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                              <label>Skype Id<span class="text-danger"></span></label>
                                <input type="text" name="company_skype_id" value="<?php echo $comp_res->user_skype_id;?>" class="form-control">
                                <?php echo form_error('company_skype_id','<span class="text-danger">','</span>'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Facebook Url</label>
                                <input name="company_fb_id" class="form-control" type="text" id="company_fb_id" value="<?php echo $comp_res->user_facebook_url; ?>" />
                                  <?php echo form_error('company_fb_id','<span class="text-danger">','</span>'); ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                              <label>Twitter Id</label>
                                <input name="company_twitter_id" class="form-control" type="text" id="company_twitter_id" value="<?php echo $comp_res->user_twitter_id; ?>" />
                                  <?php echo form_error('company_twitter_id','<span class="text-danger">','</span>'); ?>
                                  <input type="hidden" id="check_user_id" value="<?php echo $comp_res->user_id; ?>">
                            </div>
                          </div>
                         </div>
                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                               <label>Linkedin Url</label>
                                <input name="company_linkedin_url" class="form-control" type="text" id="company_linkedin_url" value="<?php echo $comp_res->user_linkedin_url; ?>" />
                                  <?php echo form_error('company_linkedin_url','<span class="text-danger">','</span>'); ?>             
                            </div> 
                          
                            <div class="col-md-6 col-sm-6">
                              <label>Company Short Note<span class="text-danger">*</span></label>
                               <textarea name="company_short_note" class="form-control"><?php echo $comp_res->user_short_note; ?></textarea>
                                <?php echo form_error('company_short_note','<span class="text-danger">','</span>'); ?>
                           </div>
                           
                        </div>
                        </div>
                        <h5 id="change_pass_btn"><a href="javascript:;" onclick="show_change_password()">Click To Change Password</a></h5>
                         <div id="change_pass" style="display: none;">
                         <input type="hidden" name="check_change_password" id="check_change_password" >
                          <div class="col-md-12">
                            <div class="alert alert-warning">
                             <h4>Change Password</h4>
                            </div>                          
                          </div>
                           <div class="row">
                             <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                  <label>New Password <span class="text-danger">*</span></label>
                                    <input type="password" id="company_new_pass" name="company_new_pass" value="" class="form-control">
                                     <span style="color: red;" id="error_new_pass"></span>
                                   
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <label>Confirm New Password <span class="text-danger"> *</span></label>
                                    <input name="company_c_new_pass" class="form-control" type="password" id="company_c_new_pass" value="" /> 
                                    <span style="color: red;" id="error_c_new_pass"></span>
                                </div>
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
                        <a href="<?php echo base_url();?>company" ><button type="button" class="btn btn-danger margin-top-30">Cancel</button></a>
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
<script type="text/javascript" src="<?= base_url() ?>webroot/js/form_validation/company_validation.js"></script>
<script type="text/javascript">
  function show_change_password()
  {
    $('#change_pass').show();
    $('#check_change_password').val('1');
    $('#change_pass_btn').html('<a href="javascript:;" onclick="cancel_cahange_pass()" >Cancel</a>');
  }

  function cancel_cahange_pass()
  {
    $('#change_pass').hide();
    $('#check_change_password').val('');
    $('#change_pass_btn').html('<a href="javascript:;" onclick="show_change_password()" >Click To Change Password</a>');
  }
  function checkCompanyUpdate()
  {
   if($('#company_email').val() == "")
    {        
       $('#error_email').html('Email is required *');
       $("#company_email").focus();
       return false;
    }
    else
    {      
        if(validateEmail($('#company_email').val()))
        {
          if($('#validate_email').val() == '1')
          {
            $('#error_email').html('This email is already ragistered!.');
            $("#company_email").focus();           
            return false;
          }    
          else
          {
            $('#error_email').html('');
          }
        }
        else
        {
            $('#error_email').html('Please enter Valid email address!.');
            $("#company_email").focus();           
            return false;
        }
    }
  }

  function check_email_address(emailId)
  {
        var user_id = $('#check_user_id').val();
        var action_check_emailId = 'check_email';       
        var check_dataString = 'action_check_emailId=' + action_check_emailId + '&company_ragister_email=' + emailId + '&user_id=' + user_id;  
        var check_PAGE = '<?php echo base_url();?>company/checkCompanyEmailId'; 
          $.ajax({
          type: "POST",
          url: check_PAGE,
          data: check_dataString,
          cache: false,         
          success: function(check_data)
          {
            
            if(check_data == "1")
            {            
              $('#validate_email').val('1');             
              return false;
            }
            else
            {
              $('#error_email').html('');
              $('#validate_email').val('0');             
            }  
           }
          }); 
  }  
</script>
