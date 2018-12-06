<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Opportunities State Reason</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Opportunities State Reason</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Opportunities State Reason Details</strong> 
            </span>
               <div class="pull-right box-tools">
                <?php
                    foreach($getAllTabAsPerRole as $role)
                    {
                        if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                        {
                            ?>
                                <a href="<?php echo base_url();?>settings/addOpportunitiesStateReason" class="btn btn-info btn-sm">Add New</a>              
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
           
          <table class="table table-striped table-bordered table-hover" id="sample_5">
            <thead>
              <tr>
                <th>Opportunities State</th>              
                <th>Opportunities State Reason</th>              
                <th>Status</th>
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                  <?
                     if(!empty($opportunities_state_reason_result))
                     {
                         foreach($opportunities_state_reason_result as $res)
                         {
                             ?>
                            <tr>
                                <td><?php echo $res->opportunities_state; ?></td>
                                <td><?php echo $res->opportunities_state_reason; ?></td>
                               
                               <td width="10%">
                                  <?php
                                     if($res->opportunities_state_reason_status == '1')
                                     {
                                         ?>
                                  <span class="text-success">Active</span>
                                  <?php
                                     }
                                     else
                                     {
                                         ?>
                                  <span class="text-danger">Inactive</span>
                                  <?php
                                     }
                                     ?>
                               </td>
                               <td width="10%">
                                  <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                        <a href="<?php echo base_url();?>settings/addOpportunitiesStateReason/<?php echo $res->opportunities_state_reason_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                    <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a class="confirm" onclick="return delete_opportunities_state_reason('<?php echo $res->opportunities_state_reason_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
                                  <?php
                                     }
                                    }
                                  ?>  
                               </td>
                            </tr>
                          <?php
                             }
                         }
                         else
                         {
                         ?>
                          <tr>
                              <td colspan="3">No records found...</td>
                              <td></td>
                              <td></td>       
                              <td></td>       
                             
                          </tr>
                      <?php
                         }
                         
                         ?>                       
               </tbody>
            </table>
         </div>
         <!-- /panel content -->
         <!-- panel footer -->
         <div class="panel-footer">
          
         </div>
         <!-- /panel footer -->
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
    function delete_opportunities_state_reason(opportunities_state_reason_id)
    {

          bootbox.confirm("Are you sure you want to delete Opportunities State Reason details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>settings/deleteOpportunitiesStateReason/"+opportunities_state_reason_id;
            }
        });
    }    
</script>