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
                <th>Form Account</th>
                <th>To Account</th>
                <th>Date</th>
                <th>type</th>
                <th>Notes</th>
                <th>Amount </th>               
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($transfer_reports_result))
                     { 
                          foreach($transfer_reports_result as $res)
                           {      
                             ?>
                            <tr>
                               <td><?php echo $res->from_account_name; ?></td>
                               <td><?php echo $res->to_account_name; ?></td>
                               <td><?php echo $res->transfer_date; ?></td>
                               <td><?php echo $res->type; ?></td>
                               <td><?php echo $res->notes; ?></td>
                               <td><?php echo $res->amount; ?></td>
                             
                              
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
