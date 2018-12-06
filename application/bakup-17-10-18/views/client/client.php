<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Client</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Client</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Client Details</strong> 
            </span>    
         </div>

         <!-- panel content -->
         <div class="panel-body">

        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
           
         <table class="table table-striped table-bordered table-hover" id="sample_5">
            <thead>
              <tr>
                <th>Client Name</th>
                <th>Stages</th>
                <th>Probability</th>
                <th>Expected Revenue</th>
                <!-- <th>Add Meeting</th> -->
                <th>Add Process</th>
                <!-- <th>Move To Client</th> -->
                <th>Action</th>                 
              </tr>
            </thead>
            <tbody>
              <?php
                 if(!empty($client_result))
                 {
                     foreach($client_result as $res)
                     {
                       // echo "<pre>";
                       //  print_r($opportunities_result); die();
                        if($res->probability != '')
                        {
                          $prg_width = $res->probability.'%';
                        }
                         ?>
                        <tr>
                           <td><?php echo $res->lead_name; ?>
                            
                            <div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                            <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div>
                            </div>
                           </td>
                           <td><?php echo $res->stages; ?></td>
                           <td><?php echo $prg_width; ?></td>
                           <td><?php echo 'Rs.'.$res->expected_revenue; ?></td>
                          <!--  <td>
                             <button onclick="meeting_opportunities_id('<?php echo $res->lead_id; ?>')" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
                           </td> -->
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
                         <!--  <td>
                             <a href="<?php echo base_url().'opportunities/moveToClient/'.$res->opportunities_id; ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                           </td> -->
                           <td >
                              <?php
                                 foreach($getAllTabAsPerRole as $role)
                                 {
                                     if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                     {
                                         ?>
                                      <a href="<?php echo base_url();?>client/addClient/<?php echo $res->opportunities_id; ?>" title="Edit"><i class="fa fa-eye fa-2x "></i></a>&nbsp;&nbsp;                
                                    <?php
                                 }
                                 if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                 {
                                  ?>
                                  <a class="confirm" onclick="return delete_Client('<?php echo $res->lead_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
                <h4 class="modal-title" id="myModalLabel">Add Client Process</h4>
              </div>
              <!-- Modal Body -->
              <div class="modal-body">
              <form method="POST" action="<?php echo base_url(); ?>client/addClientProcess">
              <input type="hidden" name="client_id" id="client_id" value="">
                <div class="row">
                   <div class="form-group">
                      <div class="col-md-6 col-sm-6">
                         <label>Date<span class="text-danger"> *</span></label>
                         <input autocomplete="off" type="text" name="client_process_date" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false"><br>
                      </div>
                      <div class="col-md-6 col-sm-6">
                         <label>Process Type<span class="text-danger"> *</span></label>
                         <select name="client_process_type" class="form-control">
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
        <form method="POST" action="<?php echo base_url(); ?>client/addMeeting">
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
                          <label>Date<span class="text-danger"> *</span></label>
                          <input autocomplete="off" type="text" name="metting_date" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-rtl="false"><br>
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
    function delete_Client(Client)
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
      $('#client_id').val(id);
       $('#processModal').modal('show');
    }
    // function meeting_opportunities_id(id) 
    // {
    //    $('#client_id').val(id);
    //     $('#mettingModal').modal('show');
    // }
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
</script>
