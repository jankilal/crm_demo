<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Company <small>Control panel</small></h1>
   
   <ol class="breadcrumb">
   <br>
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>role">Company</a></li>
            <li class="active">Company Details</li>
        </ol>
            <div id="msg_div">
            
              <?php echo $this->session->flashdata('message');?>
             </div> 

</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Company Details</strong>
            </div>  
            <div class="panel-body">
         
            <?php
            if(!empty($company_details))
            {
              foreach ($company_details as $com_val) 
              {
              
              ?>
               <form method="post" enctype="multipart/form-data">
                  <fieldset>                   
                      <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Company Name<span class="text-danger"> *</span></label>
                                <input name="company_name" class="form-control" type="text" id="company_name" value="<?php echo $com_val->company_name; ?>" />
                                <?php echo form_error('company_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>Legal Name<span class="text-danger"> *</span></label>
                                <input name="company_legal_name" class="form-control" type="text" id="company_legal_name" value="<?php echo $com_val->company_legal_name; ?>" />
                                <?php echo form_error('company_legal_name','<span class="text-danger">','</span>'); ?>
                           </div>                           
                          
                         </div>
                       </div> <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Contact Person<span class="text-danger"> *</span></label>
                                <input name="contact_person" class="form-control" type="text" id="contact_person" value="<?php echo $com_val->company_contact_person; ?>" />
                                <?php echo form_error('contact_person','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>Company Address<span class="text-danger"> *</span></label>
                                <input name="company_address" class="form-control" type="text" id="company_address" value="<?php echo $com_val->company_address; ?>" />
                                <?php echo form_error('company_address','<span class="text-danger">','</span>'); ?>
                           </div>                           
                          
                         </div>
                       </div> <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Country<span class="text-danger"> *</span></label>
                              <select name="company_country_id" class="form-control" onchange="getStateList(this.value)">
                               <option value="">Select Country</option>
                                  <?php foreach ($country_list as $c_val) 
                                  {
                                    ?>
                                    <option <?php if($com_val->company_country_id == $c_val->country_id){ echo "selected"; } ?> value="<?php echo $c_val->country_id; ?>"><?php echo $c_val->country_name; ?></option>
                                    <?php
                                  }
                                   ?>
                              </select>
                                <?php echo form_error('company_country_id','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>State<span class="text-danger"> *</span></label>
                              <select name="company_state_id" id="company_state_id" class="form-control">
                                <?php 
                                $state_list = $this->settings_model->getStateListByCountryId($com_val->company_country_id);
                                 if(isset($state_list) && !empty($state_list))
                                 {
                                    foreach ($state_list as $s_list)
                                    {
                                      ?>
                                      <option value="<?php echo $s_list->state_id; ?>" <?php if($com_val->company_state_id == $s_list->state_id){ echo "selected"; }?>><?php echo $s_list->state_name; ?></option>
                                    <?php
                                    }
                                  }
                                  else
                                  {
                                    ?>
                                    <option value=""></option>
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
                         <div class="col-md-6 col-sm-6">
                              <label>City<span class="text-danger"> *</span></label>
                                <input name="company_city" class="form-control" type="text" id="company_city" value="<?php echo $com_val->company_city; ?>" />
                                <?php echo form_error('company_city','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>Zip Code<span class="text-danger"> *</span></label>
                                <input name="company_zip_code" class="form-control" type="text" id="company_zip_code" value="<?php echo $com_val->company_zip_code; ?>" />
                                <?php echo form_error('company_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                       </div> 
                       <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Company Email<span class="text-danger"> *</span></label>
                                <input name="company_email" class="form-control" type="text" id="company_email" value="<?php echo $com_val->company_email; ?>" />
                                <?php echo form_error('company_email','<span class="text-danger">','</span>'); ?>
                           </div> 
                            <div class="col-md-6 col-sm-6">
                              <label>Company Phone<span class="text-danger"> *</span></label>
                                <input name="company_phone" class="form-control" type="text" id="company_phone" value="<?php echo $com_val->company_phone; ?>" />
                                <?php echo form_error('company_phone','<span class="text-danger">','</span>'); ?>
                           </div>                 
                          
                          </div>
                       </div> 

                       <div class="row">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                              <label>Company Website<span class="text-danger"> *</span></label>
                                <input name="company_website" class="form-control" type="text" id="company_website" value="<?php echo $com_val->company_website; ?>" />
                                <?php echo form_error('company_website','<span class="text-danger">','</span>'); ?>
                           </div>             
                          <div class="col-md-6 col-sm-6">
                              <label>Company VAT<span class="text-danger"> *</span></label>
                                <input name="company_vat" class="form-control" type="text" id="company_vat" value="<?php echo $com_val->company_vat; ?>" />
                                <?php echo form_error('company_vat','<span class="text-danger">','</span>'); ?>
                           </div> 

                          </div>
                       </div>    
                               
                  </fieldset>
                  <div class="row">
                     <div class="col-md-2">
                        <button type="submit" name="Submit" value="Edit" class="btn btn-teal margin-top-30">Save Changes</button>
                     </div>
                     <div class="col-md-1">
                        <button type="submit" class="btn btn-danger margin-top-30">Cancel</button>
                     </div>
                  </div>
               </form>

             <?php
                 }
              }
              else
              {
                ?>
                <form method="post" enctype="multipart/form-data">
                  <fieldset>                   
                      <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Company Name<span class="text-danger"> *</span></label>
                                <input name="company_name" class="form-control" type="text" id="company_name" value="<?php  ?>" />
                                <?php echo form_error('company_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>Legal Name<span class="text-danger"> *</span></label>
                                <input name="company_legal_name" class="form-control" type="text" id="company_legal_name" value="<?php echo set_value('company_legal_name'); ?>" />
                                <?php echo form_error('company_legal_name','<span class="text-danger">','</span>'); ?>
                           </div>
                         </div>
                       </div> 
                       <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Contact Person<span class="text-danger"> *</span></label>
                                <input name="contact_person" class="form-control" type="text" id="contact_person" value="<?php echo set_value('contact_person'); ?>" />
                                <?php echo form_error('contact_person','<span class="text-danger">','</span>'); ?>
                            </div> 
                            <div class="col-md-6 col-sm-6">
                              <label>Company Address<span class="text-danger"> *</span></label>
                                <input name="company_address" class="form-control" type="text" id="company_address" value="<?php echo set_value('company_address'); ?>" />
                                <?php echo form_error('company_address','<span class="text-danger">','</span>'); ?>
                            </div>
                         </div>
                       </div> 
                       <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Country<span class="text-danger"> *</span></label>
                              <select name="company_country_id" class="form-control" onchange="getStateList(this.value)">
                               <option value="">Select Country</option>
                                  <?php foreach ($country_list as $c_val) 
                                  {
                                    ?>
                                    <option value="<?php echo $c_val->country_id; ?>"><?php echo $c_val->country_name; ?></option>
                                    <?php
                                  }
                                   ?>
                              </select>
                                <?php echo form_error('company_country_id','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-6 col-sm-6">
                              <label>State<span class="text-danger"> *</span></label>
                                <select name="company_state_id" id="company_state_id" class="form-control"> 
                                   <option value=""></option>
                                </select>
                                <?php echo form_error('company_state_id','<span class="text-danger">','</span>'); ?>
                           </div>                          
                         </div>
                       </div>
                        <div class="row">
                         <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>City<span class="text-danger"> *</span></label>
                                <input name="company_city" class="form-control" type="text" id="company_city" value="<?php echo set_value('company_city'); ?>" />
                                <?php echo form_error('company_city','<span class="text-danger">','</span>'); ?>
                            </div>  
                            <div class="col-md-6 col-sm-6">
                              <label>Zip Code<span class="text-danger"> *</span></label>
                                <input name="company_zip_code" class="form-control" type="text" id="company_zip_code" value="<?php echo set_value('company_zip_code'); ?>" />
                                <?php echo form_error('company_zip_code','<span class="text-danger">','</span>'); ?>
                            </div>
                         </div>
                       </div> 
                       <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Company Email<span class="text-danger"> *</span></label>
                                <input name="company_email" class="form-control" type="text" id="company_email" value="<?php echo set_value('company_email'); ?>" />
                                <?php echo form_error('company_email','<span class="text-danger">','</span>'); ?>
                            </div> 
                            <div class="col-md-6 col-sm-6">
                              <label>Company Phone<span class="text-danger"> *</span></label>
                                <input name="company_phone" class="form-control" type="text" id="company_phone" value="<?php echo set_value('company_phone'); ?>" />
                                <?php echo form_error('company_phone','<span class="text-danger">','</span>'); ?>
                            </div> 
                          </div>
                       </div> 
                       <div class="row">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6">
                              <label>Company Website<span class="text-danger"> *</span></label>
                                <input name="company_website" class="form-control" type="text" id="company_website" value="<?php echo set_value('company_website'); ?>" />
                                <?php echo form_error('company_website','<span class="text-danger">','</span>'); ?>
                           </div>             
                          <div class="col-md-6 col-sm-6">
                              <label>Company VAT<span class="text-danger"> *</span></label>
                                <input name="company_vat" class="form-control" type="text" id="company_vat" value="<?php echo set_value('company_vat'); ?>" />
                                <?php echo form_error('company_vat','<span class="text-danger">','</span>'); ?>
                           </div>
                          </div>
                       </div>  
                  </fieldset>
                    <div class="row">
                     <div class="col-md-2">
                        <button type="submit" name="Submit" value="Add" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                        <button type="submit" class="btn btn-danger margin-top-30">Cancel</button>
                     </div>
                   </div>
               </form>
                <?php
              }
            ?>      
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
        var PAGE = '<?php echo base_url(); ?>employee/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#company_state_id').html(data);
                }
                else
                {
                    $('#company_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>