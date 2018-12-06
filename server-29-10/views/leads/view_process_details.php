<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Leads Process Details</h1>
      <ol class="breadcrumb">
         <br>
         <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Leads </li>
      </ol>
   </header>
   <!-- /page title -->
   <div id="content" class="padding-20">
      <div id="panel-1" class="panel panel-default">
         <div class="panel-heading">
            <span class="title elipsis">
            <strong>View Process Details</strong> 
            </span>

            <div class="pull-right box-tools">
                <a href="<?php echo base_url('leads/leads');?>" class="btn btn-teal btn-sm">Back</a>
            </div>
         </div>
         <!-- panel content -->
         <div class="panel-body">
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
         <table class="table table-striped table-bordered table-hover"  id="sample_1">
              <thead>
              </thead>
              <tbody>
                <?php
                if(!empty($process_details))
                {
                  foreach($process_details as $res)
                  {
                    if($res->response_levels != '')
                    {
                      $prg_width = $res->response_levels.'%';
                    }
                    ?>
                    <tr>
                       <th>Process Date</th>
                       <td><?= $res->leads_process_date; ?></td>
                    </tr>
                    <tr>
                       <th>Process Type</th>
                       <td><?= $res->leads_process_type; ?></td>
                    </tr>
                    <tr>
                       <th>Response Levels</th>
                       <td>
                          <?php echo $prg_width; ?>
                          <div style="margin-top: 8px;" class="progress progress-xxs margin-bottom-0">
                             <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prg_width; ?>;"></div>
                          </div>
                       </td>
                    </tr>
                    <tr>
                       <th>Next Meeting Or Call </th>
                       <td><?php echo $res->next_meeting_call; ?></td>
                    </tr>
                    <?php
                    if($res->next_meeting_call == 'yes')
                    {
                      ?>
                      <tr>
                         <th>Next Meeting Date </th>
                         <td>
                            <?php
                                if($res->next_meeting_date != '')
                                  echo date_format(date_create_from_format('Y-m-d', $res->next_meeting_date),'d M Y'); 
                               ?>
                         </td>
                      </tr>
                      <tr>
                         <th>Next Meeting Time</th>
                         <td><?php echo $res->next_meeting_time; ?></td>
                      </tr>
                      <tr>
                      <?php
                    }
                    ?>
                    </tr>
                    <tr>
                       <th>To Do List </th>
                       <td><?php echo $res->to_do_list; ?></td>
                    </tr>
                    <tr>
                       <th>Sample Request</th>
                       <td><?php echo $res->sample_request; ?></td>
                    </tr>
                    <tr>
                       <th>Quote Request</th>
                       <td><?php echo $res->quote_request; ?></td>
                    </tr>
                    <?php
                    }
                }
                ?>                       
              </tbody> 
          </table>
          <h4>All Products Details</h4>
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                     <th>Action</th>
                </tr>
                <?php 
                if(!empty($products_details))
                {
                    foreach ($products_details as $pd_val) 
                    {
                      ?>
                        <tr>
                           <td><?php echo $pd_val->product_name; ?></td>
                           <td><?php echo $pd_val->product_price; ?></td>
                           <td><?php echo $pd_val->product_desc; ?></td>
                           <td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this , '<?= $pd_val->lead_product_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
                         </tr>                         
                   
                      <?php
                    }
                }
                ?>
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
function delete_Leads(Leads_id)
{
    bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
      if(confirmed)
      {
          location.href="<?php echo base_url();?>Leads/deleteLeads/"+Leads_id;
      }
  });
}    

function save_Leads_id(id)
{
  $('#Leads_id').val(id);
  $('#processModal').modal('show');
}
function removeAddedProduct(obj, id)
{
  bootbox.confirm("Are you sure you want to delete Leads Details",function(confirmed){            
    if(confirmed)
    {
      var data = 'lead_product_id='+id;
      $.post('<?php echo base_url();?>leads/removeLeadProductsById' , data , function(res){
        console.log(res);
        if(res)
        {
           $(obj).parent('td').closest('tr').remove();
        }
      });
    }
  });
}
</script>
