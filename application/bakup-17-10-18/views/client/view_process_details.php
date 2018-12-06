<section id="middle">
   <!-- page title -->
   <header id="page-header">
      <h1>Clients Process Details</h1>
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
            <strong>Client Process Details</strong> 
            </span>

            <div class="pull-right box-tools">
                <a href="<?php echo base_url('client/client');?>" class="btn btn-teal btn-sm">Back</a>
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
                       
                         // $product_details=$this->comman_model->getData('tbl_lead_product' , array('lead_process_id' => $res->leads_process_id , 'product_type' => 'lead_process'));


                          // if($res->response_levels != '')
                          // {
                          //   $prg_width = $res->response_levels.'%';
                          // }
                        ?>
                        <tr>
                            <th>Quote To</th>
                            <td><?= $res->quote_to?></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td><?= $res->submition_date?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                           <td><?php echo $res->address1.'  '.$res->city?></td>
                        </tr>
                        <?php
                        }
                    }
                   ?>                       
              </tbody> 
          </table>
            <h4>All Products Detials</h4>
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                     <th>Action</th>
                </tr>
              <?php if(!empty($products_details))
               {
                  foreach ($products_details as $pd_val) 
                  {
                    ?>
                      <tr>
                         <td><?php echo $pd_val->product_name; ?></td>
                         <td><?php echo $pd_val->product_price; ?></td>
                         <td><?php echo $pd_val->product_desc; ?></td>
                         <td><button class="btn btn-sm btn-danger" onclick="removeAddedProduct(this , '<?= $pd_val->quote_poroduct_id; ?>')" type="button"><i class="fa fa-remove"></i></button></td>
                       </tr>                         
                 
                    <?php
                  }
               } 
               // else{
               //  echo "empty"; die;
               // }
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
