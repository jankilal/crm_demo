<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Employee <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>employee">Employee</a></li>
         <li class="active">Edit Employee</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Edit Employee</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url();?>employee" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" onsubmit="return checkEmployeeUpdate()" enctype="multipart/form-data" data-success="Sent! Thank you!">
                     <fieldset>
                        <?php
                          foreach ($edit_employee as $emp_res) 
                          { 
                          if(login_role == 1)
                          {
                            ?>  
                              <div class="row" id="show_department">
                                 <div class="form-group">
                                    <div class="col-md-12">
                                       <select class="form-control" id="department_id" name="department_id" onchange="enebled_add_employee(this.value)">
                                         <?php
                                            if(!empty($department_list))
                                            {
                                              foreach ($department_list as $dp_val) 
                                              {
                                                ?>
                                                  <option <?php if($emp_res->department_id == $dp_val->departments_id){ echo "selected"; } ?> value="<?php echo $dp_val->departments_id; ?>"><?php echo $dp_val->deptname; ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>                            
                                       </select>
                                    </div>
                                 </div>
                              </div>
                            <?php 
                          }
                          else
                          {
                             ?>
                              <input type="hidden" name="company_id" value="1">
                              <input type="hidden" id="check_company" value="">
                              <div class="row" id="show_department">
                                 <div class="form-group">
                                    <div class="col-md-12">
                                       <select class="form-control" id="department_id" name="department_id" onchange="enebled_add_employee(this.value)">
                                          <option value="">Select Department</option>
                                          <?php
                                            if(!empty($department_list))
                                            {
                                              foreach ($department_list as $dp_val) 
                                              {
                                                ?>
                                                  <option <?php echo set_select('departments_id', $dp_val->departments_id, False); ?> value="<?php echo $dp_val->departments_id; ?>"><?php echo $dp_val->deptname; ?></option>
                                                <?php
                                              }
                                            }
                                            ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                            <?php
                          }
                        ?>  
                        <div class="all_emp_fields">             
                          <div class="row">
                             <div class="form-group">
                                <div class="col-md-4 col-sm-4">
                                   <label>Employee Name<span class="text-danger"> *</span></label>
                                   <input name="employee_name" class="form-control" type="text" id="employee_name" value="<?php echo $emp_res->user_full_name; ?>" />
                                   <?php echo form_error('employee_name','<span class="text-danger">','</span>'); ?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>Employee Email<span class="text-danger"> *</span></label>
                                   <input name="employee_email" onchange="check_email_address(this.value)" class="form-control" type="text" id="employee_email" value="<?php echo $emp_res->user_email; ?>" />
                                   <input type="hidden" id="validate_email">
                                   <span style="color: red;" id="error_email"></span>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>Employee Phone<span class="text-danger"> *</span></label>
                                   <input name="employee_phone" class="form-control" type="text" id="employee_phone" value="<?php echo $emp_res->user_phone; ?>" />
                                   <?php echo form_error('employee_phone','<span class="text-danger">','</span>'); ?>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="form-group">
                                <div class="col-md-2 col-sm-2">
                                   <div class="input text">
                                      <label>Employee Image</label>
                                      <img width="100px" src="<?php echo base_url().''.$emp_res->user_profile_img; ?>">
                                   </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                   <label>Employee Image<span class="text-danger"></span></label>
                                   <div class="fancy-file-upload fancy-file-primary">
                                      <i class="fa fa-upload"></i>
                                      <input type="file" id="employee_img" class="form-control" name="employee_img" onchange="jQuery(this).next('input').val(this.value);">
                                      <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                      <span class="button">Choose File</span>
                                   </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>Country<span class="text-danger">*</span></label>
                                   <select class="form-control"  name="employee_country_id" id="employee_country_id" onchange="getStateList(this.value)">
                                      <option value=""></option>
                                      <?php 
                                         foreach ($country_list as $c_list)
                                         {
                                            ?>
                                              <option <?php if($emp_res->user_country_id == $c_list->country_id){ echo "selected"; } ?> value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                         }
                                         ?>
                                   </select>
                                   <?php echo form_error('employee_country_id','<span class="text-danger">','</span>');?>               
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>State<span class="text-danger">*</span></label>
                                   <select class="form-control"  name="employee_state_id" id="employee_state_id1">
                                      <option value=""></option>
                                      <?php 
                                         foreach ($state_list as $s_list)
                                         {
                                            ?>
                                             <option value="<?php echo $s_list->state_id; ?>" <?php if($emp_res->user_state_id == $s_list->state_id){ echo "selected"; }?>><?php echo $s_list->state_name; ?></option>
                                            <?php
                                         }
                                         ?>                                 
                                   </select>
                                   <?php echo form_error('employee_state_id','<span class="text-danger">','</span>'); ?>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="form-group">
                                <div class="col-md-4 col-sm-4">
                                   <label>City<span class="text-danger"> *</span></label>
                                   <input name="employee_city" class="form-control" type="text" id="employee_city" value="<?php echo $emp_res->user_city; ?>" />
                                   <?php echo form_error('employee_city','<span class="text-danger">','</span>'); ?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>Pin Code<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="employee_zip_code" id="employee_zip_code" value="<?php echo  $emp_res->user_zip_code; ?>"  >
                                   <?php echo form_error('employee_zip_code','<span class="text-danger">','</span>'); ?>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-4 col-sm-4">
                                     <label>Employee Status<span class="text-danger">*</span></label>
                                     <select name="employee_status" id="employee_status" class="form-control">
                                        <option <?php if($emp_res->user_status == '1'){ echo "selected";} ?> value="1">Active</option>
                                        <option value="0" <?php if($emp_res->user_status == '0'){ echo "selected";} ?>>Inactive</option>
                                     </select>
                                     <?php echo form_error('employee_status','<span class="text-danger">','</span>'); ?>
                                  </div>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-md-8 col-sm-8">
                               <label>Address<span class="text-danger">*</span></label>
                               <textarea name="employee_address" id="employee_address" class="form-control"><?php echo $emp_res->user_address; ?></textarea>
                               <?php echo form_error('employee_address','<span class="text-danger">','</span>'); ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                             <div class="alert alert-warning">
                                <h4>Employee Social Details</h4>
                             </div>
                          </div>
                          <div class="row">
                             <div class="form-group">
                                <div class="col-md-4 col-sm-4">
                                   <label>Skype Id<span class="text-danger"></span></label>
                                   <input type="text" id="employee_skype_id" name="employee_skype_id" value="<?php echo $emp_res->user_skype_id;?>" class="form-control">
                                   <?php echo form_error('employee_skype_id','<span class="text-danger">','</span>'); ?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>Facebook Url</label>
                                   <input name="employee_fb_id" class="form-control" type="text" id="employee_fb_id" value="<?php echo $emp_res->user_facebook_url; ?>" />
                                   <?php echo form_error('employee_fb_id','<span class="text-danger">','</span>'); ?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   <label>Twitter Id</label>
                                   <input name="employee_twitter_id" class="form-control" type="text" id="employee_twitter_id" value="<?php echo $emp_res->user_twitter_id; ?>" />
                                   <?php echo form_error('employee_twitter_id','<span class="text-danger">','</span>'); ?>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                             <div class="form-group">
                                <div class="col-md-4 col-sm-4">
                                   <label>Linkedin Url</label>
                                   <input name="employee_linkedin_url" class="form-control" type="text" id="employee_linkedin_url" value="<?php echo $emp_res->user_linkedin_url; ?>" />
                                   <?php echo form_error('employee_linkedin_url','<span class="text-danger">','</span>'); ?>             
                                </div>
                                <div class="col-md-8 col-sm-8">
                                   <label>Employee Short Note<span class="text-danger">*</span></label>
                                   <textarea name="employee_short_note" id="employee_short_note" class="form-control"><?php echo $emp_res->user_short_note; ?></textarea>
                                   <?php echo form_error('employee_short_note','<span class="text-danger">','</span>'); ?>
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
                                      <input type="password" id="employee_new_pass" name="employee_new_pass" value="" class="form-control">
                                      <span style="color: red;" id="error_new_pass"></span>
                                   </div>
                                   <div class="col-md-6 col-sm-6">
                                      <label>Confirm New Password <span class="text-danger"> *</span></label>
                                      <input name="employee_c_new_pass" class="form-control" type="password" id="employee_c_new_pass" value="" /> 
                                      <span style="color: red;" id="error_c_new_pass"></span>
                                   </div>
                                </div>
                             </div>
                          </div>
                        </div>
                        <input type="hidden" id="check_user_id" value="<?php echo $emp_res->user_id; ?>">
                        <?php
                           }
                           ?>
                     </fieldset>
                     <div class="row">
                        <div class="col-md-1">
                           <button type="submit" id="submit_employee" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Submit</button>
                        </div>
                        <div class="col-md-1">
                           <a href="<?php echo base_url();?>employee" ><button type="button" class="btn btn-danger margin-top-30">Cancel</button></a>
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
<script type="text/javascript" src="<?= base_url() ?>webroot/js/form_validation/employee_validation.js"></script>
<script type="text/javascript">
  getStateList();
</script>