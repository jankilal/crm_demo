<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>RecurringInvoice</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">RecurringInvoice</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>RecurringInvoice Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>sales/addRecurringInvoice" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Invoice</th>
                <th>Due Date</th>
                <th>Client </th>
                <th>Amount</th>
                <th>Due Amount</th>
                <th>Status</th>
                <th>Action</th>                
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($recurringInvoice_result))
                     {   
                         foreach($recurringInvoice_result as $res)
                         {                           
                             ?>
                            <tr>
                               <td><?php echo $res->invoices_id  ; ?></td>
                               <td><?php echo $res->due_date; ?></td>
                               <td><?php echo $res->user_full_name; ?></td>
                               <td><?php echo $res->tax; ?></td>
                               <td><?php echo $res->discount; ?></td>
                               <td><?php echo $res->status; ?></td>
                              
                                <td width="10%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>sales/addRecurringInvoice/<?php echo $res->invoices_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a onclick="delete_ReInvoice('<?php echo $res->invoices_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_ReInvoice(invoices_id)
    {

          bootbox.confirm("Are you sure you want to delete ReInvoice Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>sales/deleteRecurringInvoice/"+invoices_id;
            }
        });
    }    

  
</script>
