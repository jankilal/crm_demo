<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Employee <small>Control panel</small></h1>
   
    <ol class="breadcrumb">
        <br>
        <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>employee">Employee</a></li>
        <li class="active">Employee Add</li>
    </ol>

</header>

<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Add Employee</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>employee" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>
            <div class="panel-body">
               <form method="post"  enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>        
                  <?php
                  $session = $this->session->all_userdata();
                  if(login_role == 1)
                  {
                    ?>           
                      <div class="row">
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
                                <input name="employee_name" class="form-control" type="text" id="employee_name" placeholder="Enter employee name" value="<?php echo set_value('employee_name'); ?>" />
                                <?php echo form_error('employee_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-4 col-sm-4">
                              <label>Employee Email<span class="text-danger"> *</span></label>
                                <input name="employee_email" class="form-control" type="text" id="employee_email" placeholder="Enter employee email" value="<?php echo set_value('employee_email'); ?>" />
                                <?php echo form_error('employee_email','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Employee Phone<span class="text-danger"> *</span></label>
                                <input name="employee_phone" class="form-control" type="text" id="employee_phone" placeholder="Enter employee phone" value="<?php echo set_value('employee_phone'); ?>" />
                                <?php echo form_error('employee_phone','<span class="text-danger">','</span>'); ?>
                           </div>                          
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Password<span class="text-danger"> *</span></label>
                                <input type="password" name="employee_password" class="form-control" id="employee_password" placeholder="Enter employee password" value="<?php echo set_value('employee_password'); ?>" />
                                <?php echo form_error('employee_password','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>Confirm Password<span class="text-danger"> *</span></label>
                                <input type="password" name="employee_conf_password" class="form-control" id="employee_conf_password" placeholder="Enter employee confirm password" value="<?php echo set_value('employee_conf_password'); ?>" />
                                <?php echo form_error('employee_conf_password','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Employee profile<span class="text-danger"></span></label>
                                <div class="fancy-file-upload fancy-file-primary">
                                  <i class="fa fa-upload"></i>
                                  <input type="file" id="employee_img" class="form-control" name="employee_img" onchange="jQuery(this).next('input').val(this.value);">
                                  <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                  <span class="button">Choose File</span>
                                </div>                                
                            </div> 
                         </div>
                       </div>                      
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                             <label>City<span class="text-danger"> *</span></label>
                                <input name="employee_city" class="form-control" type="text" id="employee_city" placeholder="Enter employee city" value="<?php echo set_value('employee_city'); ?>" />
                                <?php echo form_error('employee_city','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                            <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control"  name="employee_country_id" id="employee_country_id" onchange="getStateList(this.value)">
                                    <option value="">Select Country</option>
                                    <?php 
                                        foreach ($country_list as $c_list)
                                        {
                                            ?>
                                            <option value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>                
                             </div>
                             <div class="col-md-4 col-sm-4">
                              <label>State<span class="text-danger">*</span></label>
                                <select class="form-control" name="employee_state_id" id="employee_state_id">
                                    <option value="">Select State</option>
                                </select>
                                <?php echo form_error('employee_state_id','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                        </div> 
                      <div class="row">
                         <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Pin Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_zip_code" name="employee_zip_code" placeholder="Enter employee pin code" value="<?php echo set_value('employee_zip_code'); ?>"  >
                                <?php echo form_error('employee_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                             <label>Employee Status<span class="text-danger">*</span></label>
                                <select name="employee_status" id="employee_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <?php echo form_error('employee_status','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                       </div>                     
                        <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-8 col-sm-8">
                              <label>Address<span class="text-danger">*</span></label>
                               <textarea name="employee_address" placeholder="Enter employee address" id="employee_address" class="form-control"></textarea>
                                <?php echo form_error('employee_address','<span class="text-danger">','</span>'); ?>
                           </div>                        
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
                                <input type="text" id="employee_skype_id" name="employee_skype_id" placeholder="Enter employee skype id" value="<?php echo set_value('employee_skype_id'); ?>" class="form-control">
                                <?php echo form_error('employee_skype_id','<span class="text-danger">','</span>'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Facebook Url</label>
                                <input name="employee_fb_id" class="form-control" type="text" id="employee_fb_id" placeholder="Enter employee facebook url" value="<?php echo set_value('employee_fb_id'); ?>" />
                                  <?php echo form_error('employee_fb_id','<span class="text-danger">','</span>'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Twitter Id</label>
                                <input name="employee_twitter_id" class="form-control" type="text" id="employee_twitter_id" placeholder="Enter employee twitter id" value="<?php echo set_value('employee_twitter_id'); ?>" />
                                  <?php echo form_error('employee_twitter_id','<span class="text-danger">','</span>'); ?>
                            </div>
                          </div>
                         </div>
                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                               <label>Linkedin Url</label>
                                <input name="employee_linkedin_url" class="form-control" type="text" id="employee_linkedin_url" placeholder="Enter employee Linkedin url" value="<?php echo set_value('employee_linkedin_url'); ?>" />
                                  <?php echo form_error('employee_linkedin_url','<span class="text-danger">','</span>'); ?>
                            </div>                           
                            <div class="col-md-8 col-sm-8">
                              <label>Employee Short Note<span class="text-danger">*</span></label>
                               <textarea id="employee_short_note" name="employee_short_note" class="form-control" placeholder="Enter employee short note"></textarea>
                                <?php echo form_error('employee_short_note','<span class="text-danger">','</span>'); ?>
                           </div>                           
                          </div>
                         </div>
                        </div>
                  </fieldset>
                  <div class="row">
                     <div class="col-md-1">
                        <button type="submit" name="Submit" id="submit_employee" value="Add" class="btn btn-teal margin-top-30">Submit</button>
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
