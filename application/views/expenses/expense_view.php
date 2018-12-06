<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Expenses</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Expenses</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Expense Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>expense/addexpense" class="btn btn-info btn-sm">Add New</a>              
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
           
         <table class="table table-striped table-bordered table-hover" id="web_view_tbl">

            <thead>
              <tr>
                <th>Amount</th>
                <th>Category</th>
                <th>Narration</th>
                <!-- <th>Attchment</th> -->
                <!-- <th>Status</th> -->
                <th>Action</th>
                               
              </tr>
            </thead>
               <tbody>
                <?php
                     if(!empty($expense_result))
                     {
                         foreach($expense_result as $res)
                         {    

                         $expence_catrgory = $this->comman_model->getData('tbl_expense_category' , array('expense_category_id' => $res->expenses_category_id), 'single');    
                         // echo "<pre>"; print_r($expence_catrgory); die();               

                             ?>
                            <tr>
                               <td><?php echo $res->expenses_amt; ?></td>
                               <td><?php echo $expence_catrgory->expense_category; ?></td>
                               <td><?php echo $res->expenses_narration; ?></td>
                              <!--  <td><?php echo $res->expenses_attachment; ?></td> -->
                              <!-- <td></td> -->
                                <td width="20%">
                                   <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                          <a href="<?php echo base_url();?>expense/addexpense/<?php echo $res->expenses_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                      <?php
                                         }
                                         if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                          {
                                             ?>
                                           <a onclick="delete_expense('<?php echo $res->expenses_id; ?>')" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
      <script type="text/javascript">
    function delete_expense(expenses_id)
    {

          bootbox.confirm("Are you sure you want to delete expense Details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>expense/deleteexpense/"+expenses_id;
            }
        });
    }    

  
</script>
