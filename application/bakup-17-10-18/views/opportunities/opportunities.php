<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Opportunities</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
   <div id="panel-1" class="panel panel-default">
      <div class="panel-heading">
         <span class="title elipsis">
         <strong>Opportunities Details</strong> 
         </span>    
      </div>
      <!-- panel content -->
      <div class="panel-body">
         <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
         </div>
         <table class="table table-striped table-bordered table-hover" id="web_view_tbl">
            <thead>
               <tr>
                  <th>Opportunities Name</th>
                  <th>Stages</th>
                  <th>Probability</th>
                  <th>Expected Revenue</th>
                  <th>Add Meeting</th>
                  <th>Add Process</th>
                  <th>Move To Client</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              <?php
              if(!empty($opportunities_result))
              {
                foreach($opportunities_result as $res)
                {
                  $lead_id = $res->lead_id;
                  $checkQuote = $this->comman_model->getData('tbl_quotation' , array('lead_id' => $lead_id) , 'count');

                  if($res->probability != '')
                  {
                    $prg_width = $res->probability.'%';
                  }
                  ?>
                  <tr>
                    <td>
                      <?php echo $res->lead_name; ?>
                      <div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                      <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div></div>
                    </td>
                    <td><?php echo $res->stages; ?></td>
                    <td><?php echo $prg_width; ?></td>
                    <td><i class="fa fa-rupee"></i> <?php echo $res->expected_revenue; ?></td>
                    <td><button data-id="<?php echo $res->lead_id; ?>" class="btn btn-info btn-sm loadMeeting"><i class="fa fa-plus"></i></button></td>
                    <td align="center">
                      <?php 
                      if($res->opportunity_status == '1')
                      { 
                        ?>
                        <button onclick="save_opportunities_id('<?php echo $res->lead_id; ?>')" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                        <?php 
                      }
                      else if($res->opportunity_status == '2')
                      { 
                        ?>
                        <a href="<?php echo base_url().'leads/processDetails/'.$res->lead_id; ?>"><i class="fa fa-eye fa-2x"></i></a> 
                        <?php 
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      if($checkQuote > 0)
                      {
                        ?>
                      <a href="<?php echo base_url().'opportunities/moveToClient/'.$res->opportunities_id; ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                      <?php
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      foreach($getAllTabAsPerRole as $role)
                      {
                        if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                        {
                          ?>
                          <a href="<?php echo base_url();?>opportunities/addOpportunities/<?php echo $res->lead_id; ?>" title="Edit"><i class="fa fa-eye fa-2x "></i></a>&nbsp;&nbsp;<?php
                        }

                        if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                        {
                          ?>
                          <!-- <a class="confirm" onclick="return delete_Opportunities('<?php echo $res->lead_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a> -->
                          <?php
                        }
                      }
                      ?>  
                    </td>
                  </tr>
                  <?php
                }
              }
              ?>      
            </tbody>
         </table>
      </div>
      <!-- /panel content -->
      <!-- panel footer -->
      <div class="panel-footer">          
      </div>
      <div id="processModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Add Opportunities Process</h4>
               </div>
               <!-- Modal Body -->
               <div class="modal-body">
                  <form method="POST" action="<?php echo base_url(); ?>opportunities/addOpportunitiesProcess">
                     <input type="hidden" name="opportunities_id" id="opportunities_id" value="">
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 mt_view">
                              <label >Date<span class="text-danger"> *</span></label>
                              <input autocomplete="off" type="text" name="opportunities_process_date" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="<?= date('Y-m-d') ?>" data-lang="en" data-rtl="false"><br>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label>Process Type<span class="text-danger"> *</span></label>
                              <select name="opportunities_process_type" class="form-control">
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
                     <div class="row">
                        <div class="form-group">
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
                     <input type="hidden" name="lead_id" id="oppo_meeting_id">
                     <div class="row">
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6">
                              <label>Date<span class="text-danger"> *</span></label>
                              <input autocomplete="off" type="text" name="metting_date" id="metting_date" class="form-control datepicker" value="<?= date('Y-m-d'); ?>" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false">
                              <span id="error_mtg_date" style="color: red;"></span>
                              <br>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <label>Time<span class="text-danger"> *</span></label>
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
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
  function delete_Opportunities(Opportunities_id)
  {
    bootbox.confirm("Are you sure you want to delete Opportunities Details",function(confirmed){            
       if(confirmed)
       {
           location.href="<?php echo base_url();?>opportunities/deleteOpportunities/"+Opportunities_id;
       }
    });
  }

  function save_opportunities_id(id)
  {
    $('#opportunities_id').val(id);
    $('#processModal').modal('show');
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
   
  function move_to_client()
  {
    $('#opportunities_id').val(id);
    $('move_to_client').on('click');
    var str = 'action_move_to_client='+'Load Product'; 
    var PAGE = '<?php echo base_url(); ?>opportunities/moveToClientData';
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
   
  $(document).on('click','.loadMeeting',function()
  {
    var $this = $(this);
    var id = $($this).data('id');
    // $('#meeting_list_table').dataTable();
    $('#mettingModal').modal('show');
    $('#oppo_meeting_id').val(id);
    var str = 'opportunities_id='+id; 
    var PAGE = '<?php echo base_url(); ?>opportunities/loadMeetingData';
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