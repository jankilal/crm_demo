<style type="text/css">
   .ui-slider-range
   {
   background:green;
   }
   .ui-slider-horizontal .ui-slider-handle
   {
   top: -1px;
   }
   .onRmNewProduct , .onAddNewProduct{
      display: none;
   }
</style>
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Lead <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url('leads');?>">Lead</a></li>
         <li class="active">Lead Add</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-heading panel-heading-transparent">
                  <strong>Add Lead</strong>
                  <div class="pull-right box-tools">
                     <a href="<?php echo base_url('leads');?>" class="btn btn-teal btn-sm">Back</a>                           
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" onsubmit="return onAddLeadData(this)">
                     <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Lead Information</h4>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Lead Title<!-- <span class="text-danger"> *</span> --></label>
                                 <input name="lead_name" placeholder="Enter lead title" class="form-control" type="text" id="lead_name" value="<?php echo set_value('lead_name'); ?>" />
                              </div>
                              <div class="col-md-6 col-sm-6 project">
                                 <label>Lead Source<!-- <span class="text-danger"> *</span> --></label>
                                 <select name="lead_source_id" class="form-control">
                                    <option value="">Select Source</option>
                                    <?php
                                       foreach ($leads_source as $lso_val) 
                                       {

                                          ?>
                                           <option value="<?php echo $lso_val->lead_source_id; ?>"><?php echo $lso_val->lead_source; ?></option>
                                          <?php 
                                       }
                                       ?>
                                 </select>
                                 <?php echo form_error('lead_source_id','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Lead Status<!-- <span class="text-danger"> *</span> --></label>
                                 <select name="lead_status_id" class="form-control">
                                    <option value="">Select Status</option>
                                    <?php
                                      foreach ($lead_status as $lst_val) 
                                      {
                                        ?>
                                        <option value="<?php echo $lst_val->lead_status_id; ?>"><?php echo $lst_val->lead_status.' ('.$lst_val->lead_type.')'; ?></option>
                                        <?php 
                                      }
                                    ?>
                                 </select>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Organization <!-- <span class="text-danger"> *</span> --></label>
                                 <input type="text" placeholder="Enter organization name" value="<?php echo set_value('organization'); ?>" name="organization" class="form-control">     
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-2 col-sm-2">
                                 <label>Salutation </label><!-- <span class="text-danger"> *</span> -->
                                 <select class="form-control" name="salutation" id="salutation">
                                    <option>Select</option>
                                    <option value="Mr">Mr.</option>
                                    <option value="Mrs">Mrs.</option>
                                    <option value="Ms">Ms.</option>
                                    <option value="Dr">Dr.</option>
                                 </select>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                 <label>Name </label><!-- <span class="text-danger"> *</span> -->
                                 <input type="text" placeholder="Enter name" name="name" class="form-control"  value="<?php echo set_value('name'); ?>">           
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Email </label><!-- <span class="text-danger"> *</span> -->
                                 <input type="text" name="email" placeholder="Enter email address" class="form-control"  value="<?php echo set_value('email'); ?>">                       
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Designation </label><!-- <span class="text-danger"> *</span> -->
                                 <input type="text" placeholder="Enter designation" name="designation" class="form-control" value="">
                                 <?php echo form_error('designation','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Phone </label><!-- <span class="text-danger"> *</span> -->
                                 <input type="text" placeholder="Enter phone number" name="phone_number" id="phone_number" class="form-control" value="<?php echo set_value('phone_number'); ?>" >
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Website </label>
                                 <input type="text" name="website" id="website" class="form-control" placeholder="http://www.expamle.com">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Mobile </label>
                                 <input type="text" placeholder="Enter mobile number" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo set_value('mobile_number'); ?>" >
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group"> 
                              <div class="col-md-6 col-sm-6">
                                <label>Industry </label>
                                <select class="form-control" name="industry" id="industry">
                                  <option value="">Select Industry</option>
                                  <option value="ASP (Application Service Provider)">ASP (Application Service Provider)</option>
                                  <option value="Data/Telecom OEM">Data/Telecom OEM</option>
                                  <option value="ERP (Enterprise Resource Planning)">ERP (Enterprise Resource Planning)</option>
                                  <option value="Government/Military">Government/Military</option>
                                  <option value="Large Enterprise">Large Enterprise</option>
                                </select>
                              </div>                            
                              <div class="col-md-6 col-sm-6">
                                 <label>Skype id </label>
                                 <input type="text" name="skype" class="form-control" value="<?php echo set_value('skype'); ?>" placeholder="Enter skype id">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Facebook </label>
                                 <input type="text" name="facebook" placeholder="facebook.com" class="form-control" value="<?php echo set_value('facebook'); ?>">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Twitter </label>
                                 <input type="text" name="twitter" placeholder="@twiiter" class="form-control" value="<?php echo set_value('twitter'); ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Secondary Email </label>
                                 <input type="text" name="sec_email" id="sec_email" class="form-control" value="<?php echo set_value('sec_email'); ?>" placeholder="Enter secondary email">
                              </div>
                              <div class="col-md-3 col-sm-3">
                                 <label>Annual Revenue </label>
                                 <input type="text" name="annual_revenue" class="form-control" value="<?php echo set_value('annual_revenue'); ?>" placeholder="Rs. 0.00">
                              </div>
                              <div class="col-md-3 col-sm-3">
                                <label class="switch switch-round switch-success" style="margin-top: 30px;">
                                  <input type="checkbox" checked="checked" value="1" name="email_opt_out" id="email_opt_out">
                                  <span class="switch-label" data-on="YES" data-off="NO"></span>
                                  <span> Email Opt Out</span>
                                </label>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Address Information</h4>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Country </label>
                                 <!-- <span class="text-danger"> *</span> -->
                                 <select class="form-control"  name="country_id" id="country_id" onchange="getStateList(this.value)">
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
                              <div class="col-md-6 col-sm-6">
                                 <label>State</label><!-- <span class="text-danger"> *</span> -->
                                 <select class="form-control"  name="state_id" id="state_id">
                                    <option value="">Select State</option>
                                 </select>
                                 <?php echo form_error('state_id','<span class="text-danger">','</span>'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                               <label>City </label><!-- <span class="text-danger"> *</span> -->
                               <input type="text" name="city" placeholder="Enter city name" class="form-control" value="<?php echo set_value('city'); ?>" >
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Zip Code</label><!-- <span class="text-danger"> *</span> -->
                                 <input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Enter zip code">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                 <label>Address </label><!-- <span class="text-danger"> *</span> -->
                                 <textarea name="address" class="form-control"><?php echo set_value('address'); ?></textarea>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Description Information</h4>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                 <label>Description</label>
                                 <textarea class="form-control" rows="5" name="notes" ></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Product Information</h4>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-3 col-sm-3">
                                <button type="button" onclick="loadProductModal()" class="btn btn-featured btn-aqua"><span>Select Product</span><i class="fa fa-list"></i></button>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                <button type="button" onclick="openAddProductModal()" class="btn btn-featured btn-dirtygreen"><span>Add Product</span><i class="fa fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                        <div id="load_added_product"></div>
                        <hr>
                       <div class="row">
                          <div class="col-md-12">
                             <button type="submit" name="Submit" value="Add" class="btn btn-3d btn-reveal btn-success"><i class="fa fa-plus"></i><span>Submit</span></button>
                             <a href="<?php echo base_url('leads');?>"><button type="button" class="btn btn-3d btn-reveal btn-danger"><i class="fa fa-arrow-circle-left"></i><span>Cancel</span></button></a>
                          </div>
                       </div>
                      </div>
                    </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

  <!-- Product Modal Section -->
  <div class="modal fade" id="productModal" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Products</h4>
        </div>
          <div class="text-center" id="loading_img">
            <img src="<?= base_url() ?>webroot/images/loaders/7.gif" alt="" />
          </div>
          <div id="load_data"> </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="product_submit" style="display: none;">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <!-- Product Modal Section -->
  <div class="modal fade" id="addProductModal" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" onsubmit="return addNewLeadProduct(this)">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">New Product</h4>
          </div>
          <div id="content" class="padding-20">
               <div class="row">
                  <div class="form-group">
                     <div class="col-md-6 col-sm-6">
                        <label>Item Name<!-- <span class="text-danger"> *</span> --></label>
                        <input name="item_name" class="form-control" type="text" value=""> 
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <label>Unit Price <!-- <span class="text-danger"> *</span> --></label>
                        <input name="unit_price" class="form-control" type="text" value=""> 
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group">
                     <div class="col-md-6 col-sm-6">
                        <label>Quantity <!-- <span class="text-danger"> *</span> --></label>
                        <input name="quantity" class="form-control" type="text" value=""> 
                     </div>                       
                     <div class="col-md-6 col-sm-6">
                        <label>Tax Rate<!-- <span class="text-danger"> *</span> --></label>
                        <select name="item_tax_rate" class="form-control" data-parsley-id="12">
                          <option value="0.00">None</option>
                        </select>
                     </div>
                  </div>
               </div>  
               <div class="row">
                  <div class="form-group">
                    <div class="col-md-12 col-sm-12">
                          <label>Description </label><!-- <span class="text-danger"> *</span> -->
                          <textarea class="form-control" rows="5" id="description"  name="description" ></textarea>
                    </div>
                  </div>
               </div> 
          </div>  
          <div class="modal-footer">
            <button class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /MIDDLE -->
<script type="text/javascript"> 

  var selected_product_array = [];  
  var temp_added_item_arr = []; 
  var sendQute = false;
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
  $(function() 
  {
    $('.switch-btn-change').click(function() 
    {
      alert($(this).children().checked);
    });
  });

  function openAddProductModal()
  {
    reloadTopBar();
    $('#addProductModal').modal('show');
  } 

  function loadProductModal()
  {
    $('#loading_img').fadeIn();
    $('#productModal').modal('show');
    var str = 'action_load_product='+'Load Product'; 
    var PAGE = '<?php echo base_url(); ?>leads/loadProductData';
    jQuery.ajax({
      type :"POST",
      url  :PAGE,
      data : str,
      beforeSend: function( xhr ) {
        reloadTopBar();
      },
      success:function(data)
      {    
        $('#loading_img').fadeOut();       
        $('#load_data').html(data);
        $('#load_data').fadeIn();       
      } 
    });
  }   

  function addNewLeadProduct(obj)
  {      
      var str = '&action_add_product='+'Add Product' + '&ids_array='+JSON.stringify(selected_product_array); 
      var PAGE = '<?php echo base_url(); ?>leads/addNewLeadProduct';
      jQuery.ajax({
        type :"POST",
        url  :PAGE,
        data : $(obj).serialize()+str,
        beforeSend: function( xhr ) {
          reloadTopBar();
        },
        success:function(response)
        {    
          $('#load_added_product').html(response);
          $(obj)[0].reset();
          setNotificationMsg('Product Added Successfully!' , 'success');
        } 
      });  
      return false;
  }

  function onAddLeadData(obj)
  {
    var str = '&action_add_lead='+'Add Lead' + '&selected_products='+JSON.stringify(selected_product_array); 
    var PAGE = '<?php echo base_url(); ?>leads/addLead';
    jQuery.ajax({
      type :"POST",
      url  :PAGE,
      data : $(obj).serialize()+str,
      beforeSend: function( xhr ) {
        reloadTopBar();
      },
      success:function(response)
      {    
        if(response)
        {
          window.location.href="<?= base_url(); ?>leads";
          setNotificationMsg('Lead Added Successfully!' , 'success');
        }
        else
        {
          setNotificationMsg('Something went wrong!' , 'danger');
        }
      } 
    }); 
    return false;
  }
</script>