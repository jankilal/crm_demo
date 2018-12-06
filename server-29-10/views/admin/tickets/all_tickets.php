<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>All Tickets</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">All Tickets</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>All Tickets Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>tickets/addalltickets" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Status </th>
                <th>Action</th>                
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($alltickets_result))
                     {   
                         foreach($alltickets_result as $res)
                         {                           
                             ?>
                            <tr>
                               <td><?php echo $res->ticket_code  ; ?></td>
                               <td><?php echo $res->subject; ?></td>
                               <td><?php echo $res->user_full_name; ?></td>
                               <td><?php echo $res->priority; ?></td>
                               <td><?php echo $res->deptname; ?></td>
                              <td><span class="label label-warning"><?php echo $res->type; ?></span>&nbsp;<?php echo $res->status; ?>
                               <div>&nbsp;</div>
                               <select class="form-control" id="tickets_id" onchange="change_tickets_status(this.value,'<?php echo $res->tickets_id; ?>')">  
                                            <option value="">Change Status</option>
                                            <option value="answerd">answerd</option>
                                            <option value="open">open</option>
                                            <option value="in_progress">in_progress</option>
                                            <option value="closed">closed</option>       
                               </select>
                               </td>
                                <td width="10%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>tickets/addalltickets/<?php echo $res->tickets_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a onclick="delete_AllTickets('<?php echo $res->tickets_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                    
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
    function delete_AllTickets(tickets_id)
    {

          bootbox.confirm("Are you sure you want to delete All Tickets Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>tickets/deletealltickets/"+tickets_id;
            }
        });
    }    

    function change_tickets_status(status,tickets_id)
    {
         location.href="<?php echo base_url();?>tickets/changeAlltickets/"+status+'/'+tickets_id;
    }
</script>
