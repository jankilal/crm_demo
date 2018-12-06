<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Sample request</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Sample request</li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>Sample request Details</strong> 
            </span>    
         </div>

         <!-- panel content -->
         <div class="panel-body">

        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
           
         <table class="table table-striped table-bordered table-hover" id="sample_5">
            <thead>
              <tr>
                <th>Id</th>
                <th>Opportunity Name</th>
                <th>Sample Details</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Status</th>
                <th>Approvel Status</th>
                <th>Action</th>                 
              </tr>
            </thead>
               <tbody>
                  <?php
                     if(!empty($request_details))
                     {
                        foreach($request_details as $res)
                        {
                            $opportunities_detail =$this->comman_model->getData('tbl_opportunities' , array('opportunities_id'=> $res->lead_id), 'single');

                            if($res->approve_status == 'Pending')
                            {
                            $label = 'warning';         
                            }
                            else if($res->approve_status == 'Approve')
                            {
                            $label = 'success';
                            }
                            else
                            {
                            $label = 'danger';
                            }    
                            //ERP STATUS
                            if($res->sample_request_status == 'Forward to ERP')
                            {                              
                            $label2 = 'warning';            
                            }
                            else if($res->sample_request_status == 'Under Development')
                            {
                            $label2 = 'success';
                            }
                            else if($res->sample_request_status == 'Under courier')
                            {
                            $label2 = 'info';
                            }    
                            else if($res->sample_request_status == 'Delivered')
                            {
                            $label2 = 'success';
                            }    
                            ?>                     
                            <tr>
                            <td><?php echo $res->id; ?></td>
                            <td><?php echo $opportunities_detail->opportunity_name; ?></td>
                            <td><?php echo $res->sample_description ; ?></td>
                            <td><?php echo $res->order_date; ?></td>
                            <td><?php echo $res->delivery_date; ?></td>
                            <td><span class="label label-<?= $label2;?>"><?= $res->sample_request_status; ?></td>
                            <td><span class="label label-<?= $label;?>"><?= $res->approve_status; ?></span></td>

                            <td width="10%">
                              <?php
                                 foreach($getAllTabAsPerRole as $role)
                                 {
                                    if($this->uri->segment(1) == $role->controller_name && $role->userEdit == '1')
                                    {
                                       ?>
                                       
                                       <a href="<?php echo base_url().'sampleRequest/editSampleRequest/'.$res->id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                   <?php
                                       }
                                     if($this->uri->segment(1) == $role->controller_name && $role->userDelete == '1')
                                       {
                                          ?>
                                          <a class="confirm" title="Remove" onclick="return delete_sample_request('<?php echo $res->id;?>');"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
                                     <?php
                                       }
                                    }
                                 ?>  
                               <div class="btn-group" style="margin-top: 5px;">
                               <button style="border-radius: 0px; padding: 4px;" class="btn btn-xs btn-<?= $label; ?> dropdown-toggle" data-toggle="dropdown">
                               Change Status<span class="caret"></span></button>
                               <ul class="dropdown-menu animated zoomIn">
                               <li><a href="<?php echo base_url().'sampleRequest/changeApproveStatus/'.$res->id.'/Pending'?>">Pending</a>
                               </li>
                               <li><a href="<?php echo base_url().'sampleRequest/changeApproveStatus/'.$res->id.'/Approve'?>">Approve</a></li>
                               <li><a href="<?php echo base_url().'sampleRequest/changeApproveStatus/'.$res->id.'/Rejected'?>">Rejected</a></li>
                               </ul>
                               </div>
                            </td>
                         </tr>
                         <?php
                             }
                         }
                         ?>                       
               </tbody>
            </table>
         </div>
   </div>
</section>
<!-- /MIDDLE -->
<script type="text/javascript">
    function delete_sample_request(request_id)
    {
        bootbox.confirm("Are you sure you want to delete Sample request Details",function(confirmed){            
          if(confirmed)
          {
              location.href="<?php echo base_url();?>sampleRequest/deleteSampleRequest/"+request_id;
          }
      });
    }    

</script>
