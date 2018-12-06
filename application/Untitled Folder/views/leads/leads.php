<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>leads</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">leads</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20 lead-wrapper">
   <div id="panel-1" class="panel panel-default">
      <div class="panel-heading" style="height: 63px">
         <div class="row col-md-3 pull-left">
            <select class="form-control select2" id="showLeadsBy" name="showLeadsBy">
               <option value="all">All Leads</option>
               <option value="converted">Converted Leads</option>
               <option value="my">My Leads</option>
               <option value="assign">Assign Leads</option>
               <option value="non-assign">Non Assign Leads</option>
               <!-- <option value="open">Open Leads</option> -->
               <option value="today">Today's Leads</option>
               <!-- <option value="recent">Recently Created Leads</option> -->
            </select>
         </div>
         <div class="pull-right box-tools">
            <?php
            foreach($getAllTabAsPerRole as $role)
            {
               if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
               {
                  ?>
                  <div class="btn-group">
                     <a href="<?php echo base_url();?>leads/addLead" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></a>
                     <a href="<?php echo base_url();?>leads/addLead" class="btn btn-default btn-sm">Add New</a>
                  </div>
                  &nbsp;
                  &nbsp;
                  &nbsp;
                  <a href="<?php echo base_url();?>leads/massAssign" class="btn btn-default btn-sm">Assign Leads</a>
                  <!-- <div class="btn-group">
                     <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                     <span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Mass Delete</a></li>
                        <li><a href="#">Mass Update</a></li>
                        <li><a href="<?= base_url('leads/massConvert') ?>">Mass Convert</a></li>
                        <li><a href="<?= base_url('leads/massAssign') ?>">Mass Assign</a></li>
                     </ul>
                  </div> -->
                  <?php
               }
            }
            ?>                    
         </div>
      </div>
      <!-- panel content -->
      <div class="panel-body">
         <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
         </div>
         <table id="loadLeadData" class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                  <th>Lead Name</th>
                  <th>Company</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Lead Status</th>
                  <th>Status</th>
                  <th>Assign Status</th>
                  <th>Add Meeting</th>
                  <th>Add Process</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
      </div>
      <!-- /panel content -->
   </div>
</section>
<div id="processModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Leads Process</h4>
         </div>
         <!-- Modal Body -->
         <div class="modal-body">
            <form method="POST" action="<?php echo base_url(); ?>leads/addleadsProcess">
               <input type="hidden" name="lead_id" id="lead_id" value="">
               <div class="row">
                  <div class="form-group">
                     <div class="col-md-6 col-sm-6 ">
                        <!-- mt_view -->
                        <label >Date<span class="text-danger"> *</span></label>
                        <input autocomplete="off" type="text" name="leads_process_date" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="<?= date('Y-m-d') ?>" data-lang="en" data-rtl="false"><br>
                     </div>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                           <label>Process Type <span class="text-danger"> *</span></label>
                           <select name="leads_process_type" class="form-control">
                              <option value="initial-discussion">Initial Discussion</option>
                              <option value="presentation">Presentation</option>
                              <option value="following-quote">Following Quotes</option>
                              <option value="sales-done">Sales Done</option>
                              <option value="product-teach-discussion">Product Teach Discussion</option>
                           </select>
                           <br>                          
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <label class="checkbox">
                     <input type="checkbox" name="meeting_check" id="meeting_check" onclick="meetingDetails(this.value)" value="check"><i></i>Add Meeting &nbsp;&nbsp;&nbsp;</label>
                  </div>
                  <div class="col-md-6">
                     <div id="setMeeting"  style="display: none;">
                        <select class="form-control"  name="leads_Metting" id="leads_Metting">
                        </select>
                     </div>
                  </div>
               </div>
               <!-- Modal Footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /panel footer -->
</div>
<!-- Modal -->
<div class="modal fade" id="mettingModal" role="dialog"  aria-hidden="true">
   <div class="modal-dialog">
      <!-- Modal content-->
      <form method="POST" id="meeting_form">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Add Meeting</h4>
            </div>
            <div class="modal-body">
               <input type="hidden" name="lead_id" id="lead_meeting_id">
               <div class="row">
                  <div class="form-group">
                     <div class="col-md-6 col-sm-6">
                        <label>Date<!-- <span class="text-danger"> *</span> --></label>
                        <input autocomplete="off" type="text" name="metting_date" id="metting_date" value="<?= date('Y-m-d'); ?>" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                        <span id="error_mtg_date" style="color: red;"></span>
                        <br>
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <label>Time<!-- <span class="text-danger"> *</span> --></label>
                        <input type="text" name="metting_time" class="form-control timepicker" placeholder="00 : 00 : PM">
                     </div>
                  </div>
               </div>
               <div class="panel panel-info" style="box-shadow: none;">
                  <div class="panel-heading">Meeting List</div>
               </div>
               <table class="table table-striped table-bordered table-hover" id="meeting_list_table">
                  <thead>
                     <tr>
                        <th>S.No.</th>
                        <th>Date</th>
                        <th>Time</th>
                     </tr>
                  </thead>
                  <tbody>              
                  </tbody>
               </table>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </div>
         </div>
      </form>
   </div>
</div>
<div id="processModalEdit" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <input type="text" name="phone" class="form-control" value="<?php //echo $res->phone; ?>">
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
</div>
<!-- /MIDDLE -->
<script type="text/javascript">
   function delete_leads(lead_id)
   {
     bootbox.confirm("Are you sure you want to delete leads Details",function(confirmed){       
       if(confirmed)
       {
           location.href="<?php echo base_url();?>leads/deleteleads/"+lead_id;
       }
     });
   }    
   
   $('#checkAll').click(function () {    
     $(':checkbox.checkItem').prop('checked', this.checked);    
   });
   function change_lead_status(lead_status,lead_id)
   {
        location.href="<?php echo base_url();?>leads/changeLeadStatus/"+lead_status+'/'+lead_id;
   }
   
   function save_lead_id(id)
   {
     $('#lead_id').val(id);
     $('#processModal').modal('show');
   
   }
   
   function edit_lead_id(id)
   {
     $('#lead_id').val(id);
     $('#processModalEdit').modal('show');
   }
   
</script>
<script type="text/javascript" src="http://sixthsenseit.com/toshow/best-kitchenware/webroot/admin/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://sixthsenseit.com/toshow/best-kitchenware/webroot/admin/js/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
      var table = '';
      if (jQuery().dataTable) {
      table = $('#loadLeadData').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' servermside processing mode.
        "order": [],
        "scrollX":true,
       "ajax": {
          "url": "<?php echo base_url('leads/loadLeadsData')?>",
          "type": "POST",
          "dataType": "json",
           "data": function ( data ) {
              data.show_leads_by = $('#showLeadsBy').val();
           },
          "dataSrc": function (jsonData) {
            return jsonData.data;
          }
        },
        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [0,3,4,7], //first column / numbering column
            "orderable": false, //set not orderable
        }]
      });
    }
   $('#showLeadsBy').on('change' , function(){
      table.ajax.reload(); 
   });
   
   function save_leads_id(obj)
   {
      var id = $(obj).data('id');
      $('#lead_id').val(id);
      $('#processModal').modal('show');
      $('#lead_id').val(id);
      var str = 'lead_id='+id; 
      var PAGE = '<?php echo base_url(); ?>leads/loadProcessData';
      jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data : str,
         beforeSend: function( xhr ) 
         {
           reloadTopBar();
         },
         success:function(response)
         {    
           $('#processModal').find('#leads_Metting').html(response);
         } 
      });
   }
    
     $(document).on('click','.loadMeeting',function()
     {
       var $this = $(this);
       var id = $($this).data('id');
       // $('#meeting_list_table').dataTable();
       $('#mettingModal').modal('show');
       $('#lead_meeting_id').val(id); 
       var str = 'lead_id='+id; 
       var PAGE = '<?php echo base_url(); ?>leads/loadMeetingData';
       jQuery.ajax({
         type :"POST",
         url  :PAGE,
         data : str,
         beforeSend: function( xhr ) 
         {
           reloadTopBar();
         },
         success:function(response)
         {    
            $('#meeting_list_table').find('tbody').html(response);
         } 
       });
     });

    function meetingDetails(str)
    {
       var str = document.getElementById("meeting_check").checked;
      
       if(str == true)
       {
          $('#setMeeting').show();
       }
       else
       {
          $('#setMeeting').hide();
       }
    }

     $('#meeting_form').submit(function(event){
      event.preventDefault();
      if($('#metting_date').val() == '')
      {
        $('#metting_date').focus();
        $('#error_mtg_date').html('Meeting date is required.');
        return false; 
      }
      else
      {
        $('#error_mtg_date').html('');
      }
      var postData = $('#meeting_form').serialize()+'&submit='+'Submit';
      $.post('<?= base_url() ?>leads/addNewMeeting' , postData , function(res){
        $('#meeting_list_table').find('tbody').html(res);
        $('#meeting_form')[0].reset();
      });
      return false;
   });
</script>