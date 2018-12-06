<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Client</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">client</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>client Details</strong> 
            </span>
           <div class="pull-right box-tools">
                   <!--  <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>client/addclient" class="btn btn-info btn-sm">Add New</a>              
                                <?php
                            }
                        }
                    ?>                     -->
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
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Client Phone</th>
                <th>Client Address</th>               
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                  <?php
                     if(!empty($client_result))
                     {
                         foreach($client_result as $res)
                         {
                             ?>
                            <tr>
                               <td><?php echo $res->lead_name; ?></td>
                               <td><?php echo $res->email; ?></td>
                               <td><?php echo $res->mobile; ?></td>
                               <td><?php echo $res->address.' , '.$res->country_name.' , '.$res->city.' , '.$res->state_name; ?></td>       
                               <td width="10%">
                                  <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                        <a href="#" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a class="confirm" onclick="return delete_client('<?php echo $res->leads_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
         <div class="panel-footer">
          
         </div>
         <!-- /panel footer -->
      </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
    function delete_client(client_id)
    {

          bootbox.confirm("Are you sure you want to delete client details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>client/delete_client/"+client_id;
            }
        });
    }    
</script>