<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>TransactionsReports</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">TransactionsReports</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>TransactionsReports Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                   <!--  <a href="<?php echo base_url();?>transactions/addtransactionsreport" class="btn btn-info btn-sm">Add New</a>  -->             
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
                <th>Accounts</th>
                <th>Date</th>
                <th>type</th>
                <th>Notes</th>
                <th>Amount </th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Balance</th>               
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($transactions_reports_result))
                     {
                        $total_credit=0;
                        $total_debit=0;
                        $total_balance=0;
                          foreach($transactions_reports_result as $res)
                           {    
                                $total_credit = $total_credit+$res->credit;                       
                                $total_debit = $total_debit+$res->debit;                       
                                $total_balance = $total_balance+$res->total_balance;
                             ?>
                            <tr>
                               <td><?php echo $res->account_name; ?></td>
                               <td><?php echo $res->date; ?></td>
                               <td><?php echo $res->type; ?></td>
                               <td><?php echo $res->notes; ?></td>
                               <td><?php echo $res->amount; ?></td>
                               <td><?php echo $res->credit; ?></td>
                               <td><?php echo $res->debit; ?></td>
                               <td><?php echo $res->total_balance; ?></td>
                              
                              
                               <!--  <td width="10%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>transactions/addtransactionsreport/<?php echo $res->transactions_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a onclick="delete_TransactionsReports('<?php echo $res->transactions_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
                                  <?php
                                     }
                                    }
                                  ?> 
                               </td> -->
                               
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
    
        
         <div class="panel-footer">
          <strong class="col-sm-4" style="font-size: 15px;">Credit: <span style="padding: 6px;" class="label label-primary"><?php echo $total_credit ?></span></strong>
           <strong class="col-sm-4" style="font-size: 15px;">Debit: <span style="padding: 6px;" class="label label-danger"><?php echo $total_debit ?></span></strong>
          <strong class="col-sm-4" style="font-size: 15px;">Total Balance: <span class="label label-info" style="padding: 6px;"><?php echo $total_balance ?></span></strong>
      
       </div>
       </div>
       </div>
         <!-- /panel content -->
         <!-- panel footer -->
      <script type="text/javascript">
    function delete_TransactionsReports(transactions_id)
    {

          bootbox.confirm("Are you sure you want to delete TransactionsReports Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>transactions/deletetransactionsreports/"+transactions_id;
            }
        });
    }    

  
</script>
