<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Goal Tracking</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Goal Tracking</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>GoalTracking Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>goalTracking/addGoalTracking" class="btn btn-info btn-sm">Add New</a>              
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
           
         <table class="table table-striped table-bordered table-hover" id="sample_1">

            <thead>
              <tr>
                <th>Subject </th>
                <th>Goal Type</th>
                <th>Target Achievement</th>
                 <th>Start Date</th>
                <th>End Date </th>
                <th>Description</th>
                <th>Action</th>
                               
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($goalTracking_result))
                     {
                         foreach($goalTracking_result as $res)
                         {                           

                             ?>
                            <tr>
                               <td><?php echo $res->subject; ?></td>
                               <td><?php echo $res->goal_type_id; ?></td>
                               <td><?php echo $res->achievement; ?></td>
                               <td><?php echo $res->start_date; ?></td>
                               <td><?php echo $res->end_date; ?></td>
                               <td><?php echo $res->description; ?></td>
                                
                              
                               
                             
                                <td width="10%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>goalTracking/addGoalTracking/<?php echo $res->goal_tracking_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a onclick="delete_expense('<?php echo $res->goal_tracking_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
      <script type="text/javascript">
    function delete_expense(goal_tracking_id)
    {

          bootbox.confirm("Are you sure you want to delete goal Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>goalTracking/deleteGoalTracking/"+goal_tracking_id;
            }
        });
    }    

  
</script>
