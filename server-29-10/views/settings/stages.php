<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Stages</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Stages</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Stages Details</strong> 
            </span>
               <div class="pull-right box-tools">
                <?php
                    foreach($getAllTabAsPerRole as $role)
                    {
                      if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                      {
                        ?>
                            <a href="<?php echo base_url();?>settings/addStages" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Stage Name</th>              
                <th>Stage Description</th>
                <th>Status</th>
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                 <?php
                     if(!empty($stages_result))
                     {
                     foreach($stages_result as $res)
                     {?>
                        <tr >   

                          <td><?php echo $res->stage_name; ?></td>
                          <td><?php echo $res->stage_description?></td>
                           <td >
                                  <?php
                                     if($res->status == '1')
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
                           <td>

                              <?php
                                 foreach($getAllTabAsPerRole as $role)
                                 {
                                    if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                    {
                                      ?>
                                    <a href="<?php echo base_url();?>settings/addStages/<?php echo $res->id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                <?php
                                 }
                                 if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                  {
                                     ?>
                                   <a class="confirm" onclick="return delete_stage('<?php echo $res->id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
         <!-- /panel footer -->
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
    function delete_stage(id)
    {

          bootbox.confirm("Are you sure you want to delete Department details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>settings/deleteStage/"+id;
            }
        });
    }    
</script>