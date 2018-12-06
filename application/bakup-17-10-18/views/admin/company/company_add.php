<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Company <small>Control panel</small></h1>   
      <ol class="breadcrumb">
        <br>
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>company">Company</a></li>
            <li class="active">Company Add</li>

        </ol>
</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Add Company</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>company" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>

            <div class="panel-body">
               <form method="post" enctype="multipart/form-data">
                  <fieldset>  
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
                                    <option value="<?= $rl_res->role_id; ?>"><?= $rl_res->role_name; ?></option>
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
                                <input name="company_name" class="form-control" type="text" id="company_name" value="<?php echo set_value('company_name'); ?>" />
                                <?php echo form_error('company_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-4 col-sm-4">
                              <label>Company Email<span class="text-danger"> *</span></label>
                                <input name="company_email" class="form-control" type="text" id="company_email" value="<?php echo set_value('company_email'); ?>" />
                                <?php echo form_error('company_email','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Company Phone<span class="text-danger"> *</span></label>
                                <input name="company_phone" class="form-control" type="text" id="company_phone" value="<?php echo set_value('company_phone'); ?>" />
                                <?php echo form_error('company_phone','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                         </div>
                       </div> 

                       <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Company Budget<span class="text-danger"> *</span></label>
                                <input name="company_budget" class="form-control checkNumFilter" placeholder="0.00" type="text" id="company_budget" value="<?php echo set_value('company_budget'); ?>" />
                                <?php echo form_error('company_budget','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>Leads Per Cost<span class="text-danger"> *</span></label>
                                <input name="quote_per_employee" placeholder="0.00" class="form-control checkNumFilter" type="text" id="quote_per_employee" value="<?php echo set_value('quote_per_employee'); ?>" />
                                <?php echo form_error('quote_per_employee','<span class="text-danger">','</span>'); ?>
                                 <span style="color: red;" id="error_quote_employee"></span>
                           </div>
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Password<span class="text-danger"> *</span></label>
                                <input type="password" name="company_password" class="form-control" id="company_password" value="<?php echo set_value('company_password'); ?>" />
                                <?php echo form_error('company_password','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>Confirm Password<span class="text-danger"> *</span></label>
                                <input type="password" name="company_conf_password" class="form-control" id="company_conf_password" value="<?php echo set_value('company_conf_password'); ?>" />
                                <?php echo form_error('company_conf_password','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Company Image<span class="text-danger"></span></label>
                                <div class="fancy-file-upload fancy-file-primary">
                                  <i class="fa fa-upload"></i>
                                  <input type="file" class="form-control" name="company_img" onchange="jQuery(this).next('input').val(this.value);">
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
                                <input name="company_city" class="form-control" type="text" id="company_city" value="<?php echo set_value('company_city'); ?>" />
                                <?php echo form_error('company_city','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                            <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control"  name="company_country_id" id="company_country_id" onchange="getStateList(this.value)">
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
                                <?php echo form_error('company_country_id','<span class="text-danger">','</span>'); ?>
                             </div>
                             <div class="col-md-4 col-sm-4">
                              <label>State<span class="text-danger">*</span></label>
                                <select class="form-control"  name="company_state_id" id="company_state_id">
                                    <option value="">Select State</option>
                                </select>
                                <?php echo form_error('company_state_id','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                        </div> 
                      <div class="row">
                         <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_zip_code" value="<?php echo set_value('company_zip_code'); ?>"  >
                                <?php echo form_error('company_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>Address<span class="text-danger">*</span></label>
                               <textarea name="company_address" class="form-control"></textarea>
                                <?php echo form_error('company_address','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Company Website<span class="text-danger"></span></label>
                                <input type="text" name="company_website" placeholder="http://your-companysite.com" value="<?php echo set_value('company_website'); ?>" class="form-control">
                                <?php echo form_error('company_website','<span class="text-danger">','</span>'); ?>
                            </div>
                           
                         </div>
                       </div>                     
                        <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                              <label>Currency type</label>
                              <select name="company_currency_type" class="form-control">
                                  <option value="INR">INR</option>
                              </select>
                            </div>
                              <div class="col-md-4 col-sm-4">
                               <label>Fax Number</label>
                                <input name="company_fax" class="form-control" type="text" id="company_fax" value="<?php echo set_value('company_fax'); ?>" />
                                  <?php echo form_error('company_fax','<span class="text-danger">','</span>'); ?>             
                            </div> 
                            <div class="col-md-4 col-sm-4">
                             <label>Company Status<span class="text-danger">*</span></label>
                                <select name="company_status" id="company_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                                <input type="text" name="company_skype_id" value="<?php echo set_value('company_skype_id'); ?>" class="form-control">
                                <?php echo form_error('company_skype_id','<span class="text-danger">','</span>'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Facebook Url</label>
                                <input name="company_fb_id" class="form-control" type="text" id="company_fb_id" value="<?php echo set_value('company_fb_id'); ?>" />
                                  <?php echo form_error('company_fb_id','<span class="text-danger">','</span>'); ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                              <label>Twitter Id</label>
                                <input name="company_twitter_id" class="form-control" type="text" id="company_twitter_id" value="<?php echo set_value('company_twitter_id'); ?>" />
                                  <?php echo form_error('company_twitter_id','<span class="text-danger">','</span>'); ?>
                            </div>
                          </div>
                         </div>

                         <div class="row">
                         <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                               <label>Linkedin Url</label>
                                <input name="company_linkedin_url" class="form-control" type="text" id="company_linkedin_url" value="<?php echo set_value('company_linkedin_url'); ?>" />
                                  <?php echo form_error('company_linkedin_url','<span class="text-danger">','</span>'); ?>             
                            </div> 
                          
                            <div class="col-md-6 col-sm-6">
                              <label>Company Short Note<span class="text-danger">*</span></label>
                               <textarea name="company_short_note" class="form-control"></textarea>
                                <?php echo form_error('company_short_note','<span class="text-danger">','</span>'); ?>
                           </div>
                           
                          </div>
                         </div>
                  </fieldset>
                  <div class="row">
                     <div class="col-md-1">
                        <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                       <a href="<?php echo base_url();?>company"><button type="button" class="btn btn-danger margin-top-30" >Cancel</button>
                     </a></div>
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