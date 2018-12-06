<section id="middle">
<!-- page title -->
<header id="page-header">
   <h1>Profile <small>Control panel</small></h1>
   
       <ol class="breadcrumb">
       <br>
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin">Profile</a></li>
            <li class="active">Profile Edit</li>
        </ol>

</header>
 
<!-- /page title -->
<div id="content" class="padding-20">
   <div class="row">
      <div class="col-md-12">
        
         <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
               <strong>Edit Profile</strong>
                 <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>" class="btn btn-teal btn-sm">Back</a>                           
                </div>
            </div>

            <div class="panel-body">
               <form method="post" onsubmit="return checkProfileUpdate()" enctype="multipart/form-data" data-success="Sent! Thank you!">
                  <fieldset>   
                  <?php
                  foreach ($user_details as $res) 
                  {
                  ?>                
                    
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-4 col-sm-4">
                              <label>Name<span class="text-danger"> *</span></label>
                                <input name="admin_name" class="form-control" type="text" id="admin_name" value="<?php echo $res->user_full_name; ?>" />
                                <?php echo form_error('admin_name','<span class="text-danger">','</span>'); ?>
                           </div> 
                           <div class="col-md-4 col-sm-4">
                              <label>Email<span class="text-danger"> *</span></label>
                                <input name="admin_email" onchange="check_email_address(this.value)" class="form-control" type="text" id="admin_email" value="<?php echo $res->user_email; ?>" />
                                <input type="hidden" id="validate_email">
                                <span style="color: red;" id="error_email"></span>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Phone<span class="text-danger"> *</span></label>
                                <input name="admin_phone" class="form-control" type="text" id="admin_phone" value="<?php echo $res->user_phone; ?>" />
                                <?php echo form_error('admin_phone','<span class="text-danger">','</span>'); ?>
                           </div>
                          
                         </div>
                       </div>
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                              <label>Profile Image</label>
                                <div class="fancy-file-upload fancy-file-primary">
                                  <i class="fa fa-upload"></i>
                                  <input type="file" class="form-control" name="admin_img" onchange="jQuery(this).next('input').val(this.value);">
                                  <input type="text" class="form-control" placeholder="no file selected" readonly="">
                                  <span class="button">Choose File</span>
                                </div>                                
                            </div> 
                        
                          <div class="col-md-4 col-sm-4">
                            <label>Country</label>
                                <select class="form-control"  name="admin_country_id" id="admin_country_id" onchange="getStateList(this.value)">
                                    <option value=""></option>
                                    <?php 
                                        foreach ($country_list as $c_list)
                                        {
                                            ?>
                                            <option <?php if($res->user_country_id == $c_list->country_id){ echo "selected"; } ?> value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>                
                             </div>
                             <div class="col-md-4 col-sm-4">
                               <label>State</label>
                                <select class="form-control"  name="admin_state_id" id="admin_state_id">
                                    <option value=""></option> 
                                    <?php 
                                        foreach ($state_list as $s_list)
                                        {
                                            ?>
                                            <option value="<?php echo $s_list->state_id; ?>" <?php if($res->user_state_id == $s_list->state_id){ echo "selected"; }?>><?php echo $s_list->state_name; ?></option>
                                            <?php
                                        }
                                    ?>                                 
                                </select>
                              
                           </div>
                         </div>
                       </div>                      
                       <div class="row">
                         <div class="form-group"> 
                            <div class="col-md-4 col-sm-4">
                             <label>City<span class="text-danger"> *</span></label>
                                <input name="admin_city" class="form-control" type="text" id="admin_city" value="<?php echo $res->user_city; ?>" />
                                <?php echo form_error('admin_city','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Zip Code</label>
                                <input type="text" class="form-control" placeholder="Zip code" name="admin_zip_code" value="<?php echo  $res->user_zip_code; ?>"  >
                                <?php echo form_error('admin_zip_code','<span class="text-danger">','</span>'); ?>
                           </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Address</label>
                               <textarea name="admin_address" class="form-control"><?php echo $res->user_address; ?></textarea>
                                <?php echo form_error('admin_address','<span class="text-danger">','</span>'); ?>
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
                                    <input type="password" id="admin_new_pass" name="admin_new_pass" value="" class="form-control">
                                     <span style="color: red;" id="error_new_pass"></span>
                                   
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <label>Confirm New Password <span class="text-danger"> *</span></label>
                                    <input name="admin_c_new_pass" class="form-control" type="password" id="admin_c_new_pass" value="" /> 
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
                        <button type="submit" name="Submit" value="Profile" class="btn btn-teal margin-top-30">Submit</button>
                     </div>
                     <div class="col-md-1">
                        <a href="<?php echo base_url();?>admin" ><button type="button" class="btn btn-danger margin-top-30">Cancel</button></a>
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
  function checkProfileUpdate()
  {

   if($('#admin_email').val() == "")
    {         
       $('#error_email').html('Email is required *');
       $("#admin_email").focus();
       return false;
    }
    else
    {      
          if($('#validate_email').val() == '1')
          {
            $('#error_email').html('This email is already ragistered!.');
            $("#admin_email").focus();           
            return false;
          }    
          else
          {
            $('#error_email').html('');

          } 
    }
    if($('#check_change_password').val() == '1')
    {
      if($('#admin_new_pass').val() == "")
      {         
         $('#error_new_pass').html('Password is required *');
         $("#admin_new_pass").focus();
         return false;
      }
      else
      {
        $('#error_new_pass').html('');
      }
      if($('#admin_c_new_pass').val() == "")
      {       
          $('#error_c_new_pass').html('Please enter your confirm Password.');
          $("#admin_c_new_pass").focus();       
          return false;     
      }
      else
      {
          if ($('#admin_c_new_pass').val() == $('#admin_new_pass').val())
          {            
              $('#error_c_new_pass').html('');
              return true;
           
           }
           else
           {            
               $('#error_c_new_pass').html('Password and confirm Password is not match.');
               $("#admin_c_new_pass").focus();
               return false;            
           }      
       }
     }   

  }

  function check_email_address(emailId)
  {
   
    var action_check_emailId = 'check_email';       
        var check_dataString = 'action_check_emailId=' + action_check_emailId + '&user_ragister_email=' + emailId;  
        var check_PAGE = '<?php echo base_url();?>login/checkUserEmailId'; 
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
    $(function () {
       
        $('#emp_dob_i').datetimepicker({
             format: 'Y-M-D'
        });    
    });

    function getStateList(country_id)
    {
        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>login/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#admin_state_id').html(data);
                }
                else
                {
                    $('#admin_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>