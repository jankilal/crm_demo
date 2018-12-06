<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Deposit</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Deposit</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>deposit Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>transactions/addeposit" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Accounts </th>
                <th>Date</th>
                <th>Notes</th>
                <th>Amount </th>
                <th>Category</th>
                <th>Paid By</th>
                <th>Payment Method </th>
                <th>Reference</th>
                <th>Total balance</th>
                <th>Action</th>                
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($deposit_result))
                     {  
                         $total_balance=0;
                         foreach($deposit_result as $res)
                         {                           
                              $total_balance = $total_balance+$res->total_balance;
                             ?>
                            <tr>
                               <td><?php echo $res->account_name  ; ?></td>
                               <td><?php echo $res->date; ?></td>
                               <td><?php echo $res->notes; ?></td>
                               <td><?php echo $res->amount; ?></td>
                               <td><?php echo $res->income_category; ?></td>
                               <td><?php echo $res->user_full_name; ?></td>
                               <td><?php echo $res->method_name; ?></td>
                               <td><?php echo $res->reference; ?></td>
                               <td><?php echo $res->total_balance; ?></td>
                              
                                <td width="10%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>transactions/addeposit/<?php echo $res->transactions_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a onclick="delete_deposit('<?php echo $res->transactions_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_deposit(transactions_id)
    {

          bootbox.confirm("Are you sure you want to delete Income Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>transactions/deletedeposit/"+transactions_id;
            }
        });
    }    

  
</script>
