<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Inprogress</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Inprogress</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Inprogress Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>tickets/addinProgress" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Ticket Code </th>
                <th>Subject </th>
                <th>Reporter </th>
                <th>Priority  </th>
                <th>Department </th>
                <th>Ticket Message </th>
                <th>Action</th>                
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($inprogress_result))
                     {   
                         foreach($inprogress_result as $res)
                         {                           
                             ?>
                            <tr>
                               <td><?php echo $res->ticket_code  ; ?></td>
                               <td><?php echo $res->subject; ?></td>
                               <td><?php echo $res->user_full_name; ?></td>
                               <td><?php echo $res->priority; ?></td>
                               <td><?php echo $res->deptname; ?></td>
                               <td><?php echo $res->comment; ?></td>
                              
                                <td width="10%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>tickets/addinProgress/<?php echo $res->tickets_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a onclick="delete_Inprogress('<?php echo $res->tickets_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_Inprogress(tickets_id)
    {

          bootbox.confirm("Are you sure you want to delete Answerd Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>tickets/deleteAnswerd/"+tickets_id;
            }
        });
    }    

  
</script>
