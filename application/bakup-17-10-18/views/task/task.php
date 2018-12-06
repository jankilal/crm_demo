<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Task</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Task</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Task Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>task/addTask" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Task Name</th>
                <th>Task Progress</th>
                <th>Task Status</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Estimated Hour</th>
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                  <?php
                     if(!empty($task_result))
                     {
                         foreach($task_result as $res)
                         {
                            if($res->task_progress != '')
                            {
                              $prg_width = $res->task_progress.'%';
                            }

                             ?>
                            <tr>
                               <td><a href="<?php echo base_url().'task/taskDetails/'.$res->task_id; ?>"><?php echo $res->task_name; ?></a></td>
                               <td><div class="progress progress-striped active">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>"><?php echo $prg_width; ?></div>
                                </div></div></td>  
                               <td><span class="label label-warning"><?php echo $res->task_status; ?></span></td>  
                               <td><?php echo $res->task_start_date ; ?></td>
                               <td><?php echo $res->due_date ; ?></td>
                               <td><?php echo $res->task_hour ; ?></td>
                               <td width="10%">
                                  <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>task/addtask/<?php echo $res->task_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a class="confirm" onclick="return delete_task('<?php echo $res->task_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_task(task_id)
    {

          bootbox.confirm("Are you sure you want to delete task Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>task/deletetask/"+task_id;
            }
        });
    }    
</script>
