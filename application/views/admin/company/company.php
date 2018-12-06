
<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Employee</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Employee</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Employee Details</strong> 
            </span>
           <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(1) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>company/addCompany" class="btn btn-info btn-sm">Add New</a>              
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
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Phone</th>
                <th>Company Budget</th>
                <th>Cost/Unit</th>
                <th>Company Address</th>
                <th>Status</th>
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                  <?php
                     if(!empty($company_result))
                     {
                         foreach($company_result as $res)
                         {
                             ?>
                            <tr>
                               <td><?php echo $res->user_full_name; ?></td>
                               <td><?php echo $res->user_email; ?></td>
                               <td><?php echo $res->user_phone; ?></td>
                               <td><?php echo '$'.$res->company_budget; ?></td>
                               <td><?php echo '$'.$res->quote_per_employee; ?></td>
                               <td><?php echo $res->user_address.' , '.$res->country_name.' , '.$res->user_city.' , '.$res->state_name.' , '.$res->user_zip_code; ?></td>
                              
                               <td width="10%">
                                  <?php
                                     if($res->user_status == '1')
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
                               <td width="10%">
                                  <?php
                                     foreach($getAllTabAsPerRole as $role)
                                     {
                                         if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                         {
                                             ?>
                                        <a href="<?php echo base_url();?>company/addCompany/<?php echo $res->user_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                  <?php
                                     }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                     {
                                         ?>
                                       <a class="confirm" onclick="return delete_company('<?php echo $res->user_id;?>');" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_company(company_id)
    {
         bootbox.confirm("Are you sure you want to delete Company details",function(confirmed){            
            if(confirmed)
            {
                location.href="<?php echo base_url();?>company/delete_company/"+company_id;
            }
        });
    }    
</script>