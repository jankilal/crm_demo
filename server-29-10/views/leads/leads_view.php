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
      <h1>Lead <small>Control panel</small></h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url('leads');?>">Lead</a></li>
         <li class="active">Lead View</li>
      </ol>
   </header>
   <!-- /page title -->
  <form method="post" enctype="multipart/form-data" onsubmit="return onViewLeadData(this)">
   <div id="content" class="padding-20">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                  <strong>Edit Lead</strong>
                  <div class="pull-right box-tools">
                    <a href="<?php echo base_url('leads');?>" class="btn btn-teal btn-sm">Back</a>
                  </div>
                </div>
                <div class="panel-body">
                    <fieldset>
                      <?php
                      foreach ($edit_leads as $res) 
                      {
                        ?>
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
                                 <input disabled  name="lead_name" placeholder="Enter lead title" class="form-control" type="text" id="lead_name" value="<?php echo $res->lead_name; ?>" />
                              </div>
                              <div class="col-md-6 col-sm-6 project">
                                 <label>Lead Source<!-- <span class="text-danger"> *</span> --></label>
                                  <select disabled name="lead_source_id" class="form-control">
                                    <option value="">Select source</option>
                                    <?php
                                       foreach ($leads_source as $lso_val) 
                                       {
                                        //  salutation lead_status lead_source_id lead_status_id  state industry
                                          ?>
                                          <option <?php if($lso_val->lead_source_id == $res->lead_source_id){ echo "selected"; } ?> value="<?php echo $lso_val->lead_source_id; ?>"><?php echo $lso_val->lead_source; ?></option>
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
                                 <select disabled name="lead_status_id" class="form-control">
                                   <option value="">Select Status</option>
                                    <?php
                                      foreach ($lead_status as $lst_val) 
                                      {
                                        ?>
                                        <option <?php if($lst_val->lead_status_id == $res->lead_status_id){ echo "selected"; } ?> value="<?php echo $lst_val->lead_status_id; ?>"><?php echo $lst_val->lead_status.' ('.$lst_val->lead_type.')'; ?></option>
                                        <?php 
                                      }
                                    ?>
                                 </select>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Organization <!-- <span class="text-danger"> *</span> --></label>
                                 <input disabled type="text" placeholder="Enter organization name" value="<?php echo $res->organization; ?>" name="organization" class="form-control">     
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-2 col-sm-2">
                                 <label>Salutation </label><!-- <span class="text-danger"> *</span> -->
                                  <select class="form-control" name="salutation" id="salutation">
                                    <option <?php if($res->salutation){ echo "selected"; } ?> value="<?php echo $res->salutation; ?>"><?php echo $res->salutation; ?></option>
                                    <option value="Mr">Mr.</option>
                                    <option value="Mrs">Mrs.</option>
                                    <option value="Ms">Ms.</option>
                                    <option value="Dr">Dr.</option>
                                 </select>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                 <label>Name </label><!-- <span class="text-danger"> *</span> -->
                                 <input disabled type="text" placeholder="Enter name" name="name" class="form-control"  value="<?php echo $res->name; ?>">           
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Email </label><!-- <span class="text-danger"> *</span> -->
                                 <input disabled type="text" name="email" placeholder="Enter email address" class="form-control"  value="<?php echo $res->email; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Designation </label><!-- <span class="text-danger"> *</span> -->
                                  <input disabled type="text" placeholder="Enter designation" name="designation" class="form-control" value="<?php echo $res->designation; ?>">
                                 <?php echo form_error('designation','<span class="text-danger">','</span>'); ?>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Phone </label><!-- <span class="text-danger"> *</span> -->
                                 <input disabled type="text" placeholder="Enter phone number" name="phone_number" id="phone_number" class="form-control" value="<?php echo $res->phone_number;?>" >
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Website </label>
                                 <input disabled type="text" name="website" id="website" class="form-control" value="<?php echo $res->website; ?>" placeholder="http://www.expamle.com">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Mobile </label>
                                 <input disabled type="text" placeholder="Enter mobile number" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo $res->mobile_number; ?>" >
                              </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="form-group"> 
                              <div class="col-md-6 col-sm-6">
                                <label>Industry </label>
                                <select disabled class="form-control" name="industry" id="industry">
                                 <option value="">Select Industry</option>
                                  <option <?= ($res->industry == 'ASP (Application Service Provider)') ? 'selected' : '';?> value="ASP (Application Service Provider)">ASP (Application Service Provider)</option>
                                  <option <?= ($res->industry == 'Data/Telecom OEM') ? 'selected' : '';?> value="Data/Telecom OEM">Data/Telecom OEM</option>
                                  <option <?= ($res->industry == 'ERP (Enterprise Resource Planning)') ? 'selected' : '';?> value="ERP (Enterprise Resource Planning)">ERP (Enterprise Resource Planning)</option>
                                  <option <?= ($res->industry == 'Government/Military') ? 'selected' : '';?> value="Government/Military">Government/Military</option>
                                  <option <?= ($res->industry == 'Large Enterprise') ? 'selected' : '';?> value="Large Enterprise">Large Enterprise</option>
                                </select>
                              </div>                            
                              <div class="col-md-6 col-sm-6">
                                 <label>Skype id </label>
                                 <input disabled type="text" name="skype" class="form-control" value="<?php echo $res->skype; ?>" placeholder="Enter skype id">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Facebook </label>
                                 <input disabled type="text" name="facebook" placeholder="facebook.com" class="form-control" value="<?php echo $res->facebook;?>">
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Twitter </label>
                                 <input disabled type="text" name="twitter" placeholder="@twiiter" class="form-control" value="<?php echo $res->twitter;?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="col-md-6 col-sm-6">
                                 <label>Secondary Email </label>
                                 <input disabled type="text" name="secondary_email" id="secondary_email" class="form-control" value="<?php echo $res->sec_email; ?>" placeholder="Enter secondary email">
                              </div>
                              <div class="col-md-3 col-sm-3">
                                 <label>Annual Revenue </label>
                                 <input disabled type="text" name="annual_revenue" class="form-control" value="<?php echo $res->annual_revenue; ?>" placeholder="Rs. 0.00">
                              </div>
                              <div class="col-md-3 col-sm-3">
                                <label class="switch switch-round switch-success" style="margin-top: 30px;">
                                  <input disabled type="checkbox" checked="checked" value="1" name="email_opt_out" id="email_opt_out">
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
                                <select disabled class="form-control"  name="country_id" id="country_id" onchange="getStateList(this.value)">
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
                                 <label>State</label><!-- <span class="text-danger"> *</span> -->
                                <select disabled class="form-control"  name="state_id" id="state_id">
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
                               <label>City </label><!-- <span class="text-danger"> *</span> -->
                               <input disabled type="text" name="city" placeholder="Enter city name" class="form-control" value="<?php echo $res->city; ?>" >
                              </div>
                              <div class="col-md-6 col-sm-6">
                                 <label>Zip Code</label><!-- <span class="text-danger"> *</span> -->
                                 <input disabled type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Enter zip code" value="<?php echo $res->zip_code; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <label>Address </label><!-- <span class="text-danger"> *</span> -->
                                <textarea name="address" class="form-control"><?php echo $res->address; ?></textarea>
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
                                <textarea disabled class="form-control" rows="5" name="notes"> <?php echo $res->notes; ?></textarea>
                              </div>
                           </div>
                        </div>
                        <!--lead product detail -->
                         <div id="load_added_product"></div>
                        
                          <?php
                            $leads_process = $this->session->userdata('leads_process');
                            $addedProduct = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $this->uri->segment(3)));
                          ?>
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($addedProduct))
                            {
                              $i =1;
                              foreach ($addedProduct as $res) 
                              {
                                ?>
                                <tr class="odd gradeX">                            
                                  <td><?= $i ?></td>
                                  <td><?= $res->product_name; ?></td>
                                  <td><?= $res->product_price; ?></td>
                                  <td><?= $res->product_desc; ?></td>
                                  <td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this , '<?= $res->lead_product_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
                                </tr>
                                <?php
                                $i++;
                              }
                            }
                            ?>
                            </tbody>
                          </table>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Process Information</h4>
                            </div>
                          </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                              <tr>
                                <th>Process Date</th>
                                <th>Process Type</th>
                                <th>Min.Of Call</th>
                                <th>Responce Level</th>
                                <th>Next Meeting Or Call</th>
                                <th>To Do List</th>
                                <th>Sample Request</th>
                                <th>Quote Request</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                             <tbody>
                                <?php
                                   if(!empty($process_list))
                                   {
                                       foreach($process_list as $pres)
                                       {

                                          if($pres->response_levels != '')
                                          {
                                            $prg_width = $pres->response_levels.'%';
                                          }
                                           ?>
                                          <tr>
                                             <td><?php echo $pres->leads_process_date; ?></td>
                                             <td><?php echo $pres->leads_process_type; ?></td>
                                             <td><?php echo $pres->meeting_minutes; ?></td>
                                             <td><div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                                              <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div></div><br><?php echo $prg_width; ?></td>
                                             <td>

                                              <?php 
                                              if($pres->next_meeting_call == 'yes')
                                              {
                                                if($pres->next_meeting_date != '')
                                                echo 'Date - '.date_format(date_create_from_format('Y-m-d', $pres->next_meeting_date),'d M Y').'<br>'.'Time - '.$pres->next_meeting_time;
                                              }
                                              else{
                                                 echo $pres->next_meeting_call;
                                                } ; ?></td>
                                             <td><?php echo $pres->to_do_list; ?></td>
                                             <td><?php echo $pres->sample_request; ?></td>
                                             <td><?php echo $pres->quote_request; ?></td>
                                             <td><a title="View Details" href="<?php echo base_url().'leads/viewProcessDetails/'.$pres->leads_process_details_id; ?>"><i class="fa fa-eye fa-2x"></i></a></td> 
                      
                                          </tr>
                                        <?php
                                           }
                                       }
                                     ?>                       
                             </tbody>
                        </table>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="alert alert-info" style="margin-bottom: 0px; padding: 14px 0px 6px 10px;">
                              <h4 style="line-height: 10px;">Quotations Information</h4>
                            </div>
                          </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                               <tr>
                                  <th>S.No.</th>
                                  <th>Quotation Name</th>
                                  <th>Quotation Version</th>
                                  <th>Quotation To</th>
                                  <th>Submition Date</th>
                                  <th>Address</th>
                                  <th>Price</th>
                                  <th>View</th>
                               </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($quotation_detail))
                            {
                              $i = 0;
                              foreach($quotation_detail as $res)
                              {
                                $i++;
                                ?>
                                <tr>
                                   <td><?= $i; ?></td>
                                   <td><?= $res->quote_name; ?></td>
                                   <td><?= $res->quote_version; ?></td>
                                   <td><?= $res->quote_to; ?></td>
                                   <td><?= $res->submition_date; ?></td>
                                   <td><?= $res->address1.' '.$res->location.' '.$res->city; ?></td>
                                   <td><?= $res->quote_subtotal; ?></td>     
                                   <td><a title="View Details" href="<?php echo base_url().'leads/viewQuotationDetails/'.$res->quote_id.'/viewlead/'.$this->uri->segment(3); ?>"><i class="fa fa-eye fa-2x"></i></a></td>     
                                </tr>
                                <?php
                              }
                            }
                            ?>                       
                            </tbody>
                        </table>
                        <?php
                      }
                      ?>
                    </fieldset>
                </div>
            </div>
          </div>
         </div>
      </div>
  </form>
 </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript"> 

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
  $(function() {
    $('.switch-btn-change').click(function() {
      alert($(this).children().checked);
    });
  });

  function removeAddedProduct(obj, id)
  {
    bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
      if(confirmed)
      {
        var data = 'lead_product_id='+id;
        $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
          console.log(res);
          if(res)
          {
             $(obj).parent('td').closest('tr').remove();
          }
        });
      }
    });
  }
</script>